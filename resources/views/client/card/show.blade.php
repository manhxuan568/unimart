@extends('layouts.client')
@section('content')
<div class="container px-0" id="content-wp">
    <div id="main-content-wp" class="cart-page">
        @if (Cart::count()>0)
        <div class="section" id="breadcrumb-wp">
                <ul class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}" class="link-page"><i class="fa-solid fa-house"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="" class="link-page">Giỏ hàng</a></li>
                </ul>
        </div>
        <div id="wrapper" class="wp-inner clearfix">
            <div class="section" id="info-cart-wp">
                <div class="table-responsive">
                    <table class="table" data-update="{{ route('updateQtyAjax') }}">
                        <thead>
                            <tr>
                                <td>Mã sản phẩm</td>
                                <td>Ảnh sản phẩm</td>
                                <td>Tên sản phẩm</td>
                                <td>Giá sản phẩm</td>
                                <td>Số lượng</td>
                                <td>Thành tiền</td>
                                <td>Tác vụ</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Cart::content() as $row)
                                <tr>
                                <td>{{ $row->options->product_code }}</td>
                                <td>
                                    <a href="{{ route('productDetail',$row->options->slug) }}" title="{{ $row->name }}" class="thumb">
                                        <img src="{{ url($row->options->thumbnail) }}" alt="">
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('productDetail',$row->options->slug) }}" title="{{ $row->name }}" class="name-product">{{ $row->name }}</a>
                                </td>
                                <td>{{ number_format($row->price) }}đ</td>
                                <td>
                                <div id="num-order-wp" class="num-order-wp">
                                    <a class="minuss" class="minus-detail minus_plus"><i class="fa fa-minus"></i></a>
                                    <input type="text" name="num-order" value="{{ $row->qty }}" data-id="{{ $row->rowId }}" min="1" id="num-order" class="product-qty">
                                    <a class="pluss" class="plus-detail minus_plus"><i class="fa fa-plus"></i></a>
                                </div>
                                </td>
                                <td>{{ number_format($row->total) }}đ</td>
                                <td>
                                    <a href="{{ route('cart.remove',$row->rowId) }}" title="Xóa" class="del-product"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                          
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix wp-total-price-qty">
                                        <p id="total-qty" class="fl-right">Số lượng: <span class="">{{ Cart::count() }}</span></p>          
                                        <p id="total-price" class="fl-right">Tổng tiền: <span class="">{{ Cart::total() }}đ</span></p>          
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" class="checkout">
                                    <div class="clearfix">
                                        <div class="fl-right">
                                            <a href="{{ url('cart/removeall') }}" title="" id="deleteAll-cart">Xóa toàn bộ giỏ hàng</a>
                                            <a href="{{ url('thanh-toan') }}" title="" id="checkout-cart">Thanh toán</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        @else
            <div class="cart-empty">
                <lottie-player id="firstLottie" class="cartLottie" src="https://assets6.lottiefiles.com/packages/lf20_qh5z2fdq.json" style="width:400px; height: 400px;" hover loop autoplay>"></lottie-player>
                <p class="text-alert">Giỏ hàng trống.</p>
                <a href="{{ url('home') }}" class="btn btn-warning text-white">Quay trang chủ</a>
            </div>
        @endif
        
    </div>    
</div>
@endsection