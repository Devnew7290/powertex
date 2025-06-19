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
                      <input type="checkbox" class="type_main" value="{{ $rs->cm_id }}"
                        @foreach($mainArray as $row) @if($rs->cm_id == $row) checked @endif @endforeach>
                      <div class="filter-checkbox-icon"><i class="bi bi-check"></i>{{$rs->cm_name}}</div>
                    </label>
                    <ul class="filter-list filter-checkbox-sub">
                      @foreach($Sub as $row)
                        @php
                          $countThird = 0;
                          foreach($Third as $data){
                            if($row->cs_id == $data->FK_category_sub){
                              $countThird++;
                            }
                          }
                        @endphp
                        @if($rs->cm_id == $row->FK_category_main)
                          <li>
                            <label class="filter-checkbox">
                              <input type="checkbox" class="type_sub" value="{{ $row->cs_id }}"
                                @foreach($subArray as $subA) @if($row->cs_id == $subA) checked @endif @endforeach>
                              <div class="filter-checkbox-icon"><i class="bi bi-check"></i>{{$row->cs_name}}</div>
                            </label>
                            <ul class="filter-list filter-checkbox-sub">
                              @foreach($Third as $data)
                                @if($row->cs_id == $data->FK_category_sub && $countThird > 0)
                                  <li>
                                    <label class="filter-checkbox">
                                      <input type="checkbox" class="type_third" value="{{ $data->ct_id }}"
                                        @foreach($thirdArray as $thirdA) @if($data->ct_id == $thirdA) checked @endif @endforeach>
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
              <!-- <ul class="filter-list">
                  <li>
                      <label class="filter-checkbox">
                          <input type="checkbox">
                          <div class="filter-checkbox-icon"><i class="bi bi-check"></i>เครื่องมือไฟฟ้า</div>
                      </label>
                  </li>
                  <li>
                      <label class="filter-checkbox">
                          <input type="checkbox">
                          <div class="filter-checkbox-icon"><i class="bi bi-check"></i>เครื่องมือเกษตร</div>
                      </label>
                  </li>
                  <li>
                      <label class="filter-checkbox">
                          <input type="checkbox">
                          <div class="filter-checkbox-icon"><i class="bi bi-check"></i>เครื่องปั่นไฟ / เครื่องเชื่อมไฟฟ้า</div>
                      </label>
                  </li>
                  <li>
                      <label class="filter-checkbox">
                          <input type="checkbox">
                          <div class="filter-checkbox-icon"><i class="bi bi-check"></i>Acessories</div>
                      </label>
                      <ul class="filter-list filter-checkbox-sub">
                          <li>
                              <label class="filter-checkbox">
                                  <input type="checkbox">
                                  <div class="filter-checkbox-icon"><i class="bi bi-check"></i>Acessories 1</div>
                              </label>
                              <ul class="filter-list filter-checkbox-sub">
                                  <li>
                                      <label class="filter-checkbox">
                                          <input type="checkbox">
                                          <div class="filter-checkbox-icon"><i class="bi bi-check"></i>Acessories 1.1</div>
                                      </label>
                                  </li>
                                  <li>
                                      <label class="filter-checkbox">
                                          <input type="checkbox">
                                          <div class="filter-checkbox-icon"><i class="bi bi-check"></i>Acessories 1.2</div>
                                      </label>
                                  </li>
                                  <li>
                                      <label class="filter-checkbox">
                                          <input type="checkbox">
                                          <div class="filter-checkbox-icon"><i class="bi bi-check"></i>Acessories 1.3</div>
                                      </label>
                                  </li>
                                  <li>
                                      <label class="filter-checkbox">
                                          <input type="checkbox">
                                          <div class="filter-checkbox-icon"><i class="bi bi-check"></i>Acessories 1.4</div>
                                      </label>
                                  </li>
                              </ul>
                          </li>
                          <li>
                              <label class="filter-checkbox">
                                  <input type="checkbox">
                                  <div class="filter-checkbox-icon"><i class="bi bi-check"></i>Acessories 2</div>
                              </label>
                          </li>
                          <li>
                              <label class="filter-checkbox">
                                  <input type="checkbox">
                                  <div class="filter-checkbox-icon"><i class="bi bi-check"></i>Acessories 3</div>
                              </label>
                          </li>
                      </ul>
                  </li>
              </ul> -->
              <!-- <button class="login-btn">ยืนยัน</button> -->
              <!-- <button class="filter-submit">ยืนยัน</button> -->
            </form>
            <div class="overlay-filter"></div>
          </div>
          <div class="product-grid wow fadeInDown">
            @foreach($product as $rs)
              <?php
                $productTopic = preg_replace('/[^a-zA-Z0-9ก-๙\s]/u', '', $rs->products_code);
                $urlProduct = $rs->products_url ? $rs->products_url : $productTopic;
              ?>
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
                            <span>฿ {{number_format($rs->products_price_full)}}</span><div>฿ {{number_format($rs->products_price_promotion)}}</div>
                          @else
                            <div class="product-price">฿ {{number_format($rs->products_price_full)}}</div>
                          @endif
                        @endif
                      </div>
                      </figcaption>
                  </figure>
              </a>
            @endforeach
            <!-- <a href="{{ url('product-detail') }}" class="product-item">
              <figure>
                <div class="product-img"><img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt=""></div>
                <figcaption>
                  <h3>ไขควงกระแทกไร้สาย POWERTEX รุ่น PPT-CL-ID-140</h3>
                  <p>รหัสสินค้า PPT-CL-ID-140</p>
                  <div class="product-price product-price-sale"><span>฿ 3,890</span><div>฿ 3,190</div></div>
                </figcaption>
              </figure>
            </a>
            <a href="{{ url('product-detail') }}" class="product-item">
              <figure>
                <div class="product-img"><img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt=""></div>
                <figcaption>
                  <h3>เครื่องเจียรไฟฟ้า 4" POWERTEX รุ่น PPT-AG-100-D</h3>
                  <p>รหัสสินค้า PPT-AG-100-D</p>
                  <div class="product-price product-price-sale"><span>฿ 1,190</span><div>฿ 990</div></div>
                </figcaption>
              </figure>
            </a>
            <a href="{{ url('product-detail') }}" class="product-item">
              <figure>
                <div class="product-img"><img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt=""></div>
                <figcaption>
                  <h3>ไขควงกระแทกไร้สาย POWERTEX รุ่น PPT-CL-ID-140</h3>
                  <p>รหัสสินค้า PPT-CL-ID-140</p>
                  <div class="product-price">฿ 3,190</div>
                </figcaption>
              </figure>
            </a>
            <a href="{{ url('product-detail') }}" class="product-item">
              <figure>
                <div class="product-img"><img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt=""></div>
                <figcaption>
                  <h3>เครื่องเจียรไฟฟ้า 4" POWERTEX รุ่น PPT-AG-100-D</h3>
                  <p>รหัสสินค้า PPT-AG-100-D</p>
                  <div class="product-price">฿ 990.00</div>
                </figcaption>
              </figure>
            </a>
            <a href="{{ url('product-detail') }}" class="product-item">
              <figure>
                <div class="product-img"><img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt=""></div>
                <figcaption>
                  <h3>ไขควงกระแทกไร้สาย POWERTEX รุ่น PPT-CL-ID-140</h3>
                  <p>รหัสสินค้า PPT-CL-ID-140</p>
                  <div class="product-price product-price-sale"><span>฿ 3,890</span><div>฿ 3,190</div></div>
                </figcaption>
              </figure>
            </a>
            <a href="{{ url('product-detail') }}" class="product-item">
              <figure>
                <div class="product-img"><img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt=""></div>
                <figcaption>
                  <h3>เครื่องเจียรไฟฟ้า 4" POWERTEX รุ่น PPT-AG-100-D</h3>
                  <p>รหัสสินค้า PPT-AG-100-D</p>
                  <div class="product-price product-price-sale"><span>฿ 1,190</span><div>฿ 990</div></div>
                </figcaption>
              </figure>
            </a>
            <a href="{{ url('product-detail') }}" class="product-item">
              <figure>
                <div class="product-img"><img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt=""></div>
                <figcaption>
                  <h3>ไขควงกระแทกไร้สาย POWERTEX รุ่น PPT-CL-ID-140</h3>
                  <p>รหัสสินค้า PPT-CL-ID-140</p>
                  <div class="product-price product-price-sale"><span>฿ 3,890</span><div>฿ 3,190</div></div>
                </figcaption>
              </figure>
            </a>
            <a href="{{ url('product-detail') }}" class="product-item">
              <figure>
                <div class="product-img"><img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt=""></div>
                <figcaption>
                  <h3>เครื่องเจียรไฟฟ้า 4" POWERTEX รุ่น PPT-AG-100-D</h3>
                  <p>รหัสสินค้า PPT-AG-100-D</p>
                  <div class="product-price product-price-sale"><span>฿ 1,190</span><div>฿ 990</div></div>
                </figcaption>
              </figure>
            </a>
            <a href="{{ url('product-detail') }}#" class="product-item">
              <figure>
                <div class="product-img"><img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt=""></div>
                <figcaption>
                  <h3>ไขควงกระแทกไร้สาย POWERTEX รุ่น PPT-CL-ID-140</h3>
                  <p>รหัสสินค้า PPT-CL-ID-140</p>
                  <div class="product-price">฿ 3,190</div>
                </figcaption>
              </figure>
            </a>
            <a href="{{ url('product-detail') }}" class="product-item">
              <figure>
                <div class="product-img"><img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt=""></div>
                <figcaption>
                  <h3>เครื่องเจียรไฟฟ้า 4" POWERTEX รุ่น PPT-AG-100-D</h3>
                  <p>รหัสสินค้า PPT-AG-100-D</p>
                  <div class="product-price">฿ 990.00</div>
                </figcaption>
              </figure>
            </a>
            <a href="{{ url('product-detail') }}" class="product-item">
              <figure>
                <div class="product-img"><img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt=""></div>
                <figcaption>
                  <h3>ไขควงกระแทกไร้สาย POWERTEX รุ่น PPT-CL-ID-140</h3>
                  <p>รหัสสินค้า PPT-CL-ID-140</p>
                  <div class="product-price product-price-sale"><span>฿ 3,890</span><div>฿ 3,190</div></div>
                </figcaption>
              </figure>
            </a>
            <a href="{{ url('product-detail') }}" class="product-item">
              <figure>
                <div class="product-img"><img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt=""></div>
                <figcaption>
                  <h3>เครื่องเจียรไฟฟ้า 4" POWERTEX รุ่น PPT-AG-100-D</h3>
                  <p>รหัสสินค้า PPT-AG-100-D</p>
                  <div class="product-price product-price-sale"><span>฿ 1,190</span><div>฿ 990</div></div>
                </figcaption>
              </figure>
            </a> -->
          </div>
          <ul class="pagination wow fadeInDown">
            @if($product->total() > 12)
                @if($product->lastPage() < 11)
                    @if($product->lastPage() != 1)
                        @if ($product->onFirstPage())
                            <li class="paginate_button page-item"><a class="page-link">
                        @else
                            <li class="paginate_button page-item active"><a href="{{ $product->appends(request()->all())->previousPageUrl() }}" class="page-link">
                        @endif
                            <i class="bi bi-chevron-left"></i></a>
                        </li>
                    @endif
                    @for ($i = 1; $i <= $product->lastPage(); $i++)
                        @if ($product->currentPage() == $i)
                            <li class="paginate_button page-item active">
                        @else
                            <li class="paginate_button page-item">
                        @endif
                            <a href="{{ $product->appends(request()->all())->url($i) }}" class="page-link">{{ $i }}</a>
                        </li>
                    @endfor
                    
                    @if($product->lastPage() != 1)
                        @if ($product->hasMorePages())
                            <li class="paginate_button page-item active"><a href="{{ $product->appends(request()->all())->nextPageUrl() }}" class="page-link">
                        @else
                            <li class="paginate_button page-item"><a class="page-link">
                        @endif
                            <i class="bi bi-chevron-right"></i></a>
                        </li>
                    @endif
                @else
                    @if ($product->onFirstPage())
                        <li class="paginate_button page-item"><a class="page-link">
                    @else
                        <li class="paginate_button page-item active"><a href="{{ $product->appends(request()->all())->previousPageUrl() }}" class="page-link">
                    @endif
                        <i class="bi bi-chevron-left"></i></a>
                    </li>
                    @if($product->currentPage() > 4)
                        <li class="paginate_button page-item"><a href="{{ $product->appends(request()->all())->url(1) }}" class="page-link">1</a></li>
                    @endif
                    @if($product->currentPage() > 5)
                        <li class="paginate_button page-item"><a class="page-link">...</a></li>
                    @endif
                    @foreach(range(1, $product->lastPage()) as $i)
                        @if($i >= $product->currentPage() - 3 && $i <= $product->currentPage() + 3)
                            @if ($i == $product->currentPage())
                                <li class="paginate_button page-item active"><a class="page-link">{{ $i }}</a></li>
                            @else
                                <li class="paginate_button page-item"><a href="{{ $product->appends(request()->all())->url($i) }}" class="page-link">{{ $i }}</a></li>
                            @endif
                        @endif
                    @endforeach
                    @if($product->currentPage() < $product->lastPage() - 4)
                        <li class="paginate_button page-item"><a class="page-link">...</a></li>
                    @endif
                    @if($product->currentPage() < $product->lastPage() - 3)
                        <li class="paginate_button page-item"><a href="{{ $product->appends(request()->all())->url($product->lastPage()) }}" class="page-link">{{ $product->lastPage() }}</a></li>
                    @endif
                    @if ($product->hasMorePages())
                        <li class="paginate_button page-item active"><a href="{{ $product->appends(request()->all())->nextPageUrl() }}" class="page-link">
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

        $('.type_main:checked').each(function () {
          main.push($(this).val());
        });
        $('.type_sub:checked').each(function () {
          sub.push($(this).val());
        });
        $('.type_third:checked').each(function () {
          third.push($(this).val());
        });

        console.log("main:", main);
        console.log("sub:", sub);
        console.log("third:", third);

        let brand = $('#brand-id').val();
        let brand_url = $('#brand-url').val();

        var baseUrl = "{{ url('/') }}";
        var url = baseUrl + "/products/" + brand + "/" + brand_url + "?";
        if (main.length) url += "main=" + main.join(',') + "&";
        if (sub.length) url += "sub=" + sub.join(',') + "&";
        if (third.length) url += "third=" + third.join(',') + "&";
        if (brand) url += "brand=" + brand;

        url = url.replace(/&$/, '');

        console.log("Redirect URL:", url); // <--- สำคัญ

        window.location.href = url;
    }, 3000);
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
      var checkvalue = $(this).next('.filter-checkbox-text').text();
      if($(this).is(":checked")) {
          $(this).parent('.filter-checkbox').next('.filter-checkbox-sub').slideDown();
      }
  });

  $('.filter-checkbox > input').change(function() {
      if($(this).is(":checked")) {
          $(this).parent('.filter-checkbox').next('.filter-checkbox-sub').slideDown();
      }else{
          $(this).parent('.filter-checkbox').next('.filter-checkbox-sub').find('input').prop('checked', false);
          $(this).parent('.filter-checkbox').parent('li').find('.filter-checkbox-sub').slideUp();
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