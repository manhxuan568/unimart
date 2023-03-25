<?php

namespace App\Http\Controllers;

use App\Category;
use App\District;
use App\Mail\OrderSuccess;
use App\Menu;
use App\Order;
use App\Product;
use App\Province;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    //
    
    public function add(Request $request){
         $url = $request->productSlug;
          $qty = $request->qty >1?$request->qty:1;  
         
        
        $product = Product::where('slug',$url)->first();
        
        Cart::add(
            ['id' => $product->id,
            'name' => $product->name, 
            'qty' =>$qty,
            'price' => $product->price, 
            'options' => ['thumbnail' => $product->feature_img_path,'slug'=>$product->slug,'product_code'=>'#LARAVELPRO0'.$product->id]
        ]);
        $countCart = Cart::count();
        $TotalCart = Cart::total();

            return response()->json(['success'=>'success','count'=>$countCart,'total'=>$TotalCart]);
    }
    public function show(){
        $list_category = Category::all();
        $menus = Menu::where('parent_id','=',1,'and')->where('status','=','1')->get();
        return view('client.card.show',compact('menus','list_category'));
    }

    public function remove($rowId){
        Cart::remove($rowId);
        return redirect('gio-hang');
    }
    public function removeAll(){
        Cart::destroy();
        return redirect('gio-hang');
    }
    public function updateQtyAjax(Request $request){
       $rowId = $request->productId;
       $qty = $request->inputQtynew;
       Cart::update($rowId,$qty);
       $product_item = Cart::get($rowId);
       $data2 = [
          'subtotal'=> number_format($product_item->total),
          'total'=> Cart::total(),
          'count'=>Cart::count(),
          'productId'=>$product_item->rowId
       ];
       return response()->json($data2);
    }
    public function checkout(){
        $list_province = Province::all();
        $list_category = Category::all();
        $menus = Menu::where('parent_id','=',1,'and')->where('status','=','1')->get();
        return view('client.card.checkOut',compact('menus','list_province','list_category'));
    }
    public function districtAjax(Request $request){
        $idProvince = $request->idProvince;
        $province = Province::find($idProvince);
        $list_district_by_province = $province->districts;
         return view('client.card.selectAjax.district',compact('list_district_by_province'));
    }
    public function wardsAjax(Request $request){
        $idDistrict = $request->idDistricts;
        $district = District::find($idDistrict);
        $list_wards_by_district = $district->wards;
        return view('client.card.selectAjax.wards',compact('list_wards_by_district'));
    }
    public function add_order(Request $request){
          $request->validate(
            [
                'fullname'=>'required',
                'email'=>'required|email',
                'phone'=>'required|numeric',
                'province'=>'required',
                'district'=>'required',
                'wards'=>'required',
                'address'=>'required',
            ],[
                'required'=> ':attribute không được để trống trường này.',
                'email'=>'Email chưa đúng định dạng.',
                'numeric'=>'Dữ liệu điền vào phải là số'
            ],[
                'fullname'=>'Họ tên',
                'email'=>'Email',
                'phone'=>'Số điện thoại',
                'province'=>'Tỉnh/Thành phố',
                'district'=>'Quận/Huyện',
                'wards'=>'Phường/Xã',
                'address'=>'Địa chỉ nhận'
            ]
          );
          if(Cart::count()>0){
           $orderNew = Order::create([
                'order_code'=>'#PRO'.mt_rand(),
                'fullname'=>$request->fullname,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'province_id'=>$request->province,
                'district_id'=>$request->district,
                'ward_id'=>$request->wards,
                'address'=>$request->address,
                'note'=>$request->note,
                'info_order'=>json_encode(Cart::content()),
                'order_total'=>Cart::total(),
                'count_qty'=>Cart::count(),
                'payment_method'=>$request->payment_method
             ]);
             $data = ['orderNew'=>$orderNew];
             Mail::to($orderNew->email)->send(new OrderSuccess($data));
             Cart::destroy();
             return redirect('order-success');
          }else{
            return redirect('thanh-toan')->with('status','Không thể đặt hàng nếu chưa có sản phẩm.');
          }
        
    }
    public function add_product_only($id){
        $product = Product::find($id);
        Cart::destroy();
        Cart::add(
            ['id' => $product->id,
            'name' => $product->name, 
            'qty' =>1,
            'price' => $product->price, 
            'options' => ['thumbnail' => $product->feature_img_path,'slug'=>$product->slug,'product_code'=>'#LARAVELPRO0'.$product->id]
        ]);
        return redirect('gio-hang');
    }
}
