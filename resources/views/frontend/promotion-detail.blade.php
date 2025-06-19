<!doctype html>
<html>
<head>
<meta name="keywords" content="{{$data->promotion_keyword}}" />
<meta name="description" content="{{$data->promotion_description}}" />
<title>Powertex</title>
<?php // require('inc_header.php'); ?>
@include('frontend.inc_header')
</head>
<body>
  <?php // require('inc_menu.php'); ?>
  @include('frontend.inc_menu')
  <section class="container-fluid section-inside">
    <div class="container detail-margin">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="promotion-detail-img">
                  <!-- <img src="{{asset('images/image-promo.jpg')}}" alt=""> -->
                  <img src="{{asset($data->promotion_image_cover)}}" alt="">
                </div>
            </div>
            <div class="col-12 col-lg-6 promotion-detail-text">
              <h1>{{$data->promotion_topic}}</h1>

              @php
                libxml_use_internal_errors(true);

                $html = $data->promotion_detail;
                $doc = new DOMDocument();
                $doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

                $body = $doc->getElementsByTagName('body')->item(0);
                $output = '';

                foreach ($body->childNodes as $node) {
                    if ($node->nodeName === 'p') {
                        // ดึงเฉพาะ "innerHTML" ของ <p>
                        $fragment = '';
                        foreach ($node->childNodes as $child) {
                            $fragment .= $doc->saveHTML($child);
                        }
                        // เพิ่ม <br> แทน <p>
                        $output .= $fragment . '<br>';
                    } else {
                        // สำหรับ tag อื่น ๆ เช่น <img>, <br> ให้เก็บไว้ตามปกติ
                        $output .= $doc->saveHTML($node);
                    }
                }

                // ล้าง tag <p> เผื่อเหลือ
                $output = preg_replace('/<\/?p[^>]*>/', '', $output);
                $output = trim($output);
              @endphp

              <style>
                .detail-editor {
                  display: -webkit-box;
                  -webkit-line-clamp: 3;
                  -webkit-box-orient: vertical;
                  overflow: hidden;
                  text-overflow: ellipsis;
                  white-space: normal;
                  line-height: 1.5em;
                  max-height: 4.5em;
                }

                .detail-editor br {
                  display: inline;
                }

                .detail-editor img {
                  display: inline;
                  vertical-align: middle;
                  max-height: 1em;
                }
              </style>

              <div class="detail-editor">
                {!! $output !!}
                <!-- {!! $data->promotion_detail !!} -->
              </div>

                <!-- <h1>ดีลเดือดกลางเดือน ลดสูงสุด 50%</h1>
                <div class="detail-editor">
                  <p>Vestibulum et erat nec nisi tincidunt convallis at eu dui. Aenean vitae est ut ipsum blandit aliquam commodo a ante. Vivamus eleifend id justo sit amet luctus. Praesent vitae dui id nunc tincidunt volutpat at quis dolor. Morbi ut scelerisque elit, id tempor quam. Duis id pretium nibh, vitae tincidunt velit. Fusce ac neque scelerisque, scelerisque massa vel, suscipit ex. Vestibulum vitae enim sit amet est venenatis dignissim eget non neque. In hac habitasse platea dictumst. Nulla facilisi. Suspendisse potenti.</p>
                  <p>Proin id libero a quam laoreet tristique. In quis lectus nec odio egestas facilisis. Mauris pharetra sem vel nunc scelerisque posuere. Ut auctor ultricies libero. Sed ultrices viverra dui, non vestibulum ex mollis sed.</p>
                </div> -->
            </div>
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