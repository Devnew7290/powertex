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
                <h2 class="wow fadeInDown">โปรโมชั่น</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12 promotion-inside-grid">
                @foreach($promotion as $rs)
                    <?php
                        $promotionTopic = preg_replace('/[^a-zA-Z0-9ก-๙\s]/u', '', $rs->promotion_topic);
                        $promotionURL = $rs->promotion_url ? $rs->promotion_url : $promotionTopic;
                    ?>
                    <a href="{{url('news-detail/promotion/'.$rs->promotion_id.'/'.$promotionURL)}}" class="promotion-item">
                        <img src="{{asset($rs->promotion_image_cover)}}" alt="">
                    </a>
                @endforeach
                <!-- <a href="promotion-detail.php" class="promotion-item">
                    <img src="{{asset('images/image-promo.jpg')}}" alt="">
                </a>
                <a href="promotion-detail.php" class="promotion-item">
                    <img src="{{asset('images/image-promo.jpg')}}" alt="">
                </a>
                <a href="promotion-detail.php" class="promotion-item">
                    <img src="{{asset('images/image-promo.jpg')}}" alt="">
                </a>
                <a href="promotion-detail.php" class="promotion-item">
                    <img src="{{asset('images/image-promo.jpg')}}" alt="">
                </a>
                <a href="promotion-detail.php" class="promotion-item">
                    <img src="{{asset('images/image-promo.jpg')}}" alt="">
                </a> -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <ul class="pagination wow fadeInDown">
                    @if($promotion->total() > 5)
                        @if($promotion->lastPage() < 11)
                            @if($promotion->lastPage() != 1)
                                @if ($promotion->onFirstPage())
                                    <li class="paginate_button page-item"><a class="page-link">
                                @else
                                    <li class="paginate_button page-item active"><a href="{{ $promotion->previousPageUrl() }}" class="page-link">
                                @endif
                                    <i class="bi bi-chevron-left"></i></a>
                                </li>
                            @endif
                            @for ($i = 1; $i <= $promotion->lastPage(); $i++)
                                @if ($promotion->currentPage() == $i)
                                    <li class="paginate_button page-item active">
                                @else
                                    <li class="paginate_button page-item">
                                @endif
                                    <a href="{{ $promotion->url($i) }}" class="page-link">{{ $i }}</a>
                                </li>
                            @endfor
                            
                            @if($promotion->lastPage() != 1)
                                @if ($promotion->hasMorePages())
                                    <li class="paginate_button page-item active"><a href="{{ $promotion->nextPageUrl() }}" class="page-link">
                                @else
                                    <li class="paginate_button page-item"><a class="page-link">
                                @endif
                                    <i class="bi bi-chevron-right"></i></a>
                                </li>
                            @endif
                        @else
                            @if ($promotion->onFirstPage())
                                <li class="paginate_button page-item"><a class="page-link">
                            @else
                                <li class="paginate_button page-item active"><a href="{{ $promotion->previousPageUrl() }}" class="page-link">
                            @endif
                                <i class="bi bi-chevron-left"></i></a>
                            </li>
                            @if($promotion->currentPage() > 4)
                                <li class="paginate_button page-item"><a href="{{ $promotion->url(1) }}" class="page-link">1</a></li>
                            @endif
                            @if($promotion->currentPage() > 5)
                                <li class="paginate_button page-item"><a class="page-link">...</a></li>
                            @endif
                            @foreach(range(1, $promotion->lastPage()) as $i)
                                @if($i >= $promotion->currentPage() - 3 && $i <= $promotion->currentPage() + 3)
                                    @if ($i == $promotion->currentPage())
                                        <li class="paginate_button page-item active"><a class="page-link">{{ $i }}</a></li>
                                    @else
                                        <li class="paginate_button page-item"><a href="{{ $promotion->url($i) }}" class="page-link">{{ $i }}</a></li>
                                    @endif
                                @endif
                            @endforeach
                            @if($promotion->currentPage() < $promotion->lastPage() - 4)
                                <li class="paginate_button page-item"><a class="page-link">...</a></li>
                            @endif
                            @if($promotion->currentPage() < $promotion->lastPage() - 3)
                                <li class="paginate_button page-item"><a href="{{ $promotion->url($promotion->lastPage()) }}" class="page-link">{{ $promotion->lastPage() }}</a></li>
                            @endif
                            @if ($promotion->hasMorePages())
                                <li class="paginate_button page-item active"><a href="{{ $promotion->nextPageUrl() }}" class="page-link">
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
  <section class="container-fluid section-inside news-inside-section">
    <div class="container">
      <div class="row">
        <div class="col-12 head-fp head-fp-center">
          <h2 class="wow fadeInDown">ข่าวสาร และกิจกรรม</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
            <div class="article-grid wow fadeInDown">
                @foreach($news as $rs)
                    <?php
                        $newsTopic = preg_replace('/[^a-zA-Z0-9ก-๙\s]/u', '', $rs->news_topic);
                        $newsURL = $rs->news_url ? $rs->news_url : $newsTopic;
                    ?>
                    <a href="{{ url('news-detail/news/'.$rs->news_id.'/'.$newsURL) }}" class="article-item">
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
                                preg_match('/<p>(.*?)<\/p>/', $rs->news_detail, $matches);
                                $first_paragraph = $matches[1] ?? '';
                            @endphp
                            <div class="news-text"><p>{!! $first_paragraph !!}</p></div>
                            <style>
                            .news-text {
                                display: block;
                                overflow: hidden;
                                position: relative;
                            }
                            .fade-out {
                                position: absolute;
                                bottom: 0;
                                right: 0;
                                background: white;
                                padding-left: 5px;
                            }
                            </style>
                            <div class="btn-arrow"></div>
                            </figcaption>
                        </figure>
                    </a>
                @endforeach
            </div>
            <ul class="pagination wow fadeInDown">
                @if($news->total() > 6)
                    @if($news->lastPage() < 11)
                        @if($news->lastPage() != 1)
                            @if ($news->onFirstPage())
                                <li class="paginate_button page-item"><a class="page-link">
                            @else
                                <li class="paginate_button page-item active"><a href="{{ $news->previousPageUrl() }}" class="page-link">
                            @endif
                                <i class="bi bi-chevron-left"></i></a>
                            </li>
                        @endif
                        @for ($i = 1; $i <= $news->lastPage(); $i++)
                            @if ($news->currentPage() == $i)
                                <li class="paginate_button page-item active">
                            @else
                                <li class="paginate_button page-item">
                            @endif
                                <a href="{{ $news->url($i) }}" class="page-link">{{ $i }}</a>
                            </li>
                        @endfor
                        
                        @if($news->lastPage() != 1)
                            @if ($news->hasMorePages())
                                <li class="paginate_button page-item active"><a href="{{ $news->nextPageUrl() }}" class="page-link">
                            @else
                                <li class="paginate_button page-item"><a class="page-link">
                            @endif
                                <i class="bi bi-chevron-right"></i></a>
                            </li>
                        @endif
                    @else
                        @if ($news->onFirstPage())
                            <li class="paginate_button page-item"><a class="page-link">
                        @else
                            <li class="paginate_button page-item active"><a href="{{ $news->previousPageUrl() }}" class="page-link">
                        @endif
                            <i class="bi bi-chevron-left"></i></a>
                        </li>
                        @if($news->currentPage() > 4)
                            <li class="paginate_button page-item"><a href="{{ $news->url(1) }}" class="page-link">1</a></li>
                        @endif
                        @if($news->currentPage() > 5)
                            <li class="paginate_button page-item"><a class="page-link">...</a></li>
                        @endif
                        @foreach(range(1, $news->lastPage()) as $i)
                            @if($i >= $news->currentPage() - 3 && $i <= $news->currentPage() + 3)
                                @if ($i == $news->currentPage())
                                    <li class="paginate_button page-item active"><a class="page-link">{{ $i }}</a></li>
                                @else
                                    <li class="paginate_button page-item"><a href="{{ $news->url($i) }}" class="page-link">{{ $i }}</a></li>
                                @endif
                            @endif
                        @endforeach
                        @if($news->currentPage() < $news->lastPage() - 4)
                            <li class="paginate_button page-item"><a class="page-link">...</a></li>
                        @endif
                        @if($news->currentPage() < $news->lastPage() - 3)
                            <li class="paginate_button page-item"><a href="{{ $news->url($news->lastPage()) }}" class="page-link">{{ $news->lastPage() }}</a></li>
                        @endif
                        @if ($news->hasMorePages())
                            <li class="paginate_button page-item active"><a href="{{ $news->nextPageUrl() }}" class="page-link">
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