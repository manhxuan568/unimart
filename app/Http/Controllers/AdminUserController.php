<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminUserController extends Controller
{
    //
    private $role;
    private $user;

  function __construct(User $user, Role $role)
  {
    $this->role =$role;
    $this->user =$user;

    $this->middleware(function ($request, $next){
        session(['module_active'=>'user']);
        return $next($request);
    });
}

     function list(Request $request){
        $status = $request->input('status');
        $list_act = ['delete'=>'Xóa tạm thời'];

        if($status == 'trash'){
            $list_act = ['restore'=>'Khôi phục','forceDelete'=>'Xóa vĩnh viễn'];
            $users = User::onlyTrashed()->paginate(10);
        }else{
               $keyWord = '';
            if($request->input('keyWord')){
             $keyWord = $request->input('keyWord');
            }
            $users = User::where('name', "LIKE", "%{$keyWord}%")->paginate(10);
        }
        $count_user_active = User::count();
        $count_user_trash = User::onlyTrashed()->count();
        $count = [$count_user_active,$count_user_trash];

        return view('admin.user.list', compact('users','count','list_act'));
    }
     function add(Request $request){
        $roles = $this->role->all();
        return view('admin.user.add', compact('roles'));
    }

    function store(Request $request){
        $request->validate(
            [
                'fullname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],[
                'required' =>':attribute không được để trống',
                'min' => ':attribute không được nhỏ hơn :min kí tự',
                'max' => ':attribute không được lớn hơn :min kí tự',
                'confirmed' => 'Mật khẩu không khớp nhau',
                'email' => ':attribute của bạn chưa đúng'
            ],[
                'fullname'=> 'Tên đăng nhập',
                'email'=> 'Email',
                'password'=> 'Mật khẩu'
            ]

        );
        try{
            DB::beginTransaction();
          $user = $this->user->create([
            'name' => $request->input('fullname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        $user->roles()->attach($request->role_id);
        DB::commit();
        return redirect('admin/user/list')->with('status', 'Thêm thành viên mới thành công.');

        } catch(\Exception $exception){
            DB::rollBack(); 
          Log::error('Message:'.$exception->getMessage().'--- Line:'.$exception->getLine());  
        }
        // try{}catch(){} trách bị lỗi tính toàn vẹn dữ liệu ko insert vào bảng chung gian dc
       //Xem lỗi dưới routes storage/logs 
    }

     function delete($id){
        if(Auth::id() != $id){
           $user = User::find($id);
           $user->delete();
        }  else{
            return redirect('admin/user/list')->with('status', 'Không thể xóa user chính mình!');
        }
        return redirect('admin/user/list')->with('status', 'Xóa thành viên thành công.'); 
        // try{
          
        // return response()->json([
        //     'code'=>200,
        //     'message'=>'success',
            
        //  ]); 
        // }catch(\Exception $exception){
        //     Log::error('Message'.$exception->getMessage().'--Line : '. $exception->getLine());
        //      return response()->json([
        //         'code'=>500,
        //         'message'=>'fail',
                
        //      ]);      
        // }
        
       
         
    }
       function action(Request $request){
        $list_check = $request->input('list_check');
        if($list_check){
            foreach($list_check as $k => $id){
                if(Auth::id() == $id){
                    unset($list_check[$k]);
                }
            }
            if(!empty($list_check)){
                $act = $request->input('act');
                if($act == 'delete'){
                    User::destroy($list_check);
                    return redirect('admin/user/list')->with('status', 'Thành viên đã chuyển vào thùng rác thành công.');
                }
                if($act == 'restore'){
                    User::onlyTrashed()->whereIn('id', $list_check)->restore();
                    return redirect('admin/user/list')->with('status', 'Khôi phục thành công.');
                }
                if($act == 'forceDelete'){
                    User::onlyTrashed()->whereIn('id', $list_check)->forceDelete();
                    return redirect('admin/user/list')->with('status', 'Xóa user vĩnh viễn thành công.');
                }

            }
            return redirect('admin/user/list')->with('status', 'Bạn không thể dùng tác vụ này.');
        }else{
            return redirect('admin/user/list')->with('status', 'Bạn cần trọn thành viên để thực hiện tác vụ này.');
        }
    }

      function edit($id){
        $user = User::find($id);
        $roles = Role::all();
        $rolefoUser = $user->roles;
        // dd($rolefoUser);
        return view('admin.user.edit', compact('user','rolefoUser','roles'));
    }
     function update(Request $request, $id){
        $request->validate(
            [
                'fullname' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],[
                'required' =>':attribute không được để trống',
                'min' => ':attribute không được nhỏ hơn :min kí tự',
                'max' => ':attribute không được lớn hơn :min kí tự',
                'confirmed' => 'Mật khẩu không khớp nhau',
                'email' => ':attribute của bạn chưa đúng'
            ],[
                'fullname'=> 'Tên đăng nhập',
                'password'=> 'Mật khẩu'
            ]

        );
        try{
            DB::beginTransaction();
        $this->user->find($id)->update([
        'name'=> $request->input('fullname'),
        'password'=> Hash::make($request->input('password'))
       ]); 
       $user = $this->user->find($id);
       $user->roles()->sync($request->input('role_id'));
    //    sync() là phương thức hỗ trợ cập nhật mảng có rồi thì nó xóa đi cập nhật cái mới hoặc có rồi cập nhật thêm cái khác
       DB::commit();
       return redirect('admin/user/list')->with('status', 'Cập nhập user thành công.');
    } catch(\Exception $exception){
        DB::rollBack(); 
      Log::error('Message:'.$exception->getMessage().'--- Line:'.$exception->getLine());  
    }
    // try{}catch(){} trách bị lỗi tính toàn vẹn dữ liệu ko insert vào bảng chung gian dc
   //Xem lỗi dưới routes storage/logs 
    }
}
