<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

public function show(){
    $count_pending = Order::where('status_order','=','pending')->count();
    $count_success = Order::where('status_order','=','success')->count();
    $count_shipping = Order::where('status_order','=','shipping')->count();
    $count_trash = Order::onlyTrashed()->count();
    $list_order_success = Order::where('status_order','=','success')->get();
    $list_order = Order::orderby('id','desc')->paginate(20);
    return view('admin.dashboard',compact('list_order','list_order_success','count_pending','count_success','count_shipping','count_trash'));
}  



}
