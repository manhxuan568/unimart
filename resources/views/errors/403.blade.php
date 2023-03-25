@extends('layouts.error')
@section('linkCss')
<link rel="stylesheet" href="{{ asset('error/403.css') }}"> 
@endsection
@section('title')
<title>403!</title>
@endsection
@section('content')
    <div class="page-thumb">
        <lottie-player id="firstLottie" src="https://assets3.lottiefiles.com/packages/lf20_dVJMow.json" speed="1" style="width:400px; height: 400px;" hover loop autoplay>"></lottie-player>
    </div>
    <div class="text-error">Bạn không được cấp quyền này.</div>
    <a href="{{ url('dashboard') }}" class="btn btn-danger text-white">Quay lại.</a>
@endsection