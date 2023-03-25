<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminRoleController extends Controller
{
   
    private $role,$permission;
    //
    public function __construct(Role $role, Permission $permission){
      $this->role = $role;   
      $this->permission = $permission;   
      $this->middleware(function ($request, $next){
        session(['module_active'=>'role']);
        return $next($request);
    });
    }
    public function add(){
        $permisssionParent = $this->permission->where('parent_id',0)->get();
        return view('admin.role.add',compact('permisssionParent'));
    }
    public function store(Request $request){
        $request->validate(
            [
                'name'=>'required',
                'display_name'=>'required',     
            ],
            [
             'required'=>':attribute không được để trống.'
            ],
            [
                'name'=>'Tên vai trò',
                'display_name'=>'Mô tả ngắn',
            ]
            );
          $role =  $this->role->create([
            'name'=>$request->name,
            'display_name'=>$request->display_name
           ]); 
          $role->permission()->attach($request->permission_id);
          //từ role vừa insert kèm id của role đó và chỏ đến bảng chung gian permission() để lấy nhũng id quyền bên bảng permission vừa insert với pp attach() và thế mảng quyền và id role được thêm vào một cách tương ứng. 
         return redirect('admin/role/list')->with('status','Thêm vai trò thành công.'); 
    }
    public function list(){
        $Roles = $this->role->paginate(10);
        return view('admin.role.list', compact('Roles'));
    }
    public function edit($id){
        $permisssionParent = $this->permission->where('parent_id',0)->get();
         $role = $this->role->find($id);
         $permissionCheck = $role->permission;
        return view('admin.role.edit',compact('permisssionParent','role','permissionCheck'));
    }
    public function update(Request $request, $id){
        $role = $this->role->find($id);
        $role->update([
            'name'=>$request->name,
            'display_name'=>$request->display_name
           ]); 

          $role->permission()->sync($request->permission_id);
          return redirect('admin/role/list')->with('status','Cập nhật vai trò thành công.'); 
    }
    public function delete($id){
       $role = $this->role->find($id);
       $role->delete();
       DB::table('permission_role')->where('role_id',$id)->delete();
        return redirect('admin/role/list')->with('status','Xóa vĩnh viễn vai trò thành công.'); 
    }
}
