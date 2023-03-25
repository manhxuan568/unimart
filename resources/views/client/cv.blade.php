<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/inport/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cv.css') }}">
    <title>CV</title>
</head>
<body>
    <div id="cv_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <h2 class="text-center text-uppercase">Nguyễn Xuân Mạnh</h2>
                    <h3 class="text-center text-uppercase">Lập trình viên Php Laravel</h3> 
                </div>
            </div>
        </div>
        <div class="bg-wp">
            <div class="container">
                <div class="row">
                    <div class="avatar"><img src="{{ asset('images/IMG_1052-removebg-preview (1).png') }}" alt=""></div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6" id="basic_info_wp">
                  <div class="section">
                    <div class="section_title">
                        <h4>Thông tin cơ bản</h4>
                    </div>
                    <div class="section_content">
                      <p><span class="icon"><i class="fa-sharp fa-solid fa-file-signature"></i></span>Nguyễn Xuân Mạnh</p>
                      <p><span class="icon"><i class="fa-solid fa-gift"></i></span>20/01/2002</p>
                      <p><span class="icon"><i class="fa-solid fa-user"></i></span>Nam</p>
                      <p><span class="icon"><i class="fa-solid fa-envelope"></i></span>manhxuan568@gmail.com</p>
                      <p><span class="icon"><i class="fa-sharp fa-solid fa-location-dot"></i></span>Ngõ 192,Lê trọng tấn,Hà nội</p>
                    </div>
                  </div>
                    <div class="section">
                        <div class="section_title">
                            <h4>học vấn</h4>
                        </div>
                        <div class="section_content">
                            <p>Trường: Cao đẳng nghề Bách Khoa Hà Nội</p>
                            <p>Ngành học: Công nghệ thông tin</p>
                            <p>Chuyên ngành: Lập trình máy tính-Lập trình web</p>
                        </div>
                    </div>
                    <div class="section">
                        <div class="section_title">
                            <h4>Mục tiêu nghề nghiệp</h4>
                        </div>
                        <div class="section_content">
                            <h6><strong>Ngắn hạn:</strong></h6>
                            <p>Không ngừng học hỏi trao dồi kiến thức về lập trình để phát triển kỹ năng chuyên môn. Được làm nhân viên chính thức của công ty mà mình mong muốn. Sau 1 - 3 năm trở thành lập trình viên chuyên nghiệp về mảng Web.</p>
                            <h6><strong>Dài hạn:</strong></h6>
                            <p>Sau 4 - 6 năm tiếp theo cố gắng phấn đấu để được làm chức vụ quản lí về mảng lập trình web.</p>
                            <p>Sau 6 -9 năm tiếp theo tự mở công ty riêng và tìm kiếm những nhân tài để cùng phát triển công ty lớn mạnh để mang lại những giá trị thật tuyệt vời cho bản thân, gia đình và xã hội.</p>
                        </div>
                    </div>
                    <div class="section">
                        <div class="section_title">
                            <h4>dự án đã làm</h4>
                        </div>
                        <div class="section_content">
                            <h6><strong>HTML & CSS</strong></h6>
                            <p>Đây là dự án chuyển từ file PSD sang giao diện tĩnh của web.</p>
                            <span>Link web: <a href="{{ url('newspaper') }}">{{ url('newspaper') }}</a></span>
                            <h6><strong>BOOTSTRAP</strong></h6>
                            <p>Đây là dự án sử dụng framework bootstrap, để làm web nhanh hơn, có sử dụng responsive.</p>
                            <span>Link web: <a href="{{ url('project-fashion') }}">{{ url('project-fashion') }}</a></span>
                            <h6><strong>HỆ THỐNG BÁN HÀNG TRỰC TUYẾT (PHP-LARAVEL)</strong></h6>
                            <p>- Đây là dự án để khách hàng có thể tự đặt hàng online, tiết kiệm thời gian.</p>
                            <p>- Ngôn ngữ sử dụng: PHP (FRAMEWORK LARAVEL) version 7.</p>
                            <p>- Thư viện sử dụng: JQUERY và AJAX.</p>
                            <p>- Code theo mô hình MVC.</p>
                            <p>- Dự án bao gồm 2 phần: Client(phía khách hàng) và Admin(phía quản trị viên)</p>
                            <p>- Sử dụng cơ sở dữ liệu Mysql.</p>
                            <p>- Có chức năng phân quyền chuyên sâu.</p>
                            <p>- Các module của Client: sản phẩm, giỏ hàng, tìm kiếm, thanh toán, bài viết, lọc, sắp xếp sản phẩm, đặt hàng.</p>
                            <p>- Các module của Admin: user, product, post, page, slider, dashboard, role, permission với các chức năng: thêm, sửa, xóa dữ liệu, đăng nhập, đăng kí, đăng xuất, phân quyền thành viên, bán hàng, thống kê chi tiết đơn hàng.</p>
                            <p class="mb-0">- Link web:</p>
                            <span>+ Client: <a href="{{ url('/') }}">{{ url('/') }}</a></span>
                            <br><span>+ Admin: <a href="{{ url('admin') }}">{{ url('admin') }}</a></span>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6" id="skills_wp">
                     <div class="section">
                        <div class="section_title">
                            <h4>kỹ năng chuyên môn</h4>
                        </div>
                        <div class="section_content">
                            <h6><strong>HTML & CSS</strong></h6>
                            <p>- Kiến thức về HTML:</p>
                            <p>+ Biết tư duy phân tính thiết kế khung layout.</p>
                            <p>+ Nắm được các bộ thể cốt lõi để xây dựng khung HTML.</p>
                            <p>- Kiến thức về CSS</p>
                            <p>+ Các bộ chọn trong css như: selector id, selector css, selector con cháu, selectorbefor, after...</p>
                            <p>+ Các thuộc tính cho text, thuộc tính định dạng cho khối.</p>
                            <p>+ Các hiệu ứng như: làm trong suốt khối opacity, làm mềm quá trình thay đổi css với transion, Xoay khối với Rotate</p>
                            <p>+ Biết bố cục trang với Flexbox.</p>
                            <p>+ Quy tắc đặt tên chuyên nghiệp cho class, id.</p>
                            <p>+ Các plugin quan trọng: thêm google font, fontawesome, slider với owl carowsel, nhúng các tiện ích của facebook.</p>
                            <p>+ Biết cách sử dụng Photoshop cơ bản để chuyển PSD thành HTML CSS</p>
                            <h6><strong>JQUERY</strong></h6>
                            <p>- Kiến thức jquery:</p>
                            <p>+ Định vị đến các phần tử html cần tác động thông qua các nhóm selector</p>
                            <p>+ Áp dụng được các phương thức sử lí như: class, attr, value, scroll, css.</p>
                            <p>+ Biết sử dụng các hiệu ứng show, hide, slider, fadein, fadeout.</p>
                            <p>+ Bắt sự kiện bằng jquery.</p>
                            <p>+ Biết dùng ajax thực hiện thêm giỏ hàng, cập nhật giỏ hàng, tìm kiếm sản phẩm, select tỉnh thành,...</p>
                            <h6><strong>BOOTSTRAP</strong></h6>
                            <p>- Kiến thức bootstrap</p>
                            <p>+ Xây dựng layout website responsive với Grid System.</p>
                            <p>+ Nắm được các class cơ bản để xây dựng giao diện nhanh hơn. Sử dụng được các cấu trúc để xây dụng khung trong HTNL như: Navbar menu responsive, Carousel sideshow. Các loại Form, các Card trong bootstrap.</p>
                            <h6><strong>PHP</strong></h6>
                            <p>- Kiến thức Php</p>
                            <p>+ Checklist những công việc cần làm để xử lí một chức năng nào đó.</p>
                            <p>+ NẮm được dữ liệu trong php, những phép toán trong php, cấu trúc điều khiển và vòng lặp.</p>
                            <p>+ Hiểu rõ tầm quan trọng khi viết hàm và cách đặt tên hàm rõ dàng dễ hiểu.</p>
                            <p>+ Nắm được các kiểu dữ liệu truyền lên server:POST và GET</p>
                            <p>+ Biết chuyển hóa dưc liệu form.</p>
                            <p>+ Hiểu về phiên làm việc: COOKIE và SESSION.</p>
                            <p>Nắm được các thư viện hàm, hiểu được cách hoạt động của mô hình MVC(controller model view)</p>
                            <p>+ Biết làm việc giữa Php với Ajax.</p>
                            <p>+ Biết tạo đường link thân thiện(friendlyUrl) cho website</p>
                            <p>+ Biết làm việc với hệ quản trị cơ sở dữ liệu Mysql và các thao tác trên phpmyadmin.</p>
                            <h6><strong>LARAVEL</strong></h6>
                            <p>- Kiến thức Laravel:</p>
                            <p>+ Nắm được luồng xử lí trong mô hình MVC của Laravel.</p>
                            <p>+ Nắm được cách làm việc với route, controller, model, view</p>
                            <p>+ Kế thừa các layout thông qua:@ extends, @ yield, @ section.</p>
                            <p>+ Truy vấn dữ liệu thông qua Query buider, Eloquet orm validation dữ liệu.</p>
                            <p>+ Xử lí chuyển hướng với redirect() và dùng các helper có sẵn về url hoặc string.</p>
                            <p>+ Biết cách sử dụng session, cookie, phân trang, gửi mail.</p>
                            <p>+ Tích hợp laravel Auth, Shopping cart, Laravel file manager, trình soạn thảo bài viết tinycloud.</p>
                            <p>+ Xử lý thêm, cập nhật giỏ hàng bằng Ajax</p>
                            <p>+ Biết cách tạo và sử dụng middleware.</p>
                        </div>
                     </div> 
                </div>
            </div>
        </div>
    </div>
</body>
</html>