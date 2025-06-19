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
  <section class="container-fluid section-inside">
    <div class="container">
      <div class="row">
        <div class="col-12 head-fp head-fp-center">
          <h2 class="wow fadeInDown">บทความ</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
            <div class="article-grid wow fadeInDown">
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

                            @php
                              libxml_use_internal_errors(true);

                              $html = $rs->news_detail;
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
                                line-height: 1.7em; /* ปรับ line-height ของทั้งบล็อก */
                                color: #666666;
                              }

                              .detail-editor img {
                                display: inline-block;
                                max-height: 1em;
                                height: 1em;
                                width: auto;
                                vertical-align: middle;  /* ให้ภาพแนบกับข้อความ */
                                margin: 0; /* ลบ margin ที่อาจทำให้เว้นช่องว่าง */
                              }

                              .detail-editor p {
                                line-height: 1.7em; /* ปรับ line-height ของ <p> ให้เหมาะสม */
                                margin: 0; /* ลบ margin ของ <p> */
                                padding: 0; /* ลบ padding ของ <p> */
                              }

                              .detail-editor p img {
                                vertical-align: middle; /* ให้แนบกับข้อความ */
                              }
                            </style>

                            <div class="detail-editor">
                              {!! $output !!}
                            </div>
                            <!-- <p>{!! $output !!}</p> -->
                            <!-- <p>{!! $rs->news_detail !!}</p> -->

                            <div class="btn-arrow"></div>
                            </figcaption>
                        </figure>
                    </a>
                @endforeach
            </div>
            <ul class="pagination wow fadeInDown">
              @if($article->total() > 12)
                  @if($article->lastPage() < 11)
                      @if($article->lastPage() != 1)
                          @if ($article->onFirstPage())
                              <li class="paginate_button page-item"><a class="page-link">
                          @else
                              <li class="paginate_button page-item active"><a href="{{ $article->previousPageUrl() }}" class="page-link">
                          @endif
                              <i class="bi bi-chevron-left"></i></a>
                          </li>
                      @endif
                      @for ($i = 1; $i <= $article->lastPage(); $i++)
                          @if ($article->currentPage() == $i)
                              <li class="paginate_button page-item active">
                          @else
                              <li class="paginate_button page-item">
                          @endif
                              <a href="{{ $article->url($i) }}" class="page-link">{{ $i }}</a>
                          </li>
                      @endfor
                      
                      @if($article->lastPage() != 1)
                          @if ($article->hasMorePages())
                              <li class="paginate_button page-item active"><a href="{{ $article->nextPageUrl() }}" class="page-link">
                          @else
                              <li class="paginate_button page-item"><a class="page-link">
                          @endif
                              <i class="bi bi-chevron-right"></i></a>
                          </li>
                      @endif
                  @else
                      @if ($article->onFirstPage())
                          <li class="paginate_button page-item"><a class="page-link">
                      @else
                          <li class="paginate_button page-item active"><a href="{{ $article->previousPageUrl() }}" class="page-link">
                      @endif
                          <i class="bi bi-chevron-left"></i></a>
                      </li>
                      @if($article->currentPage() > 4)
                          <li class="paginate_button page-item"><a href="{{ $article->url(1) }}" class="page-link">1</a></li>
                      @endif
                      @if($article->currentPage() > 5)
                          <li class="paginate_button page-item"><a class="page-link">...</a></li>
                      @endif
                      @foreach(range(1, $article->lastPage()) as $i)
                          @if($i >= $article->currentPage() - 3 && $i <= $article->currentPage() + 3)
                              @if ($i == $article->currentPage())
                                  <li class="paginate_button page-item active"><a class="page-link">{{ $i }}</a></li>
                              @else
                                  <li class="paginate_button page-item"><a href="{{ $article->url($i) }}" class="page-link">{{ $i }}</a></li>
                              @endif
                          @endif
                      @endforeach
                      @if($article->currentPage() < $article->lastPage() - 4)
                          <li class="paginate_button page-item"><a class="page-link">...</a></li>
                      @endif
                      @if($article->currentPage() < $article->lastPage() - 3)
                          <li class="paginate_button page-item"><a href="{{ $article->url($article->lastPage()) }}" class="page-link">{{ $article->lastPage() }}</a></li>
                      @endif
                      @if ($article->hasMorePages())
                          <li class="paginate_button page-item active"><a href="{{ $article->nextPageUrl() }}" class="page-link">
                      @else
                          <li class="paginate_button page-item"><a class="page-link">
                      @endif
                          <i class="bi bi-chevron-right"></i></a>
                      </li>
                  @endif
              @endif
                <!-- <li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a></li> -->
            </ul>
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