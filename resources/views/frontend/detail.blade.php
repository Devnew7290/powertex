<!doctype html>
<html>
<head>
<meta name="keywords" content="{{$data->news_keywords}}" />
<meta name="description" content="{{$data->news_description}}" />
<title>Powertex</title>
<?php // require('inc_header.php'); ?>
  @include('frontend.inc_header')
</head>
<body>
  <?php // require('inc_menu.php'); ?>
  @include('frontend.inc_menu')
  <section class="container-fluid section-inside">
    <div class="container detail-container">
        <div class="row">
            <div class="col-12 detail-margin">
                <div class="detail-head">
                    <img src="{{asset($data->news_image_banner)}}" alt="">
                    <h1>{{$data->news_topic}}</h1>
                </div>
                
                @php
                  libxml_use_internal_errors(true);

                  $html = $data->news_detail;
                  $doc = new DOMDocument();
                  $doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

                  $body = $doc->getElementsByTagName('body')->item(0);
                  $output = '';

                  foreach ($body->childNodes as $node) {
                      // ถ้าเป็น <p> ให้เก็บไว้ทั้งแท็ก <p> ... </p>
                      if ($node->nodeName === 'p') {
                          $output .= $doc->saveHTML($node);
                      } else {
                          // อย่างอื่น เช่น <img> หรือ <br> ก็เก็บไว้ตามปกติ
                          $output .= $doc->saveHTML($node);
                      }
                  }

                  $output = trim($output);
                @endphp

                <style>
                  .detail-editor img {
                    display: inline;
                    vertical-align: middle; /* หรือ bottom ก็ได้ ลองดูผลลัพธ์ */
                  }
                </style>
                <div class="detail-editor">
                  {!! $output !!}
                </div>

                <div class="detail-gallery">
                  @if($image)
                  @foreach($image as $rs)
                    <a href="{{asset($rs->news_image_other)}}" class="detail-gallery-item" data-fancybox="gallery"><img src="{{asset($rs->news_image_other)}}" alt=""></a>
                  @endforeach
                  @endif
                </div>
            </div>
            <!-- <div class="col-12 detail-margin">
                <div class="detail-head">
                    <img src="images/banner00001.jpg" alt="">
                    <h1>เปลี่ยนงานหนักให้เป็นงานเบา! ดูแลสวนง่าย ๆ ด้วยเครื่องเป่าลม POWERTEX รุ่นใหม่</h1>
                </div>
                <div class="detail-editor">
                  <p>งานทำความสะอาดสวนก็กลายเป็นเรื่องง่าย! ไม่ว่าจะเป็นใบไม้แห้ง เศษหญ้า หรือฝุ่นตามพื้น เครื่องนี้ช่วยเป่าจัดการได้หมดในเวลาอันรวดเร็ว</p>
                  <p>Proin id libero a quam laoreet tristique. In quis lectus nec odio egestas facilisis. Mauris pharetra sem vel nunc scelerisque posuere. Ut auctor ultricies libero. Sed ultrices viverra dui, non vestibulum ex mollis sed. Mauris et interdum tortor. Sed at molestie justo. Fusce blandit molestie ultrices. Vestibulum viverra dictum leo sit amet consequat. In hac habitasse platea dictumst. In hac habitasse platea dictumst. Praesent pharetra nunc nunc, non faucibus arcu malesuada in.</p>
                  <p>Maecenas finibus arcu ut elementum tincidunt. Proin sit amet purus molestie, volutpat dolor eget, placerat diam. Duis eu eros blandit, vulputate leo nec, convallis ipsum. Maecenas vel velit varius, fermentum orci condimentum, tincidunt enim. Suspendisse molestie euismod rhoncus. Maecenas posuere elementum velit nec efficitur. Morbi in blandit diam, vel maximus mauris. Vivamus eu tempus elit. In eu condimentum sem, ut rhoncus ante.</p>
                </div>
                <div class="detail-gallery">
                  <a href="{{asset('images/company-1.jpg')}}" class="detail-gallery-item" data-fancybox="gallery"><img src="{{asset('images/company-1.jpg')}}" alt=""></a>
                  <a href="{{asset('images/company-2.jpg')}}" class="detail-gallery-item" data-fancybox="gallery"><img src="{{asset('images/company-2.jpg')}}" alt=""></a>
                  <a href="{{asset('images/promo-banner01.jpg')}}" class="detail-gallery-item" data-fancybox="gallery"><img src="{{asset('images/promo-banner01.jpg')}}" alt=""></a>
                  <a href="{{asset('images/promo-banner02.jpg')}}" class="detail-gallery-item" data-fancybox="gallery"><img src="{{asset('images/promo-banner02.jpg')}}" alt=""></a>
                  <a href="{{asset('images/promo-banner03.jpg')}}" class="detail-gallery-item" data-fancybox="gallery"><img src="{{asset('images/promo-banner03.jpg')}}" alt=""></a>
                  <a href="{{asset('images/promo-banner01.jpg')}}" class="detail-gallery-item" data-fancybox="gallery"><img src="{{asset('images/promo-banner01.jpg')}}" alt=""></a>
                  <a href="{{asset('images/promo-banner02.jpg')}}" class="detail-gallery-item" data-fancybox="gallery"><img src="{{asset('images/promo-banner02.jpg')}}" alt=""></a>
                  <a href="{{asset('images/promo-banner03.jpg')}}" class="detail-gallery-item" data-fancybox="gallery"><img src="{{asset('images/promo-banner03.jpg')}}" alt=""></a>
                  <a href="{{asset('images/company-1.jpg')}}" class="detail-gallery-item" data-fancybox="gallery"><img src="{{asset('images/company-1.jpg')}}" alt=""></a>
                  <a href="{{asset('images/company-2.jpg')}}" class="detail-gallery-item" data-fancybox="gallery"><img src="{{asset('images/company-2.jpg')}}" alt=""></a>
                </div>
            </div> -->
        </div>
    </div>
  </section>

  <?php // require('inc_footer.php'); ?>
  @include('frontend.inc_footer')

<script>
$(document).ready(function(){

});    
</script>
</body>
</html>