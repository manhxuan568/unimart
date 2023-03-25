@extends('layouts.error')
@section('linkCss')
<link rel="stylesheet" href="{{ asset('error/404.css') }}"> 
@endsection
@section('title')
<title>404!</title>
@endsection
@section('content')
    <div class="page-thumb">
        <lottie-player id="firstLottie" src="https://assets9.lottiefiles.com/packages/lf20_az0MhjvO6G.json" speed="1" style="width:400px; height: 400px;" hover loop autoplay>"></lottie-player>
    </div>
    <div class="text-error">Lỗi trang không tồn tại 404!</div>
    <a href="{{ route('home') }}" class="btn btn-danger text-white">Quay lại trang chủ.</a>
@endsection