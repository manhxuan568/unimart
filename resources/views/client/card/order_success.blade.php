@extends('layouts.client')
@section('content')
 <style>
    .cart-page{
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top:30px 
    }
    .text-alert{
        padding: 20px 0;
    }
    .url-back a{
        text-decoration: none;
        color: #fff;
        padding: 10px 15px;
        font-size: 17px;
        border-radius: 5px;
        margin: 0 10px;
        font-weight: 600
    }
    .url-back a.backHome{
        background: #46da0c;
    }
    .url-back a.cancel{
        background: #ff1111;
    }
   
 </style>   
    <div class="container px-0" id="content-wp">
        <div id="main-content-wp" class="cart-page">
            <lottie-player id="firstLottie" class="orderSuccessIcon" src="https://assets10.lottiefiles.com/packages/lf20_rc5d0f61.json" style="width:200px; height: 200px;" loop autoplay>"></lottie-player>
            <p class="text-alert">Đặt hàng thành công.</p>
            <div class="url-back">
                <a href="{{ url('home') }}" class="backHome">Quay lại trang chủ</a>
                <a href="https://mail.google.com/mail" class="cancel">Check Mail</a>
            </div>
        </div>
    </div>       
@endsection