<?php

namespace App\Http\Controllers;

use App\CategoryPost;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPostController extends Controller
{
    function __construct()
    {
      $this->middleware(function ($request, $next){
          session(['module_active'=>'post']);
          return $next($request);
      });
  }
    //
    //category
    public function listCat(){
        $list_cat = CategoryPost::all();
        $list_cat = data_tree($list_cat,0,0);
        return view('admin.post.cat.list',compact('list_cat'));
    }
    public function addCat(Request $request){
        $request->validate(
            [
                'name'=> 'required',
                'slug'=> 'required',
            ],
            [
                'required'=> ':attribute không được để trống!',
            ],['name'=>'Danh mục cha','slug'=>'Link slug']
           );
           CategoryPost::create([
            'name'=>$request->name,
            'slug'=>$request->slug,
            'parent_id'=>$request->parent_id,
            'status'=>$request->status,
            'user_id'=>Auth::id()
           ]);
           return redirect('admin/post/cat/list')->with('status','Thêm danh mục mới thành công.');
    }
    public function deleteCat($id){
        CategoryPost::find($id)->delete();
        return redirect('admin/post/cat/list')->with('delete','Xóa danh mục thành công.');
    }
    public function editCat($id){
        $list_cat = CategoryPost::all();
        $list_cat = data_tree($list_cat,0,0);
        $cat = CategoryPost::find($id);
        return view('admin.post.cat.edit',compact('list_cat','cat'));  
    }
    public function updateCat(Request $request, $id){
        $request->validate(
            [
                'name'=> 'required',
                'slug'=> 'required',
            ],
            [
                'required'=> ':attribute không được để trống!',
            ],['name'=>'Danh mục cha','slug'=>'Link slug']
           );
           CategoryPost::find($id)->update([
            'name'=>$request->name,
            'slug'=>$request->slug,
            'parent_id'=>$request->parent_id,
            'status'=>$request->status,
            'user_id'=>Auth::id()
           ]);
           return redirect('admin/post/cat/list')->with('update','Thêm danh mục mới thành công.');
    }
    //product
    public function add(){
        $list_cat = CategoryPost::all();
        $list_cat = data_tree($list_cat,0,0);
        return view('admin.post.add',compact('list_cat'));
    }
    public function store(Request $request){
        $request->validate(
            [
                'title'=> 'required',
                'slug'=> 'required',
                'category_id'=> 'required',
                'content'=> 'required',
                'thumb_post'=> 'required',
            ],
            [
                'required'=> ':attribute không được để trống!',
            ],[
                'title'=>'Danh mục cha',
                'slug'=>'Link slug',
                'category_id'=>'Danh mục bài viết',
                'content'=>'Nội dung bài viết',
                'thumb_post'=>'Ảnh đại diện'
                ]
           );
           $uploaddir='public/uploads/';
           if($request->hasFile('thumb_post')){
            $file = $request->thumb_post;
            $file->move('public/uploads',$file->getClientOriginalName());
            $thumbnail = $uploaddir.$file->getClientOriginalName();
            // $data['thumb_slider']=$thumbnail;
        }
           Post::create([
            'title'=>$request->title,
            'slug'=>$request->slug,
            'thumb_post'=>$thumbnail,
            'content'=>$request->content,
            'category_id'=>$request->category_id,
            'user_id'=>Auth::id(),
            'status'=>$request->status
           ]);
       return redirect('admin/post/list')->with('status','Thêm bài viết mới thành công.');    
    }
    public function list(Request $request,$status=''){
        $list_act = ['pending'=>'Chờ duyệt','publish'=>'Công khai','trash'=>'Thùng rác'];
        if(empty($status)){
               $keyWord = '';
            if($request->keyWord){
                $keyWord = $request->keyWord;  
            }
        $posts = Post::where('title','LIKE',"%$keyWord%")->paginate(10);
        }else{
            //pending
            if($status == 'pending'){
                $list_act = ['publish'=>'Công khai','trash'=>'Thùng rác'];
                $posts = Post::where('status','0')->paginate(10);  
            }
            //publish
            if($status == 'publish'){
                $list_act = ['pending'=>'Chờ duyệt','trash'=>'Thùng rác'];
                $posts = Post::where('status','1')->paginate(10);  
            }
            //trash
            if($status == 'trash'){
                $list_act = ['restore'=>'Khôi phục','forceDelete'=>'Xóa vĩnh viễn'];
                $posts = Post::onlyTrashed()->paginate(10);  
            }
        }
        // dd($posts);
        $count_pending = Post::where('status','0')->count();
        $count_publish = Post::where('status','1')->count();
        $count_trash = Post::onlyTrashed()->count();
        // $posts = Post::where('status','0')->paginate(10); 
        return view('admin.post.list', compact(['posts','count_pending','count_publish','count_trash','list_act']));
    }
    public function edit($id){
            $list_cat = CategoryPost::all();
            $list_cat = data_tree($list_cat,0,0);
            $post = Post::find($id);
            if($post === null){
                $post = Post::onlyTrashed()->find($id);
            }
        return view('admin.post.edit',compact('post','list_cat'));
    }
    public function delete($id){
        $post = Post::find($id);
        if($post === null){
            $post = Post::onlyTrashed()->find($id);
            $post->forceDelete();
            return redirect('admin/post/list')->with('status','Xóa vĩnh viễn bài viết thành công.');
        }else{
             $post->delete();
            return redirect('admin/post/list')->with('status','Xóa bài viết thành công.'); 
        }
             
    }
    public function update(Request $request, $id){
        $request->validate(
            [
                'title'=> 'required',
                'slug'=> 'required',
                'category_id'=> 'required',
                'content'=> 'required',
            ],
            [
                'required'=> ':attribute không được để trống!',
            ],[
                'title'=>'Danh mục cha',
                'slug'=>'Link slug',
                'category_id'=>'Danh mục bài viết',
                'content'=>'Nội dung bài viết',
                ]
           );
           $uploaddir='public/uploads/';
           
           $data= [
            'title'=>$request->title,
            'slug'=>$request->slug,
            'content'=>$request->content,
            'category_id'=>$request->category_id,
            'user_id'=>Auth::id(),
            'status'=>$request->status,
           ];

           if($request->hasFile('thumb_post')){
            $file = $request->thumb_post;
            $file->move('public/uploads',$file->getClientOriginalName());
            $thumbnail = $uploaddir.$file->getClientOriginalName();
            $data['thumb_post']=$thumbnail;
        }
        $post = Post::find($id);
        if($post === null){
            $post = Post::onlyTrashed()->find($id);
        }
        $post->update($data);
        return redirect('admin/post/list')->with('status','Cập nhật bài viết thành công.'); 
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
                Post::whereIn('id',$list_check)->update(['status'=>'0']);
                return redirect('admin/post/list')->with('status','Cập nhật trạng thái bài viết thành công.');
            }
            if($act == 'publish'){
                Post::whereIn('id',$list_check)->update(['status'=>'1']);
                return redirect('admin/post/list')->with('status','Cập nhật trạng thái bài viết thành công.');
            }
            if($act == 'trash'){
                Post::destroy($list_check);
                return redirect('admin/post/list')->with('status','Đã chuyển bài viết vào thùng rác.');
            }
            if($act == 'restore'){
                Post::onlyTrashed()->whereIn('id',$list_check)->restore();
                return redirect('admin/post/list')->with('status','Khôi phục bài viết thành công.');
            }
            if($act == 'forceDelete'){
                Post::onlyTrashed()->whereIn('id',$list_check)->forceDelete();
                return redirect('admin/post/list')->with('status','Xóa vĩnh viễn bài viết thành công.');
            }
        }else{
            return redirect('admin/post/list')->with('alert','Bạn chưa chọn bài viết để thực hiện.');  
        }
    }
}
