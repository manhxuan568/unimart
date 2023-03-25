<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    //

    public function detail($id){
        $order = Order::find($id);
        return view('admin.order.detail',compact('order'));
    }
    public function actionDetail(Request $request){
         $id = $request->id;
        $status =$request->status;
        if($status == 'pending'){
            Order::find($id)->update(['status_order'=>$status]);
            return redirect()->route('orderDetail',$id)->with('status','Cập nhật trạng thái thành công');
        }
        if($status == 'success'){
            Order::find($id)->update(['status_order'=>$status]);
            return redirect()->route('orderDetail',$id)->with('status','Cập nhật trạng thái thành công');
        }
        if($status == 'shipping'){
            Order::find($id)->update(['status_order'=>$status]);
            return redirect()->route('orderDetail',$id)->with('status','Cập nhật trạng thái thành công');
        }
    }
    public function list(Request $request,$status=''){
        $list_act = ['pending'=>'Đang sử lý','success'=>'Thành công','shipping'=>'Đang vận chuyển','cancel'=>'Hủy đơn và lưu trữ'];

           if(!empty($status)){
            if($status == 'pending'){
                $list_act = ['success'=>'Thành công','shipping'=>'Đang vận chuyển','cancel'=>'Hủy đơn và lưu trữ'];
                $list_order = Order::where('status_order','=','pending')->orderby('id','desc')->paginate(20); 
            }
            if($status == 'success'){
                $list_act = ['pending'=>'Chờ xử lý','shipping'=>'Đang vận chuyển','cancel'=>'Hủy đơn và lưu trữ'];
                $list_order = Order::where('status_order','=','success')->orderby('id','desc')->paginate(20); 
            }
            if($status == 'shipping'){
                $list_act = ['pending'=>'Chờ xử lý','success'=>'Thành công','cancel'=>'Hủy đơn và lưu trữ'];
                $list_order = Order::where('status_order','=','shipping')->orderby('id','desc')->paginate(20); 
            }
            if($status == 'trash'){
                $list_act = ['restore'=>'Khôi phục đơn','forceDelete'=>'Xóa vĩnh viễn'];
                $list_order = Order::onlyTrashed()->paginate(20); 
            }
           }else{
            $keyWord = '';
            if($request->keyWord){
                $keyWord = $request->keyWord;
            }
            $list_order = Order::where('fullname','LIKE',"%$keyWord%")->orderby('id','desc')->paginate(20);
           }
           $count_pending = Order::where('status_order','=','pending')->count();
           $count_success = Order::where('status_order','=','success')->count();
           $count_shipping = Order::where('status_order','=','shipping')->count();
           $count_trash = Order::onlyTrashed()->count();
          
        return view('admin.order.list',compact('list_order','list_act','count_pending','count_success','count_shipping','count_trash'));
    }
    public function delete($id){
        Order::find($id)->update(['status_order'=>'cancel']);
        Order::find($id)->delete();
        return redirect('admin/order/list')->with('status','Chuyển vào nơi lưu trữ thành công.');
    }
    public function action(Request $request){
        if($request->list_check){
             $list_check = $request->list_check;
             if($request->act){
                $act = $request->act;
             }else {
                return redirect('admin/order/list')->with('alert','Bạn chưa chọn tác vụ.');
             }
             if($act == 'pending'){
                Order::whereIn('id',$list_check)->update(['status_order'=>'pending']);
                return redirect('admin/order/list')->with('status','Cập nhật trạng thái chờ duyệt.');  
             }
             if($act == 'success'){
                Order::whereIn('id',$list_check)->update(['status_order'=>'success']);
                return redirect('admin/order/list')->with('status','Cập nhật trạng thái thành công.');  
             }
             if($act == 'shipping'){
                Order::whereIn('id',$list_check)->update(['status_order'=>'shipping']);
                return redirect('admin/order/list')->with('status','Cập nhật trạng thái đang vận chuyển.');  
             }
             if($act == 'cancel'){
                Order::whereIn('id',$list_check)->update(['status_order'=>'cancel']);
                Order::destroy($list_check);
                return redirect('admin/order/list')->with('status','Chuyển vào lưu trữ.');  
             }
             if($act == 'restore'){
                Order::whereIn('id',$list_check)->update(['status_order'=>'pending']);
                Order::onlyTrashed()->whereIn('id',$list_check)->restore();
                return redirect('admin/order/list')->with('status','Cập nhật trạng thái khôi phục.');  
             }
             if($act == 'forceDelete'){
                Order::onlyTrashed()->whereIn('id',$list_check)->forceDelete();
                return redirect('admin/order/list')->with('status','Xóa vĩnh viễn thành công.');  
             }
        }else{
            return redirect('admin/order/list')->with('alert','Bạn cần chọn bản ghi để thực thi.');
        }
    }
    public function edit($id){
        $order = Order::find($id);
        return view('admin.order.edit',compact('order'));
    }
    public function update(Request $request ,$id){
        Order::find($id)->update([
            'fullname'=>$request->fullname,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'note'=>$request->note,
        ]);
        return redirect('admin/order/list')->with('status','Cập nhật thành công.'); 
    }
}
