<!doctype html>
<html>
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<title>Powertex</title>
<?php // require('inc_header.php'); ?>
@include('frontend.inc_header')
</head>
<body>
  <?php // require('inc_menu.php'); ?>
  @include('frontend.inc_menu')
  <section class="container-fluid banner-container wow fadeInDown">
    <div class="row">
      <div class="col-12 banner-inside">
        <div class="banner-carousel owl-carousel owl-theme">
          @foreach($imageBrand as $rs)
            <div class="banner-inside-item"><img src="{{asset($rs->bi_image)}}" alt=""></div>
          @endforeach
          <!-- <div class="banner-inside-item"><img src="{{asset('images/product-banner.jpg')}}" alt=""></div>
          <div class="banner-inside-item"><img src="{{asset('images/product-banner.jpg')}}" alt=""></div> -->
        </div>
      </div>
    </div>
  </section>
  <section class="container-fluid section-inside">
    <div class="container">
      <div class="row">
        <div class="col-12 head-fp head-fp-center">
          <h2 class="wow fadeInDown">{{$brand->brand_name}}</h2>
          <input type="hidden" id="brand-id" value="{{ $brand->brand_id }}">
          @php $URLbrand = $brand->brand_url ? $brand->brand_url : "brand"; @endphp
          <input type="hidden" id="brand-url" value="{{ $URLbrand }}">
        </div>
      </div>
      <div class="row">
        <div class="col-12 product-wrap">
          <div class="product-filter wow fadeInLeft">
            <h4><i class="bi bi-filter-square-fill"></i> หมวดหมู่สินค้า</h4>
            <form class="product-sidebar">
              <h4 class="filter-head-popup">หมวดหมู่สินค้า</h4>
              <ul class="filter-list">
                @foreach($main as $rs)
                  <li>
                    <label class="filter-checkbox">
                      <input type="checkbox" class="category-filter" value="{{ $rs->cm_id }}"
                        @foreach($mainArray as $row) @if($rs->cm_id == $row) checked @endif @endforeach>
                      <div class="filter-checkbox-icon"><i class="bi bi-check"></i>{{$rs->cm_name}}</div>
                    </label>
                    <ul class="filter-list filter-checkbox-sub">
                      @foreach($Sub as $row)
                        @if($rs->cm_id == $row->FK_category_main)
                          <li>
                            <label class="filter-checkbox">
                              <input type="checkbox" class="subcategory-filter" value="{{ $row->cs_id }}"
                                @foreach($subArray as $s) @if($row->cs_id == $s) checked @endif @endforeach>
                              <div class="filter-checkbox-icon"><i class="bi bi-check"></i>{{$row->cs_name}}</div>
                            </label>
                            <ul class="filter-list filter-checkbox-sub">
                              @foreach($Third as $data)
                                @if($row->cs_id == $data->FK_category_sub)
                                  <li>
                                    <label class="filter-checkbox">
                                      <input type="checkbox" class="thirdcat-filter" value="{{ $data->ct_id }}"
                                        @foreach($thirdArray as $t) @if($data->ct_id == $t) checked @endif @endforeach>
                                      <div class="filter-checkbox-icon"><i class="bi bi-check"></i>{{$data->ct_name}}</div>
                                    </label>
                                  </li>
                                @endif
                              @endforeach
                            </ul>
                          </li>
                        @endif
                      @endforeach
                    </ul>
                  </li>
                @endforeach
              </ul>
            </form>
            <div class="overlay-filter"></div>
          </div>
          <div class="product-grid wow fadeInDown">
            @foreach($product as $rs)
              @php $urlProduct = $rs->products_url ? $rs->products_url : "product"; @endphp
              <a href="{{ url('product/detail/'.$rs->products_id.'/'.$urlProduct) }}" class="product-item">
                  <figure>
                      <div class="product-img">
                      @php $i = 1; @endphp
                      @foreach($image as $row)
                          @if(($i == 1) && ($rs->products_id == $row->FK_pi_product))
                          <img src="{{asset($row->pi_image)}}" alt="">
                          @php $i++; @endphp
                          @endif
                      @endforeach
                      </div>
                      <figcaption>
                      <h3>{{$rs->products_name}}</h3>
                      <p>รหัสสินค้า {{$rs->products_code}}</p>
                      <div class="product-price product-price-sale">
                          @if($rs->products_price_promotion)
                          <span>฿ {{$rs->products_price_full}}</span><div>฿ {{$rs->products_price_promotion}}</div>
                          @else
                          <div class="product-price">฿ {{$rs->products_price_full}}</div>
                          @endif
                      </div>
                      </figcaption>
                  </figure>
              </a>
            @endforeach
          </div>
          <ul class="pagination wow fadeInDown">
            @if(count($product)>12)
              <li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a></li>
              <li class="page-item active"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a></li>
            @endif
          </ul>
        </div>
      </div>
    </div>
  </section>

  <?php // require('inc_footer.php'); ?>
  @include('frontend.inc_footer')

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // var baseUrl = "{{ url('/') }}";
  // var url = baseUrl + "/search?";
  $(document).ready(function () {
    let filterTimeout; // เก็บตัวแปร timeout ไว้ด้านนอก

    $('input[type="checkbox"]').on('change', function () {
      // ล้าง timeout เดิมก่อนเริ่มอันใหม่
      clearTimeout(filterTimeout);

      // ตั้งเวลา 5 วินาที (5000ms)
      filterTimeout = setTimeout(function () {
        let main = [];
        let sub = [];
        let third = [];

        $('.category-filter:checked').each(function () {
          main.push($(this).val());
        });
        $('.subcategory-filter:checked').each(function () {
          sub.push($(this).val());
        });
        $('.thirdcat-filter:checked').each(function () {
          third.push($(this).val());
        });

        let brand = $('#brand-id').val();
        let brand_url = $('#brand-url').val();

        var baseUrl = "{{ url('/') }}";
        var url = baseUrl + "/products/"+brand+"/"+brand_url+"?";
        if (main.length) url += "main=" + main.join(',') + "&";
        if (sub.length) url += "sub=" + sub.join(',') + "&";
        if (third.length) url += "third=" + third.join(',') + "&";
        if (brand) url += "brand=" + brand;

        url = url.replace(/&$/, '');

        // ไปยัง URL ใหม่หลังดีเลย์
        window.location.href = url;

      }, 5000); // 5 วินาที
    });
  });

