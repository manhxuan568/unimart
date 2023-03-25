<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/solid.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/styleAdmin.css') }}">
    
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/appAdmin.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script src="https://cdn.tiny.cloud/1/w15jm7vmxwk64tqbd4qbzvl6ymwmr0bee02f0d4rs5sgwhey/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
    var editor_config = {
        path_absolute : "http://localhost/Project-Laravel/unimart/",
        selector: '.textarea',
        relative_urls: false,
        plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table directionality",
        "emoticons template paste textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        file_picker_callback : function(callback, value, meta) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
        if (meta.filetype == 'image') {
            cmsURL = cmsURL + "&type=Images";
        } else {
            cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.openUrl({
            url : cmsURL,
            title : 'Filemanager',
            width : x * 0.8,
            height : y * 0.8,
            resizable : "yes",
            close_previous : "no",
            onMessage: (api, message) => {
            callback(message.content);
            }
        });
        }
    };

    tinymce.init(editor_config);
  </script>
   
    <title>Admintrator</title>
</head>

<body>
    <div id="warpper" class="nav-fixed">
        <nav class="topnav shadow navbar-light bg-white d-flex">
            <div class="navbar-brand"><a href="?">UNITOP ADMIN</a></div>
            <div class="nav-right ">
                <div class="btn-group mr-auto">
                    <button type="button" class="btn dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="plus-icon fas fa-plus-circle"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ url('admin/post/add') }}">Thêm bài viết</a>
                        <a class="dropdown-item" href="{{ url('admin/product/add') }}">Thêm sản phẩm</a>
                        <a class="dropdown-item" href="{{ url('admin/order/list') }}">Xem đơn hàng</a>
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Tài khoản</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        <!-- end nav  -->
    @php
        $module_active = session('module_active');
    //    dd($module_active)
    @endphp

        <div id="page-body" class="d-flex">
            <div id="sidebar" class="bg-white">
                <ul id="sidebar-menu">
                    <li class="nav-link">
                        <a href="{{ url('dashboard') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Dashboard
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                    </li>
                    <li class="nav-link {{ $module_active == 'page'?'active':'' }}">
                        <a href="{{ url('admin/page/list') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Trang
                        </a>
                        <i class="arrow fas fa-angle-right"></i>

                        <ul class="sub-menu">
                            <li><a href="{{ url('admin/page/add') }}">Thêm mới</a></li>
                            <li><a href="{{ url('admin/page/list') }}">Danh sách</a></li>
                        </ul>
                    </li>
                    <li class="nav-link {{ $module_active == 'slider'?'active':'' }}">
                        <a href="{{ url('admin/slider/list') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Slider
                        </a>
                        <i class="arrow fas fa-angle-right"></i>

                        <ul class="sub-menu">
                            <li><a href="{{ url('admin/slider/add') }}">Thêm mới</a></li>
                            <li><a href="{{ url('admin/slider/list') }}">Danh sách</a></li>
                        </ul>
                    </li>
                    <li class="nav-link {{ $module_active == 'post'?'active':'' }}">
                        <a href="{{ url('admin/post/list') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Bài viết
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                        <ul class="sub-menu">
                            <li><a href="{{ url('admin/post/add') }}">Thêm mới</a></li>
                            <li><a href="{{ url('admin/post/list') }}">Danh sách</a></li>
                            <li><a href="{{ url('admin/post/cat/list') }}">Danh mục</a></li>
                        </ul>
                    </li>
                    <li class="nav-link {{ $module_active == 'product'?'active':'' }}">
                        <a href="{{ url('admin/product/list') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Sản phẩm
                        </a>
                        <i class="arrow fas fa-angle-down"></i>
                        <ul class="sub-menu">
                            <li><a href="{{ url('admin/product/add') }}">Thêm mới</a></li>
                            <li><a href="{{ url('admin/product/list') }}">Sản phẩm</a></li>
                            <li><a href="{{ url('admin/product/cat/list') }}">Danh mục</a></li>
                            <li><a href="{{ url('admin/product/brand/list') }}">Các hãng</a></li>
                        </ul>
                    </li>
                    <li class="nav-link {{ $module_active == 'order'?'active':'' }}">
                        <a href="{{ url('admin/order/list') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Bán hàng
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                        <ul class="sub-menu">
                            <li><a href="{{ url('admin/order/list') }}">Đơn hàng</a></li>
                        </ul>
                    </li>
                    <li class="nav-link {{ $module_active == 'user'?'active':'' }}">
                        <a href="{{ url('admin/user/list') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Users
                        </a>
                        <i class="arrow fas fa-angle-right"></i>

                        <ul class="sub-menu">
                            <li><a href="{{ url('admin/user/add') }}">Thêm mới</a></li>
                            <li><a href="{{ url('admin/user/list') }}">Danh sách</a></li>
                        </ul>
                    </li>
                    <li class="nav-link {{ $module_active == 'menu'?'active':'' }}">
                        <a href="{{ url('admin/menu/list') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Menus
                        </a>
                        <i class="arrow fas fa-angle-right"></i>

                        <ul class="sub-menu">
                            <li><a href="{{ url('admin/menu/add') }}">Thêm mới</a></li>
                            <li><a href="{{ url('admin/menu/list') }}">Danh sách</a></li>
                        </ul>
                    </li>
                    @can('list-role')
                        <li class="nav-link {{ $module_active == 'role'?'active':'' }}">
                            <a href="{{ url('admin/role/list') }}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"></i>
                                </div>
                                Danh sách vai trò
                            </a>
                            <i class="arrow fas fa-angle-right"></i>

                            <ul class="sub-menu">
                                <li><a href="{{ url('admin/role/add') }}">Thêm mới</a></li>
                                <li><a href="{{ url('admin/role/list') }}">Danh sách</a></li>
                            </ul>
                        </li>
                    @endcan
                    
                    @can('list-permission')
                        <li class="nav-link {{ $module_active == 'permission'?'active':'' }}">
                            <a href="{{ url('admin/permission/list') }}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"></i>
                                </div>
                                Danh sách các quyền
                            </a>
                            <i class="arrow fas fa-angle-right"></i>

                            <ul class="sub-menu">
                                <li><a href="{{ url('admin/permission/create') }}">Thêm mới</a></li>
                                <li><a href="{{ url('admin/permission/list') }}">Danh sách quyền</a></li>
                            </ul>
                        </li>
                    @endcan
                    

                </ul>
            </div>
            <div id="wp-content">
                @yield('content')
            </div>
            
        </div>       
    </div>
    <script>
        $(document).ready(function(){
    
      //Hàm xóa thumnail
     function deleteThumb(id_thumb_delete){
        let data = {
            'id_thumb_delete':id_thumb_delete,
            "_token": '{{ csrf_token() }}',
        }
        $.ajax({
            url: "{{ route('deleteThumnail') }}",
            type: 'POST',
            data: data,
            dataType: 'text',
            success: function(data2){
                $(".list-img").html(data2);
                location.reload(true);
                //Thêm class tick
                // $('.thumbnail-post').dblclick(function(){
                //     $('.thumbnail-post').children('.img-thumbnail').removeClass('tick');
                //     $(this).children('.img-thumbnail').addClass('tick');
                //     var id_thumb = $(this).children('.img-thumbnail').attr('data-id');
                //     tickChoseImage(id_thumb);
                // })
                //Xóa ảnh thumnail
                // $('.item-thumb .closee').click(function(){
                //     var id_thumb_delete = $('.item-thumb .closee').next('.img-thumbnail').attr('data-id');
                //     console.log(id_thumb_delete);
                //     deleteThumb(id_thumb_delete);
                // })
            },
            error: function (xhr, ajaxOption, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    }
         
      //   //gửi id thumnail được tick đến session thông qua ajax
      //   function tickChoseImage(id_thumb){
      //         let data = {
      //             'id_thumb':id_thumb,
      //             "_token": 'YvHTImNvKDac08G44vPxc1PCIxbZPyomEDpQSLu3',
      //         }
      //         $.ajax({
      //             url: "https://tungpham.unitopcv.com/admin/product/tickThumnail",
      //             type: 'POST',
      //             data: data,
      //             dataType: 'json',
      //             success: function(data1){
      //                 console.log(data1);
      //             },
      //             error: function (xhr, ajaxOption, thrownError) {
      //                 alert(xhr.status);
      //                 alert(thrownError);
      //             }
      //         });
      //     }
          //upload file qua ajax đưa thông tin tạm thời vào session
          $('#upload_file_product').change(function(){
              var filedata = $('#upload_file_product');
              var fileToUpload = filedata[0].files;
              // console.log(fileToUpload);
              //console.log(filedata[0]); truy cập phần tử input:file
              if(fileToUpload.length > 0){
                  var formData = new FormData();
                  // console.log(formData);
                  for(i=0; i<fileToUpload.length; i++){
                      var file = filedata[0].files[i];
                      formData.append('file[]',file,file.name);
                  }
                  
                  if (formData) {
                      $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                      });
                      // console.log(formData.get().file);  
                      $.ajax({
                          url: "{{ route('createThumnail') }}",
                          type: "POST",
                          data: formData,
                          contentType: false,
                          processData: false,
                          dataType: 'text',
                          success: function(data1){
                              $(".list-img").append(data1);
                              location.reload(true);
                              //xóa thumnail
                            $('.thumbnail-post .icon-delete').click(function(){
                                var id_thumb_delete = $(this).next('.img-thumbnail').attr('data-id');
                                console.log(id_thumb_delete);
                                deleteThumb(id_thumb_delete);
                            });
                          },
                          error: function (xhr, ajaxOption, thrownError) {
                              alert(xhr.status);
                              alert(thrownError);
                          }
                      });
                  }
              }     
          });

           //Xóa ảnh thumnail
        $('.item-thumb .closee').click(function(){
            var id_thumb_delete = $(this).next('.img-thumbnail').attr('data-id');
            console.log(id_thumb_delete);
            deleteThumb(id_thumb_delete);
        });
      })
    </script>  
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>