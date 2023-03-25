<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminSliderController extends Controller
{
    //
    function __construct()
    {
      $this->middleware(function ($request, $next){
          session(['module_active'=>'slider']);
          return $next($request);
      });
  }

    public function add(){
        return view('admin.slider.add');
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'link'=>'required',
            'slider_desc'=>'required',
        ],[
            'required'=>':attribute không được để trống trường này.'
        ],[
            'name'=>'Tên slider',
            'link'=>'Link',
            'slider_desc'=>'Mô tả',
        ]
    );
    $uploaddir='public/uploads/';
    if($request->hasFile('thumb_slider')){
        $file = $request->thumb_slider;
        $file->move('public/uploads',$file->getClientOriginalName());
        $thumbnail = $uploaddir.$file->getClientOriginalName();
    }
    Slider::create([
        'name'=>$request->name,
        'thumb_slider'=>$thumbnail,
        'slider_desc'=>$request->slider_desc,
        'link'=>$request->link,
        'status'=>$request->status,
        'user_id'=> Auth::id(),       
    ]);
     return redirect('admin/slider/list')->with('status','Thêm slider thành công.');
    }
    public function list(){
        $sliders = Slider::all();
        return view('admin.slider.list',compact('sliders'));
    }
    public function delete($id){
        Slider::find($id)->delete();
        return redirect('admin/slider/list')->with('status','Xóa slider thành công.');
    }
    public function edit($id){
       $slider = Slider::find($id);
        return view('admin.slider.edit',compact('slider'));
    }
    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required',
            'link'=>'required',
            'slider_desc'=>'required',
        ],[
            'required'=>':attribute không được để trống trường này.'
        ],[
            'name'=>'Tên slider',
            'link'=>'Link',
            'slider_desc'=>'Mô tả',
        ]
    );
    $uploaddir='public/uploads/';
    $data = [
        'name'=>$request->name,
        'slider_desc'=>$request->slider_desc,
        'link'=>$request->link,
        'status'=>$request->status,
        'user_id'=> Auth::id(),  
    ];
    if($request->hasFile('thumb_slider')){
        $file = $request->thumb_slider;
        $file->move('public/uploads',$file->getClientOriginalName());
        $thumbnail = $uploaddir.$file->getClientOriginalName();
        $data['thumb_slider']=$thumbnail;
    }
    Slider::find($id)->update($data);
     return redirect('admin/slider/list')->with('status','Cập nhật slider thành công.');
    }
}
