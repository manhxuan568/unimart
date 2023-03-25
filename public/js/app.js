$(document).ready(function(){
    $('.owl-carousel.slider-list').owlCarousel({
        items: 1,
        // loop:true,
        margin:0,
        autoplay:true,
        autoplayTimeout:4000,
        autoplayHoverPause:true,
        smartSpeed:450,
        rewind:true,
        // responsive:{
        //     0:{
        //         items:1
        //     },
        //     600:{
        //         items:1
        //     },
        //     1000:{
        //         items:1
        //     }
        // }
    })
    //featured-product
    $('.owl-carousel.list-featured-p').owlCarousel({
        items: 4,
        margin:9,
        autoplay:true,
        autoplayTimeout:4000,
        autoplayHoverPause:true,
        smartSpeed:450,
        rewind:true,
        nav: true,
        responsive:{
            0:{
                items:1
            },
            300:{
                items:2
            },
            576:{
                items:3
            },
            768:{
                items:3
            },
            993:{
                items:4
            }
        }
    })

      //  ZOOM PRODUCT DETAIL
      $("#zoom").elevateZoom({gallery: 'list-thumb', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'});

      //  LIST THUMB
          var list_thumb = $('#list-thumb');
          list_thumb.owlCarousel({
              margin:4,
              autoplay:true,
              autoplayTimeout:4000,
              autoplayHoverPause:true,
              smartSpeed:450,
              rewind:true,
              nav: true,
              dots: false,
              items: 5,
          });

       //Xem thêm seeMore
       $('.seeMore').click(function(){
        $(this).parent().css('height','100%');
        $(this).css('display','none');

       }) 
       // Sản phẩm tương tự
    $(".owl-carousel.list-productSame").owlCarousel({
        items: 4,
        margin:9,
        autoplay:false,
        autoplayTimeout:4000,
        autoplayHoverPause:true,
        smartSpeed:450,
        rewind:true,
        nav: true,
        responsive:{
            0:{
                items:1
            },
            285:{
                items:2
            },
            576:{
            items:3
            },
            768:{
                items:3
            },
            993:{
                items:4
            }
        }
    });

    //====================================
  // Lá»c sáº£n pháº©m theo price vĂ  brand
  var price, brand, href, catSlug,linkApp;

  $('.filter.price').on('click',function(){
      var checkedBox = $(this).prop("checked");
      if(checkedBox == true){
          $('.filter.price').prop('checked',false);
          $(this).prop('checked',true);
         
      }else{     
          $('.filter.price').removeAttr('checked');
      }
  })
  $('.filter.brand').on('click',function(){
      var checkedBox = $(this).prop("checked");
      if(checkedBox == true){
          $('.filter.brand').prop('checked',false);
          $(this).prop('checked', true);
      }else{
          $('.filter.brand').removeAttr('checked');
      }
  })

  $('.filter').on('change',function(){
      linkApp = $('#fillter-wp').attr('data-link');
      catSlug = $('#fillter-wp').attr('data-slug');
      price = $('.filter.price:checked').val();
      brand = $('.filter.brand:checked').val();
      href = linkApp+'/san-pham.html/';
      if(Boolean(catSlug)){
          href += catSlug;
      }
      if(Boolean(price) && !Boolean(brand)){
          href += '?price='+price;
      }
      if(Boolean(brand) && !Boolean(price)){
          href += '?brand='+brand;
      }
      if(Boolean(brand) && Boolean(price)){   
          href += '?price='+price+'&brand='+brand;
      }
      window.location.href = href
  })
//Sáº¯p xáº¿p sáº£n pháº©m vá»›i sort theo A-Z, giĂ¡ cao tháº¥p...
  $('.form-filter .select-filter').on('change',function(){
      var sort = $(this).val();
      var linkCurr = window.location.href;
      var query = window.location.search;
      var indexSort3 = linkCurr.indexOf('sort=')
      if(Boolean(query)){
          if(indexSort3 !== -1){
              strChild = linkCurr.substr(indexSort3,7);
              let hrefNew = linkCurr.replace(strChild,'sort='+sort);
              window.location.href = hrefNew;
          }else{
              let hrefNew = linkCurr+'&sort='+sort;
              window.location.href = hrefNew;
          }
      }else{
          let hrefNew = linkCurr+'?sort='+sort;
          window.location.href = hrefNew;
      }
  })
  //TĂ¬m kiáº¿m theo tá»« khĂ³a
$('#search-keyword').on('input',function(){
    var url = $('#search-keyword').attr('data-url');
    var keyword = $(this).val();
    let data = {
            'keyword':keyword,
        }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        dataType: 'text',
        success: function(data1){   
            // console.log(data1)
                $('.search_ajax').html(data1);
        },
        error: function (xhr, ajaxOption, thrownError) {
            // alert(xhr.status);
            // alert(thrownError);
        }
    });
})

//plus and minus

let amountElement = $('#num-order');
let amount = amountElement.val();
   $('#detail-product-wp .add-cart.art-to-cart').attr('data-qty',amount);
function render(amount){
    amountElement.val(amount);
    $('#detail-product-wp .add-cart.art-to-cart').attr('data-qty',amount);
}
function handleMinus(){
   amount--;
   render(amount);
}        
function handlePlus(){
   amount++;
   render(amount);
}        
$('#minus').on('click',function(){
    if(amount >1){
      handleMinus()  
    }  
})
$('#plus').on('click',function(){
    handlePlus()
})
$('#num-order').on('input',function(){
      amount = amountElement.val();
      amount = (isNaN(amount) || amount==0)?1:amount
      render(amount);
      $('.add-cart.art-to-cart').attr('data-qty',amount);
})

//thĂªm sáº£n pháº©m giá» hĂ ng
$('.art-to-cart').click(function(e){
    e.preventDefault();
    let productSlug = $(this).attr('data-slug');
    let urlAddToCart = $('#urlAddToCart').attr('data-url');
    let qty = $('#detail-product-wp .add-cart.art-to-cart').attr('data-qty');
    let data = {
            'productSlug':productSlug,
            'qty':qty,
        }
        // console.log(data)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: urlAddToCart,
        type: 'POST',
        data: data,
        dataType: 'JSON',
        success: function(data1){   
            console.log(data1.success)
            $('.modal-wp').addClass('active')
            function modal_remove(){
                $('.modal-wp').removeClass('active')
            }
            $('.modal-wp').on('click', function(e){
                if(e.target == e.currentTarget){ //currentTarget là chuỗi target gần nhất tức là phần tử gần .modal nhất thì làm gì đó
                    modal_remove()
                }
            });
            $('.modal__header i').on('click', modal_remove);
            $('.cancel').on('click',modal_remove);
    
           // xá»­ lĂ½ dropdown giá» hĂ ng
            if(data1.count > 0){
                $('.card-detail').addClass('hover')
            }
            $('.card-detail .price span').html(data1.total + 'đ')
            $('.show-card .product-num').html(data1.count)
            $('.card-detail .alert_count').html(data1.count +'sản phẩm')
        },
        error: function (xhr, ajaxOption, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
    return false;
})

//Cart minuss pluss     
$('.num-order-wp .minuss').on('click',function(){
    if($(this).next().val() >1){
        let inputQty = $(this).next().val();
        let productId = $(this).next().data('id')
        let inputQtynew = parseInt(inputQty) - 1;
        $(this).next().val(inputQtynew);
        handleUpdateAjax(productId,inputQtynew) 
    }  
       
})
$('.num-order-wp .pluss').on('click',function(){
   let inputQty = $(this).prev().val();
   let productId = $(this).prev().data('id');
   let inputQtynew = parseInt(inputQty) + 1;
   $(this).prev().val(inputQtynew);
   handleUpdateAjax(productId,inputQtynew)  
})
$('.product-qty').on('input',function(e){
    if(e.target == e.currentTarget){
         amounts = $(this).val();
         amounts = (isNaN(amounts) || amounts==0)?1:amounts
      $(this).val(amounts);
 }
      

})
// Tăng giảm giỏ hàng ajax
    function handleUpdateAjax(productId,inputQtynew){
        let data = {
            'productId':productId,
            'inputQtynew':inputQtynew
        }
        let UrlUpdateAjaxCart = $('#info-cart-wp table.table').data('update');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:UrlUpdateAjaxCart,
            type:'POST',
            data:data,
            dataType:'JSON',
            success:function(data2){
                let item = $('.product-qty[data-id="'+data2.productId+'"]').parents('td').next();
                // console.log(data2);
                $('.card-detail .price span').html(data2.total + 'đ')
                $('.show-card .product-num').html(data2.count)
                $('.card-detail .alert_count').html(data2.count +'sản phẩm')
                $('#total-qty span').html(data2.count)
                $('#total-price span').html(data2.total + 'đ')
                item.html(data2.subtotal+ 'đ')
            }
        })
    }
    //select Change Ajax tỉnh thành phố
    $('#provinces').on('change',function(){
          let idProvince = $(this).val();
          let urlDistrict = $('#provinces').data('district');
          let data = {
            'idProvince':idProvince,
          }
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
            url:urlDistrict,
            type:'POST',
            data:data,
            dataType:'text',
            success:function(data3){
               $('#districts').html(data3)
            }
        })       

    })
    //
    $('#districts').on('change',function(){
        let idDistricts = $(this).val();
        let urlWards = $('#districts').data('wards');
        let data = {
          'idDistricts':idDistricts,
        }
      $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
      $.ajax({
          url:urlWards,
          type:'POST',
          data:data,
          dataType:'text',
          success:function(data4){
             $('#wards').html(data4)
          }
      })       

  })
  //xử lý search ajax ẩn
  $('#wrapper').on('click', function(){
    $('.search_ajax').html('');
  })
  $('#search-keyword').click(function(){
    return false;
})
//back to top
//  SCROLL TOP
$(window).scroll(function () {
    if ($(this).scrollTop() != 0) {
        $("#btn-top").stop().fadeIn(150);
    } else {
        $("#btn-top").stop().fadeOut(150);
    }
});
$("#btn-top").click(function () {
    $("body,html").stop().animate({ scrollTop: 0 }, 800);
});
//navbar_toggle_menu
    $('.navbar-toggle').click(function(){
        $('.menu-toggle').stop().slideToggle(500);
    });
    $(window).scroll(function(){
        $('.sub-menu-navbar').slideUp(500);
        $('.menu-toggle').slideUp(500);
        $('.up-icon').removeClass('open');
    });
    $(window).resize(function(){
        $('.sub-menu-navbar').slideUp(500);
        $('.menu-toggle').slideUp(500);
        $('.up-icon').removeClass('open');
    });
   
    $('.up-icon').click(function(){
       
        $(this).toggleClass('open');
        $(this).prev('.sub-menu-navbar').stop().slideToggle();
    });

  });
  


 