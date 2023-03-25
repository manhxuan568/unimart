<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMenuController extends Controller
{
    //
    function __construct()
    {
      $this->middleware(function ($request, $next){
          session(['module_active'=>'menu']);
          return $next($request);
      });
  }
    public function list(){
        $menus = Menu::all();
         $menus = data_tree($menus,0,0);
         return view('admin.menu.list', compact('menus'));
    }
    public function add(Request $request){
        $data = Menu::all();
        $list_menu = data_tree($data,0,0);
        return view('admin.menu.add',compact('list_menu'));
    }
    public function store(Request $request){
      $request->validate(
        [
            'name'=>'required',
            'parent_id'=>'required',     
            'slug'=>'required',
            'position'=>'required',
            'link'=>'required',
        ],
        [
         'required'=>':attribute không được để trống.'
        ],
        [
            'name'=>'Tên Menu',
            'parent_id'=>'Danh mục cha',
            'slug'=>'Slug',
            'link'=>'Link',
            'position'=>'Position',
        ]
        );
        Menu::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'parent_id' => $request->input('parent_id'),
            'status' => $request->input('status'),
            'position_num' => $request->input('position'),
            'user_id'=> Auth::id(),
            'link' => $request->input('link'),
        ]);
        return redirect('admin/menu/list')->with('status', 'Thêm menu mới thành công.');
    }
    function delete($id){
         Menu::where('id',$id)->delete();
        return redirect('admin/menu/list')->with('status', 'Xóa vĩnh viễn menu thành công.');
    }
    function edit($id){
        $menu = Menu::find($id);
        $data = Menu::all();
        $menu_parent = data_tree($data,0,0);
        return view('admin.menu.edit', compact('menu','menu_parent'));
    }
     function update(Request $request, $id)
     {
        $request->validate(
            [
            'name'=>'required',  
            'slug'=>'required',
        ],
        [
         'required'=>':attribute không được để trống.'
        ],
        [
            'name'=>'Tên Menu',
            'slug'=>'Slug',
        ]

        );
       Menu::where('id', $id)->update([
        'name'=> $request->input('name'),
        'slug'=> $request->input('slug'),
        'user_id'=> Auth::id(),
        'status' => $request->input('status'),
       ]); 
       return redirect('admin/menu/list')->with('status', 'Cập nhật menu thành công.');;
    }
}

