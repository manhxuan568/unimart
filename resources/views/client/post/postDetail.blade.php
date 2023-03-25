@extends('layouts.client')
@section('content')
<div class="container px-0" id="content-wp-product">
        <div class="section" id="breadcrumb-wp">
            <ul class="breadcrumb mb-md-0">
                <li class="breadcrumb-item"><a href="" class="link-page"><i class="fa-solid fa-house"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="" class="link-page">Bài viết</a></li>
            </ul>
        </div>
    <div class="row main-content-wp no-gutters">
        <div class="col-md-3 sidebar pl-0">
            <div class="top-selling-products">
                    <div class="title-section">
                        <h5 >SẢN PHẨM BÁN CHẠY</h5>   
                    </div>
                    <div class="body-section">
                        <ul class="list-products-top">
                            @foreach ($productTopSale as $product)
                               <li class="item">
                                    <a href="{{ route('productDetail',['slug'=>$product->slug]) }}" class="item-link">
                                        <div class="thumb-item">
                                        <img src="{{ url($product->feature_img_path) }}" title="{{ $product->name }}" class="">  
                                        </div>                                   
                                        <div class="item-detal">
                                            <div class="item-info">
                                                <h5 class="item-name">{{ $product->name }}</h5>
                                                <span class="item-price">{{ number_format($product->price) }}đ</span>
                                            </div>
                                            <div class="item-show-detail">Xem chi tiết</div>
                                        </div>
                                    </a>
                                </li>
                           @endforeach
                        </ul>
                    </div>
                </div>
            <div class="baner-ads-sidebar mt-md-3">
                <img src="{{ asset('images/banner.png') }}" alt="">
            </div>
        </div>
        <div class="col-md-9 content pl-md-4">
            <div id="page-wp">
                <div class="page-title">{!! $post->title !!}</div>
                <div class="create-page"><span><i class="fa-solid fa-clock"></i></span> {{ $post->created_at }}</div>
                <div class="page-content">
                  {!! $post->content !!}                
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection