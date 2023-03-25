@extends('layouts.client')
@section('content')
<div class="container px-0" id="content-wp">
    <div class="row no-gutters">
            <div class="col-md-3 sidebal pl-0">
                <div class="category-product">
                    <div class="title-section">
                     <h5 >DANH MỤC SẢN PHẨM</h5>   
                    </div>
                    <div class="body-section">
                      {!! render_menu($list_category, 'main-menu', 0, 0) !!}
                    </div> 
                </div>
                <div class="top-selling-products mt-md-4">
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
            <div class="col-md-9 content pl-lg-4 pl-md-2 col-12">
                <div class="section" id="side-wp">
                        <div class="owl-carousel owl-theme slider-list" id="start">
                            @foreach ($sliders as $slider)
                                <div class="item">
                                    <a href="{{ $slider->link }}"><img src="{{ url($slider->thumb_slider) }}" alt=""></a>
                                </div>
                            @endforeach
                            
                        </div>
                </div>
                <div class="section" id="support-wp">
                    <ul class="list-support">
                        <li class="support-item">
                            <a href="">
                                <div class="item-thum"><img src="{{ url('public/images/icon-1.png') }}" alt=""></div>
                                <div class="item-detail">
                                    <div class="item-title">Miễn phí vận chuyển</div>
                                    <div class="item-desc">Tới tận tay khách hàng</div>
                                </div>
                            </a>
                        
                        <li class="support-item">
                            <a href="">
                                <div class="item-thum"><img src="{{ url('public/images/icon-2.png') }}" alt=""></div>
                                <div class="item-detail">
                                    <div class="item-title">Tư vấn 24/7</div>
                                    <div class="item-desc">1900-6035</div>
                                </div>
                            </a>
                        
                        <li class="support-item">
                            <a href="">
                                <div class="item-thum"><img src="{{ url('public/images/icon-3.png') }}" alt=""></div>
                                <div class="item-detail">
                                    <div class="item-title">Tiết kiệm hơn</div>
                                    <div class="item-desc">Với nhiều ưu đãi cực lớn</div>
                                </div>
                            </a>
                        
                        <li class="support-item">
                            <a href="">
                                <div class="item-thum"><img src="{{ url('public/images/icon-4.png') }}" alt=""></div>
                                <div class="item-detail">
                                    <div class="item-title">Giải ngân nhanh</div>
                                    <div class="item-desc">Hỗ trợ nhiều hình thức</div>
                                </div>
                            </a>
                        
                        <li class="support-item">
                            <a href="">
                                <div class="item-thum"><img src="{{ url('public/images/icon-5.png') }}" alt=""></div>
                                <div class="item-detail">
                                    <div class="item-title">Đặt hàng online</div>
                                    <div class="item-desc">Thao tác đơn giản</div>
                                </div>
                            </a>
                        
                    </ul>
                </div>
                <div class="section featured-p-wp" id="">
                    <div class="title-section">
                        <h5>SẢN PHẨM NỔI BẬT</h5>
                    </div>
                    <div class="section body-section list-featured-products">
                        <div class="owl-carousel owl-theme list-featured-p">
                            @foreach ($productTopWatch as $product)
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
                                            <a href="" class="link add-card art-to-cart" data-slug="{{ $product->slug }}">Thêm giỏ hàng</a>
                                            <a href="{{ route('buyNow',$product->id) }}" class="link buy-now">Mua ngay</a>
                                        </div> 
                                </a>
                                </div>
                            @endforeach
                              
                        </div>
                    </div>
                </div>
                <div class="section featured-p-wp" id="products_topSale">
                    <div class="title-section">
                        <h5>SẢN PHẨM BÁN CHẠY</h5>
                    </div>
                    <div class="section body-section list-featured-products">
                        <div class="owl-carousel owl-theme list-featured-p">
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
                                            <a href="" class="link add-card art-to-cart" data-slug="{{ $product->slug }}">Thêm giỏ hàng</a>
                                            <a href="{{ route('buyNow',$product->id) }}" class="link buy-now">Mua ngay</a>
                                        </div> 
                                </a>
                                </div>
                            @endforeach
                              
                        </div>
                    </div>
                </div>
                <div class="section featured-p-wp" id="list-products-cat-wp">
                    <div class="title-section">
                        <h5>ĐIỆN THOẠI</h5>
                    </div>
                    <div class="body-section" id="list-products-phone">
                        @foreach ($list_Phone as $product)
                            <div class="item-p">
                                <a href="{{ route('productDetail',$product->slug) }}" class="item-links">
                                    <div class="item-thumb"><img src="{{ url($product->feature_img_path) }}" alt=""></div>
                                    <div class="item-title" title="{{ $product->name }}">{{ $product->name }}</div>
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
                                        <a href="" class="link add-card art-to-cart" data-slug="{{ $product->slug }}">Thêm giỏ hàng</a>
                                        <a href="{{ route('buyNow',$product->id) }}" class="link buy-now">Mua ngay</a>
                                    </div> 
                                </a>
                            </div>
                        @endforeach
                                
                                
                    </div>
                    <!-- //máy tính và laptop -->
                    <div class="title-section">
                        <h5>MÁY TÍNH VÀ LAPTOP</h5>
                    </div>
                    <div class="body-section" id="list-products-laptop">
                        @foreach ($list_laptop as $product)
                        <div class="item-p">
                            <a href="{{ route('productDetail',$product->slug) }}" class="item-links">
                                <div class="item-thumb"><img src="{{ url($product->feature_img_path) }}" alt=""></div>
                                <div class="item-title" title="{{ $product->name }}">{{ $product->name }}</div>
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
                                    <a href="" class="link add-card art-to-cart" data-slug="{{ $product->slug }}">Thêm giỏ hàng</a>
                                    <a href="{{ route('buyNow',$product->id) }}" class="link buy-now">Mua ngay</a>
                                </div> 
                            </a>
                        </div>
                    @endforeach
                    </div>    
                </div>
            </div>
    </div>
</div>

@endsection