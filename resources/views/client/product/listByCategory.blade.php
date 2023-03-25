@extends('layouts.client')
@section('content')
<div class="container px-0" id="content-wp-product">
    <div class="section" id="breadcrumb-wp">
        <ul class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="" class="link-page"><i class="fa-solid fa-house"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="" class="link-page">Sản phẩm</a></li>
        </ul>
    </div>
<div class="row main-content-wp no-gutters">
    <div class="col-md-3 sidebar pl-0">
            <div class="category-product">
                <div class="title-section">
                 <h5 >DANH MỤC SẢN PHẨM</h5>   
                </div>
                <div class="body-section">
                  {{-- <ul class="main-menu">
                    <li class="menu-item"><a href="">Thiết bị điện tử</a>
                    <li class="menu-item"><a href="">Điện thoại và máy tính bản</a>
                      <ul class="sub-menu">
                        <li class="sub-item"><a href="">Điện thoại</a>
                            <ul class="sub-menu">
                                <li class="sub-item"><a href="">Điện thoại iphone</a>
                                <li class="sub-item"><a href="">Điện thoại sam sung</a>
                            </ul>
                                <i class="fa-solid fa-chevron-right arrow"></i>
                        
                        <li class="sub-item"><a href="">Máy tính bảng</a>
                      </ul>
                        <i class="fa-solid fa-chevron-right arrow"></i>
                    
                    <li class="menu-item"><a href="">Đồng hồ</a>
                    <li class="menu-item"><a href="">Máy tính & Laptop</a>
                            <ul class="sub-menu">
                                <li class="sub-item"><a href="">Máy tính</a>
                                <li class="sub-item"><a href="">Laptop</a>
                            </ul>
                            <i class="fa-solid fa-chevron-right arrow"></i>
                    
                    <li class="menu-item"><a href="">Phụ kiện</a>
                  </ul>   --}}
                  {!! render_menu($list_category, 'main-menu', 0, 0) !!}
                </div> 
            </div>
            <!-- // -->
            <div class="section fillter-product-wp" id="fillter-wp" data-slug="" data-link="http://localhost/Project-Laravel/unimart">
                <div class="title-section">
                    <h5 >BỘ LỌC SẢN PHẨM</h5>   
                </div>
                <div class="body-section">
                    <table>
                        <thead>
                            <tr><th class="filter-title">Giá</th></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="checkbox" name="price" class="filter price" value="500000" id="price1" {{ request()->price==500000?'checked':'' }}></td>
                                <td><label for="price1">Dưới 500.000đ</label></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="price" class="filter price" value="1000000" id="price2" {{ request()->price==1000000?'checked':'' }}></td>
                                <td><label for="price2">500.000đ - 1.000.000đ</label></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="price" class="filter price" value="5000000" id="price3" {{ request()->price==5000000?'checked':'' }}></td>
                                <td><label for="price3">1.000.000đ - 5.000.000đ</label></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="price" class="filter price" value="10000000" id="price4" {{ request()->price==10000000?'checked':'' }}></td>
                                <td><label for="price4">5.000.000đ - 10.000.000đ</label></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="price" class="filter price" value="10000001" id="price5" {{ request()->price==10000001?'checked':'' }}></td>
                                <td><label for="price5">Trên 10.000.000đ</label></td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <thead>
                            <tr>
                                <th class="filter-title">Hãng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($list_brand))
                            @php
                                $t=0;
                            @endphp
                              @foreach ($list_brand as $item)
                              @php
                                  $t++;
                              @endphp
                                <tr>
                                    <td><input type="checkbox" name="brand" class="filter brand" value="{{ $item->id }}" id="brand{{ $t }}" {{ request()->brand==$item->id?'checked':'' }}></td>
                                    <td><label for="brand{{ $t }}">{{ $item->name }}</label></td>
                                </tr>
                              @endforeach                        
                            @endif     
                        </tbody>
                    </table>
                </div>  
            </div>
            <div class="baner-ads-sidebar mt-md-3">
                <img src="{{ asset('images/banner.png') }}" alt="">
            </div>
    </div>
    <!-- //end-sideber -->
    <div class="col-md-9 content pl-md-4">
        <div class="section featured-p-wp" id="list-products-cat-wp"> 
            <div class="title-section">
                <h5 style="float:left;">SẢN PHẨM</h5>
                <div class="filter-wp">
                    <div class="section-desc">Hiển thị {{ count($products) }} trên {{ $count_all_product }} sản phẩm</div>
                        <div class="form-filter">
                            <form action="" method="post">
                                <select name="sort" class="select-filter">
                                    <option class="sort" value="" {{ request()->sort!=''?'':'selected' }}>Sắp xếp</option>
                                    <option value="az" class="sort sort1" {{ request()->sort=='az'?'selected':'' }}>Từ A-Z</option>
                                    <option value="za" class="sort sort2" {{ request()->sort=='za'?'selected':'' }}>Từ Z-A</option>
                                    <option value="hs" class="sort sort3" {{ request()->sort=='hs'?'selected':'' }}>Giá cao xuống thấp</option>
                                    <option value="sh" class="sort sort4" {{ request()->sort=='sh'?'selected':'' }}>Giá thấp lên cao</option>
                                </select>
                            </form>
                            @if (request()->key_word)
                                <div class="key-search">Tìm kiếm với từ khóa: <strong>{{ request()->key_word }}</strong></div>                               
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="body-section" id="list-products-phone">
                @if(count($products) > 0)
                @foreach ($products as $item)
                    <div class="item-p">
                        <a href="{{ route('productDetail',$item->slug,$item->id) }}" class="item-links">
                            <div class="item-thumb"><img src="{{ url($item->feature_img_path) }}" alt=""></div>
                            <div class="item-title">{{ $item->name }}</div>                           
                            @if (!empty($item->price_old) && $item->price_old > 0)
                            <div class="item-price">{{ number_format($item->price) }}đ
                            <span class="item-price-old">{{ number_format($item->price_old) }}đ</span>
                            </div>   
                            @else
                              <div class="item-price">{{ number_format($item->price) }}đ</div>  
                            @endif
                            @if (!empty($item->price_old) && $item->price_old > 0)
                             <div class="product__price--percent"><p class="product__price--percent-detail">{{ discount($item->price,$item->price_old) }}% giảm</p></div>   
                            @endif  
                            <div class="item-link-buy">
                                <a href="http://" class="link add-card">Thêm giỏ hàng</a>
                                <a href="http://" class="link buy-now">Mua ngay</a>
                            </div> 
                        </a>
                    </div> 
                @endforeach     
                @else
                <p>Không tìm thấy sản phẩm nào.</p>      
                @endif
            </div>
             {{ $products->links() }}
        </div>              
    </div>
</div>
</div>
@endsection