<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <title>Đồ án Fashion</title>
</head>

<body>
    <style>
        #header {
            background-color: #000000;
        }

        ul.main-menu {
            list-style: none;
            margin: 0;
        }

        ul.main-menu li {
            padding: 15px 15px;
        }

        .search {
            border: none;
            background-color: none;
            padding: none;
            font-size:20px;
        }
        .item-menu a {
            text-decoration: none;
            color: #fff;
        }

        ul.main-menu>li.item-menu:hover>a {
            color: #e2524a;
        }

        ul.main-menu ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        ul.main-menu li {
            float: left;
            position: relative;
        }

        ul.main-menu ul li {
            padding-bottom: 15px;

        }

        ul.main-menu ul li a {

            color: #5c5b5b;
        }

        ul.main-menu ul li:hover a {
            color: #e2524a;

        }

        ul.main-menu li:hover ul.sub-menu{
            display: block;
        }
        ul.main-menu ul.sub-menu {
            position: absolute;
            
            padding-left: 30px;
            padding-right: 60px;
            min-width: 235px;
            min-height: auto;
            display:none;
            top: 55px;
            left: 0px;
            border-bottom-right-radius:  10px;
            border-bottom-left-radius:  10px;
        }
        /* ul.main-menu li ul.sub-menu:hover{
            display: block;
        } */
       

        .item-menu .sub-menu {
            z-index: 3;
        }

        #home-slide {
            z-index: 2;
        }

        .carousel-caption {
            right: 55%;
            top: 50%;
        }

        #home-slide {
            min-height: auto;
        }

        /* end */
        ul.customer-support {
            list-style: none;
            margin-top: 40px;
            margin-bottom: 30px;
        }

        .support-item {
            flex-basis: 33.33%;
            margin-left: 15px;
            margin-right: 15px;
            text-align: center;
            background: #f4f4f4;

        }

        li.support-item a {
            text-decoration: none;
            color: #434141;
        }

        li.support-item:hover a {
            color: #e2524a;
        }

        .icon-sup {
            font-size: 30px;
            padding-top: 15px;
        }

        .flex-wrap {
            flex-wrap: wrap;
        }

        .position-re {
            position: relative;
        }

        .giay {
            position: absolute;
            right: 35px;
            bottom: 35px;
        }
        .color{
            color: #e2524a;
        }
        .bg{
            background: #e2524a;
        }
        #footer{
            background-color: #212121;
        }
        .search-link{
            line-height: 0;
            width: 47px;
        }
    </style>
    <div id="wrapper">
        <div id="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div id="info-shop" class="justify-content-between d-flex text-light">

                            <div class="opening-time"><i class="fa-regular fa-clock"></i>Thứ 2 - thứ 7: 8:00am - 20:00am
                            </div>
                            <div class="email"><i class="fa-regular fa-envelope"></i>support@unitop.vn</div>
                            <div class="number"><i class="fa-solid fa-phone"></i>09888.59.692</div>
                        </div>

                        <div class="row z-index">
                            <div class="col-md-12 justify-content-between d-flex text-light mt-3 mb-2">
                                <button class="btn btn-outline-warning"><a href="#"><img src="{{ asset('img-1/UNITOP.png') }}" alt=""
                                            class="logo"></a></button>
                                <nav>
                                    <ul class="main-menu d-flex">
                                        <li class="item-menu"><a href="">TRANG CHỦ</a></li>
                                        <li class="item-menu"><a href="">GIỚI THIỆU</a></li>
                                        <li class="item-menu"><a href="">GIÀY</a></li>
                                        <li class="item-menu"><a href="">TÚI XÁCH
                                            <i class="responsive-menu-toggle fa-solid fa-angle-down"></i></a>
                                            <ul class="sub-menu bg-light">
                                                <li><a href="">Túi xách tay nữ</a></li>
                                                <li><a href="">Túi đeo chéo nữ</a></li>
                                                <li><a href="">Túi bản to</a></li>
                                                <li><a href="">Túi đeo vai</a></li>
                                            </ul>
                                        </li>
                                        <li class="item-menu"><a href="">ÁO THUN</a></li>
                                        <li class="item-menu"><a href="">ĐỒNG HỒ</a></li>
                                        <li class="item-menu"><a href="">BLOG</a></li>
                                        <li class="item-menu"><a href="">LIÊN HỆ</a></li>
                                    </ul>
                                
                                <!-- <div class="button align-items-center search-link"> -->
                                   
                                <!-- </div> -->
                            </nav>
                             <button type="submit" class="btn search text-light p-0 "><i
                                            class="fa-solid fa-magnifying-glass "></i></button>
                                    <button class="btn text-light search p-0"><i
                                            class="fa-solid fa-cart-shopping"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end-header -->
        <!--carousel-fade -->
        <div id="home-slide" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#home-slide" class="active" data-slide-to="0"></li>
                <li data-target="#home-slide" data-slide-to="1"></li>
                <li data-target="#home-slide" data-slide-to="2"></li>
                <li data-target="#home-slide" data-slide-to="3"></li>
            </ol>

            <div class="carousel-inner">
                <div class="carousel-item active " data-interval="2000">
                    <img src="{{ asset('img-1/fashion-sliderimage1.png') }}" alt="" class="d-block w-100">
                    <div class="carousel-caption text-dark">
                        <h6>Giảm giá 30%</h6>
                        <h2 class="text-danger">ÁO LEN HÀN QUỐC</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis, saepe commodi deserunt
                            minima quaerat, vero est ex sunt voluptates autem </p>
                        <button class="btn btn-dark p-2">Mua ngay</button>
                    </div>
                </div>
                <div class="carousel-item" data-interval="2000">
                    <img src="{{ asset('img-1/fashion-sliderimage1.png') }}" alt="" class="d-block w-100">
                    <div class="carousel-caption text-dark">
                        <h6>Giảm giá 30%</h6>
                        <h2 class="text-danger">ÁO LEN HÀN QUỐC</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis, saepe commodi deserunt
                            minima quaerat, vero est ex sunt voluptates autem </p>
                        <button class="btn btn-dark p-2">Mua ngay</button>
                    </div>

                </div>
                <div class="carousel-item" data-interval="2000">
                    <img src="{{ asset('img-1/fashion-sliderimage1.png') }}" alt="" class="d-block w-100">
                    <div class="carousel-caption text-dark">
                        <h6>Giảm giá 30%</h6>
                        <h2 class="text-danger">ÁO LEN HÀN QUỐC</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis, saepe commodi deserunt
                            minima quaerat, vero est ex sunt voluptates autem </p>
                        <button class="btn btn-dark p-2">Mua ngay</button>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img-1/fashion-sliderimage1.png') }}" alt="" class="d-block w-100">
                    <div class="carousel-caption text-dark">
                        <h6>Giảm giá 30%</h6>
                        <h2 class="text-danger">ÁO LEN HÀN QUỐC</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis, saepe commodi deserunt
                            minima quaerat, vero est ex sunt voluptates autem </p>
                        <button class="btn btn-dark p-2">Mua ngay</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end carousel -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="customer-support d-flex pl-0">
                        <li class="support-item"><a href="">
                                <p class="mb-0"><i class="fa-solid fa-shield-halved icon-sup"></i></p>
                                <p>Đổi trả trong 30 ngày</p>
                            </a></li>
                        <li class="support-item"><a href="">
                                <p class="mb-0"><i class="fa-solid fa-headphones icon-sup"></i></p>
                                <p>Hỗ trợ 24/7 09888.59.692</p>
                            </a></li>
                        <li class="support-item"><a href="">
                                <p class="mb-0"><i class="fa-solid fa-truck-fast icon-sup"></i></p>
                                <p>Miễn phí ship toàn quốc</p>
                            </a></li>
                    </ul>
                </div>
                <!-- end-customer-support -->

            </div>

        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="new-product my-5 text-center">
                        <h2 class="h3 text-dark">SẢN PHẨM MỚI</h2>
                        <p class="text-secondary">Những sản phẩm là xu thế của thời trang 2018 được ưa chuộng</p>
                    </div>
                </div>
            </div>
            <!-- end-new-product -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-deck">
                        <div class="col-md-3 mb-4 px-0">
                            <div class="card">
                                <img src="{{ asset('img-1/thumb-1.jpg') }}" alt="" class="card-ing w-100">
                                <div class="card-body">
                                    <p class="card-title">Túi xách hiệu jaka Nhật</p>
                                    <span class="card-text">1.200.000đ</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4 px-0">
                            <div class="card">
                                <img src="{{ asset('img-1/thumb-2.jpg') }}" alt="" class="card-ing w-100">
                                <div class="card-body">
                                    <p class="card-title">Túi xách hiệu jaka Nhật</p>
                                    <span class="card-text">1.200.000đ</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4 px-0">
                            <div class="card">
                                <img src="{{ asset('img-1/thumb-3.jpg') }}" alt="" class="card-ing w-100">
                                <div class="card-body">
                                    <p class="card-title">Túi xách hiệu jaka Nhật</p>
                                    <span class="card-text">1.200.000đ</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4 px-0">
                            <div class="card">
                                <img src="{{ asset('img-1/thumb-4.jpg') }}" alt="" class="card-ing w-100">
                                <div class="card-body">
                                    <p class="card-title">Túi xách hiệu jaka Nhật</p>
                                    <span class="card-text">1.200.000đ</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4 px-0">
                            <div class="card">
                                <img src="{{ asset('img-1/thumb-1.jpg') }}" alt="" class="card-ing w-100">
                                <div class="card-body">
                                    <p class="card-title">Túi xách hiệu jaka Nhật</p>
                                    <span class="card-text">1.200.000đ</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4 px-0">
                            <div class="card">
                                <img src="{{ asset('img-1/thumb-2.jpg') }}" alt="" class="card-ing w-100">
                                <div class="card-body">
                                    <p class="card-title">Túi xách hiệu jaka Nhật</p>
                                    <span class="card-text">1.200.000đ</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4 px-0">
                            <div class="card">
                                <img src="{{ asset('img-1/thumb-4.jpg') }}" alt="" class="card-ing w-100">
                                <div class="card-body">
                                    <p class="card-title">Túi xách hiệu jaka Nhật</p>
                                    <span class="card-text">1.200.000đ</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4 px-0">
                            <div class="card">
                                <img src="{{ asset('img-1/thumb-1.jpg') }}" alt="" class="card-ing w-100">
                                <div class="card-body">
                                    <p class="card-title">Túi xách hiệu jaka Nhật</p>
                                    <span class="card-text">1.200.000đ</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row my-5">
                <div class="col-md-6 pr-0 position-re">
                    <img src="{{ asset('img-1/category-1.jpg') }}" alt="" class="w-100">
                    <div class="giay">
                        <h1>GIÀY</h1>
                        <button class="btn btn-dark px-4">XEM THÊM</button>
                    </div>
                </div>
                <div class="col-md-6 pl-0">
                    <img src="{{ asset('img-1/category-2.jpg') }}" alt="" class="w-100">
                    <img src="{{ asset('img-1/category-3.jpg') }}" alt="" class="w-100">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="new-product my-5 text-center">
                        <h2 class="h3 text-dark">BÁN CHẠY</h2>
                        <p class="text-secondary">Bộ sưu tập những sản phẩm bán chạy nhất hệ thống, bây giờ là của bạn</p>
                    </div>
                </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="card-deck">
                    <div class="col-md-4 px-0">
                       <div class="card">
                        <img src="{{ asset('img-1/post-1.jpg') }}" alt="" class="w-100">
                        <div class="card-body text-center">
                            <p class="card-text">Thời trang</p>
                            <h2 class="card-title h5">5 MẸO CƠ BẢN ĐỂ PHỐI ĐỒ</h2>
                            <p class="card-text text-secondary">June 10, 2020</p>
                            <p class="card-text">Tips and tricks that most people wouldn't highlight when colors.</p>
                        </div>
                       </div>
                    </div>
                     <div class="col-md-4 px-0">
                       <div class="card">
                        <img src="{{ asset('img-1/post-2.jpg') }}" alt="" class="w-100">
                        <div class="card-body text-center">
                            <p class="card-text">Thời trang</p>
                            <h2 class="card-title h5">5 MẸO CƠ BẢN ĐỂ PHỐI ĐỒ</h2>
                            <p class="card-text text-secondary">June 10, 2020</p>
                            <p class="card-text">Tips and tricks that most people wouldn't highlight when colors.</p>
                        </div>
                       </div>
                    </div>
                    <div class="col-md-4 px-0">
                       <div class="card">
                        <img src="{{ asset('img-1/post-3.jpg') }}" alt="" class="w-100">
                        <div class="card-body text-center">
                            <p class="card-text">Thời trang</p>
                            <h2 class="card-title h5">5 MẸO CƠ BẢN ĐỂ PHỐI ĐỒ</h2>
                            <p class="card-text text-secondary">June 10, 2020</p>
                            <p class="card-text">Tips and tricks that most people wouldn't highlight when colors.</p>
                        </div>
                       </div>
                    </div>
                </div>


              </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center my-5">
                    <button class="btn btn-secondary px-5">XEM THÊM</button>
                </div>
            </div>
        </div>
        <!-- end-content -->
        <div id="footer">
            <div class="container">
                <div class="row py-5">
                    <div class="col-md-3 text-light">
                        <h5 class="color">ĐỊA CHỈ</h5>
                        <p><i class="fa-solid fa-location-dot pr-1"></i>Tòa nhà N01T5 Ngoại dao Đoàn, Bắc Từ Liêm, Hà nội</p>
                        <span><i class="fa-solid fa-phone pr-1"></i>09888.59.692</span><br>
                        <span><i class="fa-solid fa-envelope pr-1"></i>support@unitop.vn</span>
                    </div>
                    <div class="col-md-3 text-light">
                        <h5 class="color">GIỚI THIỆU</h5>
                        <span>Về chúng tôi</span><br>
                        <span>Cách đặt hàng</span><br>
                        <p>Kiểm tra đơn hàng</p>
                        <span>Hỗ trợ</span>
                    </div>
                    <div class="col-md-3 text-light">
                        <h5 class="color">DANH MỤC</h5>
                        <span>Giày thể thao</span><br>
                        <span>Váy</span><br>
                        <span>Kính mắt</span><br>
                        <span>Túi xách</span>
                    </div>
                    <div class="col-md-3 text-light">
                        <h5 class="color">SOCIAL</h5>
                        <span><i class="fa-brands fa-facebook pr-1"></i>Facebook</span><br>
                        <span><i class="fa-brands fa-youtube pr-1"></i>Youtube</span><br>
                        <span><i class="fa-brands fa-twitter pr-1"></i>Twitter</span>
                    </div>
                </div>
            </div>
        </div>
         <div id="copy-right" class="bg text-center py-2">
            <h6 class="text-light">© 2019 - 2025 UNITOP ACADEMY - UNITOP.VN</h6>
         </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $(".responsive-menu-toggle").click(function () {
                // $(this).toggleClass('open');
                $(this).next('.sub-menu').slideToggle();
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>
</body>

</html>