<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    //
    function menu(){
        $menus = Menu::where('parent_id','=',1,'and')->where('status','=','1')->get();
        return view('layouts.client',compact('menus')); 
    }
}