$(document).ready(function(){
  
  $(".banner-carousel").owlCarousel({
      loop: false,
      rewind: true,
      margin:0,
      nav: false,
      autoplayHoverPause: false,
      dots: true,
      autoplay: true,
      autoplayTimeout: 7000,
      smartSpeed: 800,
      stagePadding: 0,
      slideBy: 1,
      items:1,
  });

  $('.filter-checkbox > input').each(function(index) {
      if ($(this).is(":checked")) {
          $(this).closest('li').children('ul.filter-checkbox-sub').slideDown();
      }
  });

  $('.filter-checkbox > input').change(function() {
    const $li = $(this).closest('li');
    
    if ($(this).is(":checked")) {
        $li.children('ul.filter-checkbox-sub').slideDown();
    } else {
        // ซ่อนทั้งหมดในลำดับล่างลงไป
        $li.find('ul.filter-checkbox-sub').slideUp();
        $li.find('ul.filter-checkbox-sub input').prop('checked', false);
    }
  });

  $('.product-sidebar-reset').click(function() {
      $('.filter-checkbox-sub').slideUp();
      $('.filter-checkbox > input').removeAttr('checked').prop('checked', false);
  });

  $( '.product-filter h4' ).click(function (event) {
    if (  $( ".product-sidebar" ).is( ":hidden" ) ) {
            $(this).addClass("active");
            $( ".product-sidebar" ).effect('slide', { direction: 'left', mode: 'show' }, 500);
            $('.overlay-filter').fadeIn();
    }else{
      if (Modernizr.mq('(min-width: 767px)')) {
        $( ".product-sidebar" ).effect('slide', { direction: 'left', mode: 'hide' }, 500);
        $(this).removeClass("active");
        $('.overlay-filter').fadeOut();
      }
    }
    event.preventDefault();
  });
  
  $( '.overlay-filter, .filter-submit' ).click(function (event) {
    $( ".product-sidebar" ).effect('slide', { direction: 'left', mode: 'hide' }, 500);
    $('.filter-btn').removeClass("active");
    $('.overlay-filter').fadeOut();
    event.stopPropagation();
  });

});    
</script>
</body>
</html>