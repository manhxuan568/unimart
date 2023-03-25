<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inport/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/project-cv/newspaper.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <title>New Spaper</title>
</head>

<body>

    <div id="wrapper">
        <div id="header">
            <div class="container justify-content-between">
                <div class="logo">
                    <a href="">
                        <img src="{{ asset('images/logo-un.png') }}" alt="">
                    </a>
                </div>
                <form action="" id="search">
                    <input type="text" name="q" placeholder="Bạn muốn tìm gi?">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
            <div class="container">
                <nav>
                    <ul class="main-menu d-flex">
                        <li><a href="">Trang chủ</a></li>
                        <li class="active"><a href="">Thời trang</a></li>
                        <li><a href="">Đời sống</a></li>
                        <li><a href="">Xã hội</a></li>
                        <li><a href="">Bóng đá</a></li>
                        <li><a href="">Video</a></li>
                        <li><a href="">Sự kiện</a></li>
                        <li><a href="">Liên hệ</a></li>
                    </ul>
                </nav>
            </div>

        </div>
        <!-- ================End-Header=============== -->

        <div id="wp-featured-post">
            <div class="container">
                <div class="box">
                    <div class="box-head">
                        <h3>Nổi bật</h3>
                    </div>
                    <div class="box-body">
                        <ul class="list-featured-post d-flex justify-content-between">
                            <li>
                                <a href="" class="post-thumb">
                                    <img src="{{ asset('images/post-1.png') }}" alt="">
                                </a>
                                <a href="" class="post-title-featured">Xu hướng thời trang hè 2020: Những mảnh ghép đáng
                                    được chú
                                    ý</a>
                            </li>
                            <li>
                                <a href="" class="post-thumb">
                                    <img src="{{ asset('images/post-2.png') }}" alt="">
                                </a>
                                <a href="" class="post-title-featured">Buổi trình diễn thời trang mùa xuân tại Đại học
                                    Michigan
                                    đã bắt đầu</a>
                            </li>
                            <li>
                                <a href="" class="post-thumb">
                                    <img src="{{ asset('images/post-3.png') }}" alt="">
                                </a>
                                <a href="" class="post-title-featured">Bật mí cách mặc đẹp cho người mập trở nên thon
                                    gọn</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- ==============end-wp-featured======= -->
        <div id="wp-content">
            <div class="container">
                <div id="content">
                    <div class="post-new">
                        <div class="box ">
                            <div class="box-head">
                                <h3>Bài viết mới</h3>
                            </div>
                            <div class="box-body">
                                <ul class="list-post">
                                    <li>
                                        <a href="" class="post-thumb">
                                            <img src="{{ asset('images/thumb-1.png') }}" alt="">
                                        </a>
                                        <div class="more-info">
                                            <a href="" class="post-title">Bạn có phải là một người phụ nữ có phong
                                                cách?</a>
                                            <div class="post-publisher">
                                                <a href="">xuanmanh</a>
                                                <span class="date">10/08/2020</span>
                                            </div>
                                            <p class="excerpts">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua. Quis ipsum
                                                suspendisse
                                                ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel
                                                facilisis.
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="" class="post-thumb">
                                            <img src="{{ asset('images/thumb-2.png') }}" alt="">
                                        </a>
                                        <div class="more-info">
                                            <a href="" class="post-title">Cách để bạn ltuôn tỏa sáng trước đám đông</a>
                                            <div class="post-publisher">
                                                <a href="">xuanmanh</a>
                                                <span class="date">10/08/2020</span>
                                            </div>
                                            <p class="excerpts">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua. Quis ipsum
                                                suspendisse
                                                ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel
                                                facilisis.
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="" class="post-thumb">
                                            <img src="{{ asset('images/thumb-3.jpg') }}" alt="">
                                        </a>
                                        <div class="more-info">
                                            <a href="" class="post-title">Những kiểu tóc mới là xu hướng của giới trẻ
                                                2020</a>
                                            <div class="post-publisher">
                                                <a href="">xuanmanh</a>
                                                <span class="date">10/08/2020</span>
                                            </div>
                                            <p class="excerpts">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua. Quis ipsum
                                                suspendisse
                                                ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel
                                                facilisis.
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="" class="post-thumb">
                                            <img src="{{ asset('images/thumb-4.jpg') }}" alt="">
                                        </a>
                                        <div class="more-info">
                                            <a href="" class="post-title">15 địa điểm du lịch nổi tiếng bạn cần đến tại
                                                Việt Nam</a>
                                            <div class="post-publisher">
                                                <a href="">xuanmanh</a>
                                                <span class="date">10/08/2020</span>
                                            </div>
                                            <p class="excerpts">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua. Quis ipsum
                                                suspendisse
                                                ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel
                                                facilisis.
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="" class="post-thumb">
                                            <img src="{{ asset('images/pic-7.jpg') }}" alt="">
                                        </a>
                                        <div class="more-info">
                                            <a href="" class="post-title">Hãy xách balo lên và đi và trải nghiệm những
                                                khoảnh khắc thú vị</a>
                                            <div class="post-publisher">
                                                <a href="">xuanmanh</a>
                                                <span class="date">10/08/2020</span>
                                            </div>
                                            <p class="excerpts">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua. Quis ipsum
                                                suspendisse
                                                ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel
                                                facilisis.
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="" class="post-thumb">
                                            <img src="{{ asset('images/pic-8.jpg') }}" alt="">
                                        </a>
                                        <div class="more-info">
                                            <a href="" class="post-title">Top 10 nữ hoàng DJ nỗi tiếng nhất Las Vegas
                                                bạn cần biết</a>
                                            <div class="post-publisher">
                                                <a href="">xuanmanh</a>
                                                <span class="date">10/08/2020</span>
                                            </div>
                                            <p class="excerpts">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua. Quis ipsum
                                                suspendisse
                                                ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel
                                                facilisis.
                                            </p>
                                        </div>
                                    </li>


                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ======================end-content============== -->
                <div id="sidebar">
                    <div class="ads">
                        <img src="{{ asset('images/sidebar.png') }}" alt="">
                    </div>
                    <div class="box top-topic">
                        <div class="box-head">
                            <h3>Chủ đề quan tâm</h3>
                        </div>
                        <div class="box-body">
                            <ul class="topic">
                                <li><a href="">Thời trang<span class="num-post">20</span></a></li>
                                <li><a href="">Đời sống<span class="num-post">30</span></a></li>
                                <li><a href="">Xã hội<span class="num-post">26</span></a></li>
                                <li><a href="">Bóng đá<span class="num-post">35</span></a></li>
                                <li><a href="">Điện ảnh<span class="num-post">29</span></a></li>
                                <li><a href="">Du lịch<span class="num-post">15</span></a></li>
                                <li><a href="">Sự kiện<span class="num-post">34</span></a></li>
                                <li><a href="">Nội trợ<span class="num-post">45</span></a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- ===================end-wp-content============== -->
        <div id="footer">
            <div class="container footer-p">
                <div class="logo-footer">
                    <img src="{{ asset('images/logo-un.png') }}" alt="">
                </div>
                <div class="box about-us">
                    <div class="box-head">
                        <h3>Về chúng tôi</h3>
                    </div>
                    <div class="box-body">
                       <p>Unitop.vn là hệ thống đào tạo lập trình web online theo lộ trình từng bước. Hệ thống phát triển
                        từ tháng 6/2017 đến nay đã có gần 2.000 người theo học và đạt kết quả tốt.</p> 
                        <a href="http://unitop.vn">http://unitop.vn</a>
                    </div>
                </div>
                <div class="box follow-us">
                    <div class="box-head">
                        <h3>Theo dõi</h3>
                    </div>
                    <div class="box-body">
                        <ul class="list-social d-flex">
                            <li><a href=""><i class="fa-brands fa-facebook-square"></i></a></li>
                            <li><a href=""><i class="fa-brands fa-instagram"></i></a></li>
                            <li><a href=""><i class="fa-brands fa-youtube-square"></i></a></li>
                            <li><a href=""><i class="fa-brands fa-pinterest"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- ======================end-footer================== -->
        <div id="wp-copyright">
            <div class="container justify-content-between">
                <div class="copyright">
                    <p>© Unitop.vn - Html Css</p>
                </div>
                <ul class="footer-menu d-flex">
                    <li><a href="">Bảo mật</a></li>
                    <li><a href="">Quảng cáo</a></li>
                    <li><a href="">Liên hệ</a></li>
                </ul>
            </div>
        </div>
        <!-- ====================end-wp-copyright============ -->
    </div>
</body>

</html>