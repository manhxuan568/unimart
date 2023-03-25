<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

class AdminPermissionController extends Controller
{
    function __construct()
    {
      $this->middleware(function ($request, $next){
          session(['module_active'=>'permission']);
          return $next($request);
      });
  }
    //
    public function create(){
        $module_parent = Permission::where('parent_id',0)->get();
        return view('admin.permission.add',compact('module_parent'));
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'display_name'=>'required',
            'key_code'=>'required',
        ],[
            'required'=>':attribute không được để trống trường này.'
        ],[
            'name'=>'Tên quyền',
            'display_name'=>'Mô tả',
            'key_code'=>'Key_code',
        ]
    );
      $permission = Permission::create([
            'name'=>$request->name,
            'display_name'=>$request->display_name,           
            'parent_id'=>$request->module_parent,
            'key_code'=>$request->key_code
       ]);
       return redirect('admin/permission/list')->with('status', 'Thêm quyền thành công.');
    //    foreach($request->module_childrent as $value){
    //     Permission::create([
    //         'display_name'=>$value,
    //         'name'=>$value,
    //         'parent_id'=>$permission->id,
    //         'key_code'=> $request->module_parent.'_'.$value,
    //    ]);
    //    }
       
    }
    public function list(){
        $permissions = Permission::all();
        $permissions = data_tree($permissions,0,0);
        return view('admin.permission.list',compact('permissions'));
    }
    public function delete($id){
        $delete = Permission::find($id);
        $delete->delete();
        return redirect('admin/permission/list')->with('status', 'Xóa quyền thành công.');
    }
    public function edit($id){
        $module_parent = Permission::where('parent_id',0)->get();
        $permission = Permission::find($id);
        return view('admin.permission.edit',compact('permission','module_parent'));
    }
    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required',
            'display_name'=>'required',
            'key_code'=>'required',
        ],[
            'required'=>':attribute không được để trống trường này.'
        ],[
            'name'=>'Tên quyền',
            'display_name'=>'Mô tả',
            'key_code'=>'Key_code',
        ]
    );
      $permission = Permission::find($id)->update([
            'name'=>$request->name,
            'display_name'=>$request->display_name,           
            'parent_id'=>$request->module_parent,
            'key_code'=>$request->key_code
       ]);
       return redirect('admin/permission/list')->with('status', 'Cập nhật quyền thành công.');
    }
}
