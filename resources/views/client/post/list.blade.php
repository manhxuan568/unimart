@extends('layouts.client')
@section('content')
<div class="container px-0" id="content-wp-product">
    <div class="section" id="breadcrumb-wp">
        <ul class="breadcrumb mb-md-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="link-page"><i class="fa-solid fa-house"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="" class="link-page">Bài viết</a></li>
        </ul>
    </div>
<div class="row main-content-wp no-gutters">
    <div class="col-md-3 sidebar pl-0">
        <div class="category-product">
            <div class="title-section">
                <h5 >DANH MỤC SẢN PHẨM</h5>   
            </div>
            <div class="body-section">
                {!! render_menu($list_category, 'main-menu', 0, 0) !!}  
            </div> 
        </div>
        <!-- // -->
        <div class="top-selling-products mt-md-4">
                <div class="title-section">
                    <h5 >SẢN PHẨM BÁN CHẠY</h5>   
                </div>
                <div class="body-section">
                    <ul class="list-products-top">
                        @foreach ($productTopSale as $product)
                               <li class="item">
                                    <a href="{{ route('productDetail',$product->slug) }}" class="item-link">
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
            <img src="{{ url('public/images/banner.png') }}" alt="">
        </div>
    </div>
    <div class="col-md-9 content pl-md-4">
        <div id="posts-wp">
            @if (!empty($posts))
            <ul class="list-post">
                @foreach ($posts as $post)
                   <li class="post-item">
                    <a href="{{ route('postDetail',$post->slug) }}" class="post-thumb" title="{{ $post->title }}"><img src="{{ url("{$post->thumb_post}") }}" alt=""></a>
                    <div class="post-detail">
                        <a href="{{ route('postDetail',$post->slug) }}" class="post-title">{{ $post->title }}</a>
                        <span class="create-post"> {{ $post->created_at }}</span>
                        {{-- <p class="post-desc">Theo luật mới, Tổng thống Nga Vladimir Putin có thể tái tranh cử nhiệm kỳ thứ năm, song ông chưa quyết định có chạy đua nhiệm kỳ mới vào năm 2024.</p>   --}}
                    </div>
                </li> 
                @endforeach  
            </ul>
            @endif
            
        </div>
    </div>
</div>
</div>    
@endsection