<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Menu;
use App\Product;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function post(){
        $menus = Menu::where('parent_id','=',1,'and')->where('status','=','1')->get();
        $productTopSale = Product::where('topsale','=','TopSale','and')->where('status','=','1')->get();
        $posts = Post::where('status','1')->get();
        $list_category = Category::all();
        return view('client.post.list',compact('posts','menus','productTopSale','list_category'));
    }
    public function postDetail($slug){
        $menus = Menu::where('parent_id','=',1,'and')->where('status','=','1')->get();
        $productTopSale = Product::where('topsale','=','TopSale','and')->where('status','=','1')->get();
        $post = Post::where('slug',$slug)->first();
       return view('client.post.postDetail',compact('post','menus','productTopSale'));    
    }
}
