<?php

namespace App\Http\Controllers;

use App\Category;
use App\Page;
use App\Menu;
use App\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function page1(){
        $list_category = Category::all();
        $menus = Menu::where('parent_id','=',1,'and')->where('status','=','1')->get();
        $productTopSale = Product::where('topsale','=','TopSale','and')->where('status','=','1')->get();
        $page = Page::where('slug','gioi-thieu.html')->first();
        return view('client.page',compact('page','menus','productTopSale','list_category'));
    }
}
