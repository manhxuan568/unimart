<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/inport/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owlcarousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owlcarousel/assets/owl.theme.default.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="{{ asset('responsive.css') }}">
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/elevatezoom-master/jquery.elevatezoom.js') }}"></script>
    <script src="{{ asset('css/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('css/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <title>Home</title>
</head>

    <body>
        <div id="wrapper">
            <div id="header">
                <div class="header-wp1">
                    <div class="container header-top">
                        <a class="header-wp1-logo" href="{{ route("home") }}"><img src="{{ asset('images/logo.png') }}" alt=""></a>
                        <div class="icon-card">
                            <a href="{{ url('gio-hang') }}" class="show-card">
                                <i class="fa-solid fa-cart-shopping icon"></i>
                                <span class="product-num">{{ Cart::count() }}</span>
                            </a> 
                        </div>
                        <a href="#" class="payment-link"><i class="fa-solid fa-link"></i>Hình thức thanh toán</a>
                        <nav>
                            @if (!empty($menus))
                                    <ul class="menu-top">
                                        @foreach ($menus as $menu)
                                        <li class="menu-item"><a href="{{ url("{$menu->link}") }}">{{ $menu->name }}</a></li>  
                                        @endforeach
                                    </ul>
                            @endif                         
                        </nav>
                    </div>
                </div>
                <div class="header-wp2">
                    <div class="container header-body">
                        <a class="logo-wed" href="{{ route("home") }}"><img src="{{ asset('images/logo.png') }}" alt=""></a>
                        <div class="search-wp">
                            <form action="{{ url('san-pham.html') }}" method="get">
                                <input type="text" name="key_word" id="search-keyword" data-url="{{ url('search') }}" placeholder="Tìm kiếm sản phẩm">
                                <button type="submit" name="btn-search" id="button-search" value="Tìm kiếm">Tìm kiếm</button>
                            </form>
                            <div class="search_ajax"></div>
                        </div>
                        <div class="navbar-toggle"><i class="fa-solid fa-bars"></i></div>
                        <div class="tel-consultation">
                            <div class="phone">
                                <a href="" class="phone-icon"><i class="fa-solid fa-phone-volume"></i></a>
                                <div class="phone-body">
                                    <span>Tư vấn:<br><span>0979123599</span></span>
                                </div>
                            </div>

                            <div class="card-wp">
                                <div class="icon-card">
                                <a href="{{ url('gio-hang') }}" class="show-card">
                                    <i class="fa-solid fa-cart-shopping icon"></i>
                                    <span class="product-num">{{ Cart::count() }}</span>
                                </a> 
                                </div>
                                
                                <div class="card-detail {{ Cart::count()>0?'hover':'' }}">
                                    <p>Có <strong class="alert_count">{{ Cart::count() }} sản phẩm</strong> trong giỏ hàng.</p>
                                    <ul class="list_product">
                                     @foreach (Cart::content() as $row)
                                         <li class="pro-item">
                                            <div class="product-thumb"><a href="{{ route('productDetail',$row->options->slug) }}"><img h-100 src="{{ url($row->options->thumbnail) }}"
                                                        alt=""></a></div>
                                            <div class="pro-info">
                                                <div class="product-name">{{ $row->name }}</div>
                                                <div class="price">Giá: {{ number_format($row->price) }}đ</div>
                                                <div class="qty">Số lượng: {{ $row->qty }}</div>
                                            </div>
                                        </li>
                                     @endforeach
                                        
                                    </ul>
                                    <div class="price">Tổng: <span>{{ Cart::total() }}đ</span></div>
                                    <a href="{{ url('gio-hang') }}" class="link link-card">Giỏ hàng</a>
                                    <a href="{{ url('thanh-toan') }}" class="link link-pay">Thanh toán</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!! navbar_toggle_menu($list_category,"menu-toggle", 0,0) !!}
            </div>
            <div class="modal-wp">
                <div class="modal-inner">
                    <div class="modal__header">  
                        <i class="fas fa-times"></i>
                    </div>
                    <div class="modal__body">
                        <lottie-player id="firstLottie" class="modal__puppop" src="https://assets1.lottiefiles.com/packages/lf20_jbrw3hcz.json" style="width:100%; height: 150px;" loop autoplay>"></lottie-player>
                        <p class="text-successs">Thêm sản phẩm vào giỏ hàng.</p>
                    </div>
                    <div class="modal__footer">
                         <a href="{{ url('gio-hang') }}" class="urlCart">Tới giỏ hàng</a>
                         <a class="cancel">Ở lại trang</a>
                    </div>
                </div>
            </div>
            <input type="hidden" id="urlAddToCart" name="" data-url="{{ url('add') }}">
                @yield('content')
            <div id="footer-wp">
                <div id="footer-top">
                    <div class="container footer">
                        <div class="row no-gutters">
                            <div class="col-md-3 col-12">
                                <h3 class="f-logo">ISMART</h3>
                                <p class="f-commit">
                                    ISMART luôn cung cấp luôn là sản phẩm chính hãng có thông tin rõ ràng, chính sách ưu đãi cực lớn cho khách hàng có thẻ thành viên.
                                </p>
                                <div class="logo-bank">
                                    <img src="{{ asset('images/img-foot.png') }}" alt="">
                                </div> 
                            </div>
                            <div class="col-md-3 col-12">
                                <h5>Thông tin cửa hàng</h5>
                                <p><span></span>106-Trần Bình-Cầu Giấy-Hà Nội</p>
                                <p><span></span>0987.654.321 -<br>0989.989.989</p>
                                <p><span></span>vshop@gmail.com</p>
                            </div>
                            <div class="col-md-3 col-12">
                                <h5>Chính sách và ưu đãi</h5>
                                <ol>
                                    <li>*<a href="" class="warranty-policy">Trả hàng và hoàn tiền</a></li>
                                    <li>*<a href="" class="warranty-policy">Chính sách bảo hàng</a></li>
                                    <li>*<a href="" class="warranty-policy">Giải quyết khiếu nại</a></li>
                                </ol>
                            </div>
                            <div class="col-md-3 col-12">
                            <h5>Bản tin</h5>
                            <p>Đăng ký với chúng tôi để nhận được thông tin ưu đãi sớm nhất</p>
                            <form>
                                <input type="text" name="" id="uu-dai" placeholder="Nhập email tại đây">
                                <button>Đăng ký</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>    
                <div id="footer-bot">
                <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="copy-right">
                                    <span>© Bản quyền thuộc về XuanManh-Unitop</span>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>      
            </div>
            <div id="btn-top"><img src="{{ asset('images/icon-to-top.png') }}" alt=""></div>
        </div>
    </body>
</html>