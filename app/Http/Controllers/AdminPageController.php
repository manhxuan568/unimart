<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPageController extends Controller
{
    function __construct()
    {
      $this->middleware(function ($request, $next){
          session(['module_active'=>'page']);
          return $next($request);
      });
  }
    //
    public function add(){
        return view('admin.page.add');
    }
    public function store(Request $request){
        $request->validate(
            [
                'title'=> 'required',
                'slug'=> 'required',
                'content'=> 'required',
            ],
            [
                'required'=> ':attribute không được để trống!',
            ],[
                'title'=>'Tiêu đề',
                'slug'=>'Link slug',
                'content'=>'Nội dung'
                ]
           );
           Page::create([
            'title'=>$request->title,
            'slug'=>$request->slug,
            'content'=>$request->content,
            'status'=>$request->status,
            'user_id'=>Auth::id()
           ]);
           return redirect('admin/page/list')->with('status','Thêm trang mới thành công.');
    }
    public function list(Request $request,$status=''){
        $list_act = ['pending'=>'Chờ duyệt','publish'=>'Công khai','trash'=>'Thùng rác'];
        if(empty($status)){
               $keyWord = '';
            if($request->keyWord){
                $keyWord = $request->keyWord;  
            }
        $pages = Page::where('title','LIKE',"%$keyWord%")->paginate(10);
        }else{
            //pending
            if($status == 'pending'){
                $list_act = ['publish'=>'Công khai','trash'=>'Thùng rác'];
                $pages = Page::where('status','0')->paginate(10);  
            }
            //publish
            if($status == 'publish'){
                $list_act = ['pending'=>'Chờ duyệt','trash'=>'Thùng rác'];
                $pages = Page::where('status','1')->paginate(10);  
            }
            //trash
            if($status == 'trash'){
                $list_act = ['restore'=>'Khôi phục','forceDelete'=>'Xóa vĩnh viễn'];
                $pages = Page::onlyTrashed()->paginate(10);  
            }
        }
        // dd($posts);
        $count_pending = Page::where('status','0')->count();
        $count_publish = Page::where('status','1')->count();
        $count_trash = Page::onlyTrashed()->count();     

        return view('admin.page.list',compact('pages','count_pending','count_publish','count_trash','list_act'));
    }
    public function delete($id){
       $page = Page::find($id);
        if($page === null){
            $page = Page::onlyTrashed()->find($id);
            $page->forceDelete();
            return redirect('admin/page/list')->with('status','Xóa vĩnh viễn sản phẩm thành công.');
         }
         $page->delete();
        return redirect('admin/page/list')->with('status','Xóa trang thành công.');
    }
    public function edit($id){
        $page = Page::find($id);
        if($page === null){
            $page = Page::onlyTrashed()->find($id);
        }
        return view('admin.page.edit',compact('page'));
    }
    public function update(Request $request, $id){
        $request->validate(
            [
                'title'=> 'required',
                'slug'=> 'required',
                'content'=> 'required',
            ],
            [
                'required'=> ':attribute không được để trống!',
            ],[
                'title'=>'Tiêu đề',
                'slug'=>'Link slug',
                'content'=>'Nội dung'
                ]
           );
           $page = Page::find($id);
           if($page === null){
            $page = Page::onlyTrashed()->find($id);
        }
           $page->update([
            'title'=>$request->title,
            'slug'=>$request->slug,
            'content'=>$request->content,
            'status'=>$request->status,
            'user_id'=>Auth::id()
           ]);
           return redirect('admin/page/list')->with('status','Cập nhật trang thành công.');
    }

    public function action(Request $request){
        $list_check = $request->list_check;
        if(!empty($list_check)){
            if(empty($request->act)){
               $request->validate(['act'=>'required'],['required'=>'Bạn chưa chọn :attribute.'],['act'=>'tác vụ']);
            }else{
                $act = $request->act;
            }
            if($act == 'pending'){
                Page::whereIn('id',$list_check)->update(['status'=>'0']);
                return redirect('admin/page/list')->with('status','Cập nhật trạng thái bài viết thành công.');
            }
            if($act == 'publish'){
                Page::whereIn('id',$list_check)->update(['status'=>'1']);
                return redirect('admin/page/list')->with('status','Cập nhật trạng thái bài viết thành công.');
            }
            if($act == 'trash'){
                Page::destroy($list_check);
                return redirect('admin/page/list')->with('status','Đã chuyển bài viết vào thùng rác.');
            }
            if($act == 'restore'){
                Page::onlyTrashed()->whereIn('id',$list_check)->restore();
                return redirect('admin/page/list')->with('status','Khôi phục bài viết thành công.');
            }
            if($act == 'forceDelete'){
                Page::onlyTrashed()->whereIn('id',$list_check)->forceDelete();
                return redirect('admin/page/list')->with('status','Xóa vĩnh viễn bài viết thành công.');
            }
        }else{
            return redirect('admin/page/list')->with('alert','Bạn chưa chọn bản ghi để thực hiện.');  
        }
    }
}
