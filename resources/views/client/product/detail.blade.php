@extends('layouts.client')
@section('content')
<div class="container px-0" id="content-wp-product">
    <div class="section" id="breadcrumb-wp">
        <ul class="breadcrumb mb-md-0">
            <li class="breadcrumb-item"><a href="" class="link-page"><i class="fa-solid fa-house"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="" class="link-page">Chi tiết sản phẩm</a></li>
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
        <div class="section" id="detail-product-wp">
            <div class="section-detail">
                <div class="thumb-wp">
                    <a title="" id="main-thumb">
                        <div class="zoomWrapper" style="width:350px;height:350px;">
                            <img id="zoom" src="{{ url($item->feature_img_path) }}" data-zoom-image="{{ url($item->feature_img_path) }}" style="position: absolute;"/>
                        </div>
                    </a>
                    <div id="list-thumb" class="owl-theme owl-carousel">
                        @foreach (json_decode($item->list_img_product) as $itemchi)
                            <a data-image="{{ url($itemchi->name) }}" data-zoom-image="{{ url($itemchi->name) }}">
                                <img id="zoom" src="{{ url($itemchi->name) }}" />
                            </a>
                        @endforeach
                            
                            
                    </div>
                </div>
                <div class="info">
                    <h3 class="product-name">{{ $item->name }}</h3>
                    <div class="desc">
                        {!! $item->desc !!}
                    </div>
                    <div class="num-product">
                        <span class="title">Sản phẩm: </span>
                        <span class="status">Còn {{ $item->num }} sản phẩm</span>
                    </div>
                    <p class="price">{{ number_format($item->price) }}đ</p>
                    <div id="num-order-wp">
                        <a id="minus" class="minus-detail"><i class="fa fa-minus"></i></a>
                        <input type="text" name="num-order" value="1" id="num-order" class="product-qty-detail">
                        <a id="plus" class="plus-detail"><i class="fa fa-plus"></i></a>
                    </div>
                    <a href="" title="Thêm giỏ hàng" class="add-cart art-to-cart" data-qty="" data-slug="{{ $item->slug }}">Thêm giỏ hàng</a>
                </div>
            </div>    
        </div>
        <div class="section" id="similar-product-wp">
            <div class="section-title">
                <h4>Sản phẩm tương tự</h4>   
            </div>
            <div class="section body-section list-similar-products">
                <div class="owl-carousel owl-theme list-productSame">
                    @foreach ($productTopSale as $product)
                        <div class="item">
                            <a href="{{ route('productDetail',$product->slug) }}" class="item-links">
                                    <div class="item-thumb"><img src="{{ url($product->feature_img_path) }}" alt=""></div>
                                    <div class="item-title">{{ $product->name }}</div>
                                    @if (!empty($product->price_old) && $product->price_old > 0)
                                    <div class="item-price">{{ number_format($product->price) }}đ
                                    <span class="item-price-old">{{ number_format($product->price_old) }}đ</span>
                                    </div>   
                                    @else
                                    <div class="item-price">{{ number_format($product->price) }}đ</div>  
                                    @endif
                                    @if (!empty($product->price_old) && $product->price_old > 0)
                                    <div class="product__price--percent"><p class="product__price--percent-detail">{{ discount($product->price,$product->price_old) }}% giảm</p></div>   
                                    @endif  
                                    <div class="item-link-buy">
                                        <a href="http://" class="link add-card">Thêm giỏ hàng</a>
                                        <a href="http://" class="link buy-now">Mua ngay</a>
                                    </div> 
                            </a>
                        </div>
                    @endforeach           
                </div>
            </div>
        </div>
        <div class="section" id="post-product-wp">
            <div class="section-title">
                <h4>Mô tả sản phẩm</h4>   
            </div>
            <div class="body-section">
                <div class="seeMore"><span>Xem thêm<i class="fa-solid fa-caret-down"></i></span></div>
                {!! $item->content !!}
            </div>                
        </div>
    </div>
</div>
</div>
@endsection