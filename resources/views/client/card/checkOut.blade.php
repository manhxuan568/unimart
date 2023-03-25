@extends('layouts.client')
@section('content')
   <style>
    body{background: #fff}
    #content-wp{border-bottom:1px solid #d9ddde}
    </style> 
<div class="container px-0" id="content-wp">
    @if (session('status'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="submit" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times</span></button>
                </div> 
    @endif
    <div id="main-content-wp" class="checkout-page">
        <div class="section" id="breadcrumb-wp">
                <ul class="breadcrumb mb-0 bg-white">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="link-page"><i class="fa-solid fa-house"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="" class="link-page">Thanh toán</a></li>
                </ul>
        </div>
<form method="POST" action="{{ url('add-order') }}" name="form-checkout">
    @csrf
    <div id="wrapper" class="wp-inner clearfix section mt-0">
        <div class="section" id="customer-info-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin khách hàng</h1>
            </div>
            <div class="">
                    <div class="row mb-2">
                        <div class="col-md-6 col-12 mt-1">
                            <label for="fullname">Họ tên <span class="important">(*)</span></label>
                            <input type="text" name="fullname" class="form-control form-control-sm" id="fullname">
                            @error('fullname')
                               <small class="text-danger">{{ $message }}</small> 
                            @enderror
                        </div>
                        <div class="col-md-6 col-12 mt-1">
                            <label for="email">Email <span class="important">(*)</span></label>
                            <input type="email" name="email" class="form-control form-control-sm" id="email">
                            @error('email')
                               <small class="text-danger">{{ $message }}</small> 
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">  
                        <div class="col-md-6 col-12 mt-1">
                            <label for="phone">Số điện thoại <span class="important">(*)</span></label>
                            <input type="tel" name="phone" class="form-control form-control-sm" maxlength="10" id="phone">
                            @error('phone')
                               <small class="text-danger">{{ $message }}</small> 
                            @enderror
                        </div>
                        <div class="col-md-6 col-12 mt-1">
                            <label for="provinces">Tỉnh/Thành phố <span class="important">(*)</span></label>
                            <select name="province" id="provinces" class="form-select form-control form-control-sm" data-district="{{ url('district') }}">
                                   <option value="" disabled selected>Chọn Tỉnh/Thành phố</option>
                                   @foreach ($list_province as $province)
                                      <option value="{{ $province->id }}">{{ $province->name }}</option> 
                                   @endforeach
                            </select>
                            @error('province')
                            <small class="text-danger">{{ $message }}</small> 
                            @enderror
                        </div>
                    </div>
                    <div class="row my-4">  
                        <div class="col-md-6 col-12 mt-1">
                            <label for="districts">Quận/Huyện <span class="important">(*)</span></label>
                            <select name="district" id="districts" class="form-select form-control form-control-sm" data-wards="{{ url('wards') }}">
                                   <option value="" disabled selected>Chọn Quận/Huyện</option>
                            </select>
                            @error('district')
                               <small class="text-danger">{{ $message }}</small> 
                            @enderror
                        </div>
                        <div class="col-md-6 col-12 mt-1">
                            <label for="wards">Phường/Xã <span class="important">(*)</span></label>
                            <select name="wards" id="wards" class="form-select form-control form-control-sm" aria-label="Default select example">
                                   <option value="" disabled selected>Chọn Phường/Xã</option>
                            </select>
                            @error('wards')
                               <small class="text-danger">{{ $message }}</small> 
                            @enderror
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-md-12 col-12">
                            <label for="address">Tên đường, Tòa nhà, Số nhà <span class="important">(*)</span></label>
                            <input type="text" name="address" class="form-control form-control-sm" id="address">
                            @error('address')
                               <small class="text-danger">{{ $message }}</small> 
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <label for="notes">Ghi chú (Nếu có)</label>
                            <textarea name="note" class="form-control form-control-sm" id="notes" cols="15" rows="5"></textarea>
                        </div>
                    </div>
            </div>
        </div>
        <div class="section" id="order-review-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin đơn hàng</h1>
            </div>
            <div class="section-detail1">
                <table class="shop-table">
                    <thead>
                        <tr>
                            <td>Sản phẩm</td>
                            <td>Tổng</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if (Cart::count() > 0)
                            @foreach (Cart::content() as $row)
                        <tr class="cart-item">
                            <td class="product-name">{{ $row->name }}<strong class="product-quantity">x {{ $row->qty }}</strong></td>
                            <td class="product-total">{{ number_format($row->total) }}đ</td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="cart-item">
                        <td>Chưa có đơn hàng.</td>
                        </tr> 
                        @endif
                    </tbody>
                    <tfoot>
                        <tr class="order-total">
                            <td>Tổng đơn hàng:</td>
                            <td><strong class="total-price">{{ Cart::total() }}đ</strong></td>
                        </tr>
                    </tfoot>
                </table>
                <div id="payment-checkout-wp">
                    <ul id="payment_methods">
                        <li>
                            <input type="radio" id="direct-payment" name="payment_method" value="direct" >
                            <label for="direct-payment">Thanh toán tại cửa hàng</label>
                        </li>
                        <li>
                            <input type="radio" id="payment-home" name="payment_method" value="home" checked>
                            <label for="payment-home">Thanh toán tại nhà</label>
                        </li>
                    </ul>
                </div>
                <div class="place-order-wp clearfix">
                    <input type="submit" id="order-now" name="add_order" value="Đặt hàng">
                </div>
            </div>
        </div>
    </div>
</form>    
</div>
</div>

@endsection