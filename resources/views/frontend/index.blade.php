<!doctype html>
<html>
<head>
<meta name="keywords" content="{{$about->about_us_keyword}}" />
<meta name="description" content="{{$about->about_us_description}}" />
<title>Powertex</title>
<?php // require('inc_header.php'); ?>
@include('frontend.inc_header')
</head>
<body>
  <?php // require('inc_menu.php'); ?>
  @include('frontend.inc_menu')
  <section class="container-fluid banner-container wow fadeInDown">
    <div class="row">
      <div class="col-12 banner-fp">
        <div class="banner-carousel owl-carousel owl-theme">
          @foreach($banner as $rs)
            <a href="#" class="banner-fp-item"><img src="{{asset($rs->banner_image)}}" alt=""></a>
          @endforeach
        </div>
      </div>
    </div>
  </section>
  <section class="container-fluid overflow-hidden">
    <div class="container">
      <figure class="row company-fp">
        <figcaption class="col-12 col-md-6 company-fp-info">
          <hgroup>
            <h1 class="wow fadeInLeft">{{$about->about_us_topic}}</h1>
            {!! $about->about_us_detail !!}
          </hgroup>
          <div class="company-fp-logo">
            <div class="company-fp-logo-list wow fadeInLeft">
              <img src="{{asset($about->about_us_powertex)}}" alt="">
            </div>
            <div class="company-fp-logo-list wow fadeInLeft" data-wow-delay=".15s">
              <img src="{{asset($about->about_us_hugong)}}" alt="">
            </div>
            <div class="company-fp-logo-list wow fadeInLeft" data-wow-delay=".3s">
              <img src="{{asset($about->about_us_sunflower)}}" alt="">
            </div>
          </div>
          <div class="company-fp-btn">
            <a href="#" class="company-fp-btn-product wow fadeInLeft" data-wow-delay=".15s">สินค้าของเรา</a>
            <a href="{{ url('about-us') }}" class="company-fp-btn-about wow fadeInLeft" data-wow-delay=".3s">เกี่ยวกับเรา</a>
          </div>
        </figcaption>
        <div class="col-12 col-md-6 company-fp-img wow fadeInUp">
          <div class="company-fp-img-01 wow fadeInRight" data-wow-delay=".25s">
            <img src="{{asset($about->about_us_image_back)}}" alt="">
          </div>
          <div class="company-fp-img-02 wow fadeInLeft" data-wow-delay=".5s">
            <img src="{{asset($about->about_us_image_front)}}" alt="">
          </div>
        </div>
      </figure>
    </div>
  </section>
  <section class="container-fluid whyus-bg wow fadeInDown">
    <img src="{{asset('images/whyus-bg.jpg')}}" alt="">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-7 whyus-video-wrap wow fadeInLeft">
          <div class="whyus-video">
            {{-- <iframe src="https://www.youtube.com/embed/At9Rb5E_InY?{{$whyUs->why_us_vdo}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> --}}
            <iframe src="{{$whyUs->why_us_vdo}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
          </div>
        </div>
        <div class="col-12 col-md-5 whyus-text wow fadeInRight">
          @php
            $text = $whyUs->why_us_topic;
            $highlightWords = ["POWERTEX", "พาวเวอร์เท็กซ์"];
            $isHighlighted = false;

            foreach ($highlightWords as $word) {
                if (strpos($text, $word) !== false) {
                    $text = str_replace($word, "<span>{$word}</span>", $text);
                    $isHighlighted = true;
                }
            }

            if (!$isHighlighted) {
                // ถ้าไม่มีคำที่ต้องเน้น ให้แบ่งข้อความเป็นสองส่วน
                $halfLength = mb_strlen($text) / 2;
                $firstPart = mb_substr($text, 0, $halfLength);
                $secondPart = mb_substr($text, $halfLength);
            }
          @endphp

          @if ($isHighlighted)
              <h2>{!! $text !!}</h2> {{-- ใช้ {!! !!} เพื่อให้ HTML <span> ทำงาน --}}
          @else
              <h2>{{ $firstPart }}<span>{{ $secondPart }}</span></h2>
          @endif
          <p>{!! $whyUs->why_us_detail !!}</p>
            <style>
              .whyus-item {
                  overflow: hidden; /* ป้องกันเนื้อหาไม่ให้ล้นออกจากกรอบ */
                  word-wrap: break-word; /* ให้ข้อความขึ้นบรรทัดใหม่เมื่อเกินขอบ */
                  white-space: normal; /* อนุญาตให้ข้อความขึ้นบรรทัดใหม่ */
                  max-width: 150%;
              }
            </style>
          <div class="whyus-carousel owl-carousel owl-theme">
            @foreach($guarantee as $rs)
              <div class="whyus-item">
                <h3><img src="{{asset($rs->guarantees_icon)}}" alt=""><span>{{$rs->guarantees_topic}}</span></h3>
                {!! $rs->guarantees_detail !!}
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="container-fluid product-fp-section">
    <div class="container">
      <div class="row">
        <div class="col-12 head-fp head-fp-center">
          <h2 class="wow fadeInDown">OUR PRODUCT</h2>
          <p class="wow fadeInDown">เรามีสินค้าที่ครบครัน ให้คุณได้เลือกสรร สำหรับงานช่างของคุณ</p>
        </div>
      </div>
      <div class="row">
        <div class="col-12 wow fadeInDown">
          <ul class="product-fp-tab">
            <li class="active"><a class="tablinks" id="defaultOpen" onclick="openCity(event, 'pageAll')">ทั้งหมด</a></li>
            @foreach($category as $rs)
            <li><a class="tablinks" onclick="openCity(event, 'page{{$rs->cm_id}}')">{{$rs->cm_name}}</a></li>
            @endforeach
            <li><a class="tablinks" onclick="openCity(event, 'pageNew')">สินค้าใหม่</a></li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-12 wow fadeInDown">
          <div class="product-carousel owl-carousel owl-theme tabcontent" id="pageAll">
            @foreach($productAll as $rs)
            <?php
              $productTopic = preg_replace('/[^a-zA-Z0-9ก-๙\s]/u', '', $rs->products_code);
              $urlProduct = $rs->products_url ? $rs->products_url : $productTopic;
            ?>
            <a href="{{ url('product/detail/'.$rs->products_id.'/'.$urlProduct) }}" class="product-item">
              <figure>
                <div class="product-img">
                  @php $i = 1; @endphp
                  @foreach($productImg as $row)
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
                    @php
                      $dateFull = new DateTime();
                      $date = $dateFull->format('Y-m-d');

                      $PP = App\Models\Promotions::where('promotion_status', 'show')
                        ->where('promotion_date_start', '<=', $date)
                        ->where('promotion_date_end', '>=', $date)
                        ->where('promotion_status', 'show')
                        ->whereRaw('FIND_IN_SET(?, promotion_product)', [$rs->products_id])
                        ->orderBy('promotion_number', 'asc')->first();
                    @endphp
                    @if($PP)
                      @if($PP->promotion_type == 'bath')
                        <span>฿ {{$rs->products_price_full}}</span>
                        <div>
                          ฿ {{ $rs->products_price_full - $PP->promotion_price }}
                        </div>
                      @else
                        <span>฿ {{$rs->products_price_full}}</span>
                        <div>
                          ฿ {{ round($rs->products_price_full - ($rs->products_price_full * ($PP->promotion_price / 100))) }}
                        </div>
                      @endif
                    @else
                      @if($rs->products_price_promotion)
                        <span>฿ {{$rs->products_price_full}}</span><div>฿ {{$rs->products_price_promotion}}</div>
                      @else
                        <div class="product-price">฿ {{$rs->products_price_full}}</div>
                      @endif
                    @endif
                  </div>
                </figcaption>
              </figure>
            </a>
            @endforeach
          </div>
          @foreach($category as $data)
            <div class="product-carousel owl-carousel owl-theme tabcontent" id="page{{$data->cm_id}}">
              @foreach($productAll as $rs)
              <?php
                $productTopic = preg_replace('/[^a-zA-Z0-9ก-๙\s]/u', '', $rs->products_code);
                $urlProduct = $rs->products_url ? $rs->products_url : $productTopic;
              ?>
              @if($data->cm_id == $rs->FK_category_mains)
              <a href="{{ url('product/detail/'.$rs->products_id.'/'.$urlProduct) }}" class="product-item">
                <figure>
                  <div class="product-img">
                    @php $i = 1; @endphp
                    @foreach($productImg as $row)
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
              @endif
              @endforeach
            </div>
          @endforeach
          <div class="product-carousel owl-carousel owl-theme tabcontent" id="pageNew">
            @foreach($productNew as $rs)
            <?php
              $productTopic = preg_replace('/[^a-zA-Z0-9ก-๙\s]/u', '', $rs->products_code);
              $urlProduct = $rs->products_url ? $rs->products_url : $productTopic;
            ?>
            <a href="{{ url('product/detail/'.$rs->products_id.'/'.$urlProduct) }}" class="product-item">
              <figure>
                <div class="product-img">
                  @php $i = 1; @endphp
                  @foreach($productImg as $row)
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
        </div>
      </div>
    </div>
  </section>
  <section class="container-fluid">
    <div class="row">
      <div class="col-12 three-banner-grid wow fadeInDown">
        @foreach($brand as $rs)
          <a href="#" class="three-banner">
            <img src="{{asset($rs->brand_banner)}}" alt="">
          </a>
        @endforeach
      </div>
    </div>
  </section>
  <section class="container-fluid article-bg">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="head-fp head-fp-wbtn wow fadeInDown">
            <h3>บทความ</h3>
            <a href="{{ url('news/article') }}" class="btn-viewall">ดูทั้งหมด</a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 wow fadeInDown">
          <div class="article-carousel owl-carousel owl-theme">
            @foreach($article as $rs)
              <?php
                $articleTopic = preg_replace('/[^a-zA-Z0-9ก-๙\s]/u', '', $rs->news_topic);
                $articleURL = $rs->news_url ? $rs->news_url : $articleTopic;
              ?>
              <a href="{{url('news-detail/article/'.$rs->news_id.'/'.$articleURL)}}" class="article-item">
                <figure>
                  <div class="article-img"><img src="{{asset($rs->news_image_cover)}}" alt=""></div>
                  <figcaption>
                    <div class="article-date">
                      {{ \Carbon\Carbon::parse($rs->news_date)->translatedFormat('d') }}
                      @php
                        $month = \Carbon\Carbon::parse($rs->news_date)->translatedFormat('m');
                        if($month == 1){ $month = 'มกราคม'; }
                        elseif($month == 2){ $month = 'กุมภาพันธ์'; }
                        elseif($month == 3){ $month = 'มีนาคม'; }
                        elseif($month == 4){ $month = 'เมษายน'; }
                        elseif($month == 5){ $month = 'พฤษภาคม'; }
                        elseif($month == 6){ $month = 'มิถุนายน'; }
                        elseif($month == 7){ $month = 'กรกฎาคม'; }
                        elseif($month == 8){ $month = 'สิงหาคม'; }
                        elseif($month == 9){ $month = 'กันยายน'; }
                        elseif($month == 10){ $month = 'ตุลาคม'; }
                        elseif($month == 11){ $month = 'พฤศจิกายน'; }
                        else{ $month = 'ธันวาคม'; }
                      @endphp
                      {{$month}}
                      {{ \Carbon\Carbon::parse($rs->news_date)->translatedFormat('Y') }}
                    </div>
                    <h4>{{$rs->news_topic}}</h4>

                    <style>
                      .clamp-3 {
                          display: -webkit-box;
                          -webkit-box-orient: vertical;
                          -webkit-line-clamp: 3;
                          overflow: hidden;
                          text-overflow: ellipsis;
                          white-space: normal;
                          line-height: 1.5em;
                          max-height: calc(1.5em * 3);
                          color: #666666;
                      }

                      .clamp-3 br {
                          display: inline;
                      }

                      .clamp-3 p img {
                        vertical-align: middle; /* ให้แนบกับข้อความ */
                      }

                      .clamp-3 img {
                        display: inline-block;
                        max-height: 1em;
                        height: 1em;
                        max-width: 1em;
                        width: auto;
                        vertical-align: middle;  /* ให้ภาพแนบกับข้อความ */
                        margin: 0; /* ลบ margin ที่อาจทำให้เว้นช่องว่าง */
                      }
                      .owl-carousel .owl-item img {
                        display: inline-block;
                      }
                    </style>
                    @php
                      // ลบ <img>
                      // $no_img = preg_replace('/<img[^>]*>/i', '', $rs->news_detail);

                      // แปลง <p>...</p> ให้เป็นข้อความ + <br>
                      $converted = preg_replace('/<p[^>]*>(.*?)<\/p>/i', '$1<br>', $rs->news_detail);

                      // ลบ <br> ซ้ำซ้อน
                      $converted = preg_replace('/(<br\s*\/?>\s*)+/', '<br>', $converted);

                      // ตัดช่องว่างรอบ ๆ
                      $converted = trim($converted);
                    @endphp

                    <div class="clamp-3">{!! $converted !!}</div>
                    

                    <div class="btn-arrow"></div>
                  </figcaption>
                </figure>
              </a>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="container-fluid">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-6 promotion-section wow fadeInLeft">
          <div class="head-fp head-fp-wbtn">
            <h3>PROMOTION</h3>
            <div class="promotion-btn">
              <a href="{{ url('news/promotion') }}" class="btn-viewall">ดูทั้งหมด</a>
              <div class="promotion-btn-prev"><img src="{{asset('images/icon-prev.svg')}}" alt=""></div>
              <div class="promotion-btn-next"><img src="{{asset('images/icon-next.svg')}}" alt=""></div>
            </div>
          </div>
          <div class="promotion-carousel owl-carousel owl-theme">
            @foreach($promotion as $rs)
            <?php
              $promotionTopic = preg_replace('/[^a-zA-Z0-9ก-๙\s]/u', '', $rs->promotion_topic);
              $promotionURL = $rs->promotion_url ? $rs->promotion_url : $promotionTopic;
            ?>
            <a href="{{url('news-detail/promotion/'.$rs->promotion_id.'/'.$promotionURL)}}" class="promotion-item">
              <img src="{{asset($rs->promotion_image_cover)}}" alt="">
            </a>
            @endforeach
          </div>
        </div>
        <div class="col-12 col-lg-6 news-fp-section wow fadeInRight">
          <div class="head-fp head-fp-wbtn">
            <h3>NEWS & ACTIVITIES</h3>
            <a href="{{ url('news/news') }}" class="btn-viewall">ดูทั้งหมด</a>
          </div>
          @foreach($news as $rs)
          <?php
            $newsTopic = preg_replace('/[^a-zA-Z0-9ก-๙\s]/u', '', $rs->news_topic);
            $newsURL = $rs->news_url ? $rs->news_url : $newsTopic;
          ?>
          <a href="{{ url('news-detail/news/'.$rs->news_id.'/'.$newsURL) }}" class="news-fp-item wow fadeInDown">
            <figure>
              <div class="news-fp-img">
                <img src="{{asset($rs->news_image_cover)}}" alt="">
              </div>
              <figcaption>
                <h4>{{$rs->news_topic}}</h4>
                <div class="article-date">
                  {{ \Carbon\Carbon::parse($rs->news_date)->translatedFormat('d') }}
                  @php
                    $month = \Carbon\Carbon::parse($rs->news_date)->translatedFormat('m');
                    if($month == 1){ $month = 'มกราคม'; }
                    elseif($month == 2){ $month = 'กุมภาพันธ์'; }
                    elseif($month == 3){ $month = 'มีนาคม'; }
                    elseif($month == 4){ $month = 'เมษายน'; }
                    elseif($month == 5){ $month = 'พฤษภาคม'; }
                    elseif($month == 6){ $month = 'มิถุนายน'; }
                    elseif($month == 7){ $month = 'กรกฎาคม'; }
                    elseif($month == 8){ $month = 'สิงหาคม'; }
                    elseif($month == 9){ $month = 'กันยายน'; }
                    elseif($month == 10){ $month = 'ตุลาคม'; }
                    elseif($month == 11){ $month = 'พฤศจิกายน'; }
                    else{ $month = 'ธันวาคม'; }
                  @endphp
                  {{$month}}
                  {{ \Carbon\Carbon::parse($rs->news_date)->translatedFormat('Y') }}
                </div>
                <div class="btn-arrow"></div>
              </figcaption>
            </figure>
          </a>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <?php // require('inc_footer.php'); ?>
  @include('frontend.inc_footer')

  
    @if (session('register_success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    Swal.fire({
        icon: 'success',
        title: 'สมัครสมาชิกสำเร็จ!',
        text: 'ระบบได้สร้างบัญชีของคุณเรียบร้อยแล้ว',
        confirmButtonText: 'ตกลง'
    });
    </script>
    @endif

  

<script>
  function openCity(evt, cityName) {
    // ซ่อนทุก tabcontent
    var tabcontent = document.getElementsByClassName("tabcontent");
    for (let i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }

    // ลบ class active จากทุก <li>
    var liElements = document.querySelectorAll(".product-fp-tab li");
    liElements.forEach(function (li) {
      li.classList.remove("active");
    });

    // แสดงเนื้อหาที่เลือก
    document.getElementById(cityName).style.display = "block";

    // เพิ่ม class active ให้ <li> ที่คลิก
    evt.currentTarget.parentElement.classList.add("active");
  }

  // เปิดแท็บเริ่มต้น
  window.onload = function () {
    document.getElementById("defaultOpen").click();
  };

$(document).ready(function(){
  
  $(".banner-carousel").owlCarousel({
      loop: true,
      rewind: false,
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

  $(".whyus-carousel").owlCarousel({
      loop: true,
      rewind: false,
      margin:5,
      nav: false,
      autoplayHoverPause: false,
      dots: true,
      autoplay: true,
      autoplayTimeout: 7000,
      smartSpeed: 800,
      stagePadding: 0,
      slideBy: 1,
      responsive:{
          0:{
              items:2,
              margin: 10
          },
          768:{
              items:1,
              margin: 15
          },
          992:{
              items:2,
              margin: 15
          },
          1201:{
              items:3,
              margin: 15
          }
      }
  });

  $(".product-carousel").owlCarousel({
      loop: true,
      rewind: false,
      margin:5,
      nav: false,
      autoplayHoverPause: false,
      dots: true,
      autoplay: true,
      autoplayTimeout: 7000,
      smartSpeed: 500,
      stagePadding: 0,
      slideBy: 1,
      responsive:{
          0:{
              items:2,
              margin: 10
          },
          768:{
              items:3,
              margin: 15
          },
          992:{
              items:4,
              margin: 25
          },
          1201:{
              items:4,
              margin: 35
          }
      }
  });

  $(".article-carousel").owlCarousel({
      loop: true,
      rewind: false,
      margin:5,
      nav: false,
      autoplayHoverPause: false,
      dots: true,
      autoplay: true,
      autoplayTimeout: 7000,
      smartSpeed: 500,
      stagePadding: 0,
      slideBy: 1,
      responsive:{
          0:{
              items:2,
              margin: 10
          },
          768:{
              items:2,
              margin: 15
          },
          992:{
              items:3,
              margin: 25
          },
          1201:{
              items:3,
              margin: 55
          }
      }
  });

  $(".promotion-carousel").owlCarousel({
      loop: true,
      rewind: false,
      margin: 10,
      nav: false,
      autoplayHoverPause: false,
      dots: false,
      autoplay: true,
      autoplayTimeout: 7000,
      smartSpeed: 800,
      stagePadding: 0,
      slideBy: 1,
      items:1,
      responsive:{
          0:{
              items:1,
              margin: 10
          },
          768:{
              items:2,
              margin: 15
          },
          992:{
              items:1,
              margin: 15
          },
          1201:{
              items:1,
              margin: 15
          }
      }
  });

  $('.promotion-btn-next').click(function() {
    $(".promotion-carousel").trigger('next.owl.carousel');
  });

  $('.promotion-btn-prev').click(function() {
    $(".promotion-carousel").trigger('prev.owl.carousel');
  });

});    
</script>
</body>
</html>