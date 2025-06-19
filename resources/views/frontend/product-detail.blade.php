<!doctype html>
<html>
<head>
<meta name="keywords" content="{{$product->products_keywords}}" />
<meta name="description" content="{{$product->products_description}}" />
<title>Powertex</title>
<?php // require('inc_header.php'); ?>
  @include('frontend.inc_header')
</head>
<body>
  <?php // require('inc_menu.php'); ?>
  @include('frontend.inc_menu')
  
  <section class="container-fluid product-detail-bg">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-5 product-detail-slide wow fadeInLeft">
                <div class="owl-carousel owl-theme product-detail-slider">
                    @foreach($image as $rs)
                    <a href="{{asset($rs->pi_image)}}" data-fancybox="slide" class="product-detail-img">
                        <img src="{{asset($rs->pi_image)}}" alt="">
                    </a>
                    @endforeach
                    <!-- <a href="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" data-fancybox="slide" class="product-detail-img">
                        <img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt="">
                    </a>
                    <a href="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" data-fancybox="slide" class="product-detail-img">
                        <img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt="">
                    </a> -->
                </div>
                <div class="owl-carousel owl-theme product-detail-carousel">
                    @foreach($image as $rs)
                    <div class="product-detail-img">
                        <img src="{{asset($rs->pi_image)}}" alt="">
                    </div>
                    @endforeach
                    <!-- <div class="product-detail-img">
                        <img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt="">
                    </div>
                    <div class="product-detail-img">
                        <img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt="">
                    </div> -->
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-7 product-detail wow fadeInRight">
                <div class="breadcrumb-product">
                    <a href="{{ url('/') }}" class="breadcrumb-product-link">หน้าหลัก</a>
                    <i class="bi bi-chevron-right"></i>
                        @php $URLbrand = $brand->brand_url ? $brand->brand_url : "brand"; @endphp
                        <a href="{{ url('products/'.$brand->brand_id.'/'.$URLbrand) }}" class="breadcrumb-product-link">{{$brand->brand_name}}</a>
                    <i class="bi bi-chevron-right"></i>
                    <div class="breadcrumb-product-link">{{$category->cm_name}}</div>
                </div>
                <hgroup>
                    <h2>{{$brand->brand_name}}</h2>
                    <h1>{{$product->products_name}}</h1>
                </hgroup>
                <div class="product-detail-sku">รหัสสินค้า {{$product->products_code}}</div>
                <div class="product-detail-price-box">
                    <h6>ราคา</h6>
                    @php
                      $dateFull = new DateTime();
                      $date = $dateFull->format('Y-m-d');

                      $PP = App\Models\Promotions::where('promotion_status', 'show')
                        ->where('promotion_date_start', '<=', $date)
                        ->where('promotion_date_end', '>=', $date)
                        ->where('promotion_status', 'show')
                        ->whereRaw('FIND_IN_SET(?, promotion_product)', [$product->products_id])
                        ->orderBy('promotion_number', 'asc')->first();
                    @endphp
                    @if($PP)
                        @if($PP->promotion_type == 'bath')
                            <div class="product-detail-price product-detail-price-sale">
                                <span>฿ {{$product->products_price_full}}</span>
                                ฿ {{ $product->products_price_full - $PP->promotion_price }}
                            </div>
                        @else
                            <div class="product-detail-price product-detail-price-sale">
                                <span>฿ {{$product->products_price_full}}</span>
                                ฿ {{ round($product->products_price_full - ($product->products_price_full * ($PP->promotion_price / 100))) }}
                            </div>
                        @endif
                    @else
                        @if($product->products_price_promotion)
                            <div class="product-detail-price product-detail-price-sale">
                                <span>฿ {{number_format($product->products_price_full)}}</span>
                                ฿ {{number_format($product->products_price_promotion)}}
                            </div>
                        @else
                            <div class="product-price">฿ {{number_format($product->products_price_full)}}</div>
                        @endif
                    @endif
                </div>
                {!! $product->products_note !!}
                <!-- <p>
                    ไขควงกระแทกไร้สาย POWERTEX รุ่น PPT-CL-ID-140  ที่สุดของพลังขัน ทำงานละเอียดได้ดีที่สุด พลังแรงบิดสูงถึง 140 Nm. ทำงานหนักได้สบาย มาพร้อมโหมดที่หลากหลาย ทำงานเต็มประสิทธิภาพในแบบที่คุณต้องการ พร้อมลุยทุกงานทุ่นแรงได้เยอะแรงจัด ทนจริง มอเตอร์ทำงานเต็มประสิทธิภาพด้วยมอเตอร์แบบไร้แปรงถ่าน มีนวัตกรรม ปรับแรงบิดอัตโนมัติตามวัสดุที่ขัน ให้ช่างมืออาชีพทำงานได้สะดวกยิ่งขึ้น เอาใจสาย DIY ใช้งานง่าย ทำงานมั่นใจ
                </p> -->
                <div class="product-detail-status">
                    <h6>สถานะสินค้า</h6>
                    <div class="product-detail-status-green">
                        @if($product->products_send == 'ready')
                            สินค้าพร้อมส่ง (จัดส่งภายใน 2-5 วัน)
                        @elseif($product->products_send == 'out')
                            สินค้าหมด
                        @else
                            สินค้าใกล้หมด
                        @endif
                    </div>
                </div>
                <div class="product-detail-quantity">
                    <h6>จำนวนสินค้า</h6>
                    <div class="product-detail-quantity-box">
                        @if($product->products_send == 'ready' && !empty($product->products_quantity))
                            <button type="button" class="product-detail-quantity-btn" onclick="decreaseQty()">-</button>
                            {{-- <input type="number" class="product-detail-quantity-input qty-input" id="quantityInput" value="1" min="1" max="{{$product->products_quantity}}" oninput="validateQtyInput(this)"> --}}
                            <input type="number" class="product-detail-quantity-input qty-input" id="quantityInput"
                                value="{{ request('qty', 1) }}"
                                min="1" max="{{$product->products_quantity}}" oninput="validateQtyInput(this)">
                            <button type="button" class="product-detail-quantity-btn" onclick="increaseQty()">+</button>
                        @else
                            <button type="button" class="product-detail-quantity-btn" disabled>-</button>
                            <input type="text" class="product-detail-quantity-input qty-input" value="0" disabled>
                            <button type="button" class="product-detail-quantity-btn" disabled>+</button>
                        @endif
                    </div>

                    {{-- <div class="product-detail-quantity-box">
                        @if($product->products_send == 'ready' && !empty($product->products_quantity))
                            <button class="product-detail-quantity-btn qty-btn" onclick="decreaseQty()">-</button>
                            <input type="number" 
                                class="product-detail-quantity-input qty-input" 
                                id="quantityInput"
                                value="1"
                                min="1" 
                                max="{{$product->products_quantity}}">
                            <button class="product-detail-quantity-btn qty-btn qty-plus" onclick="increaseQty()">+</button>
                        @else
                            <button class="product-detail-quantity-btn qty-btn" disabled>-</button>
                            <input type="text" class="product-detail-quantity-input qty-input" value="0" disabled>
                            <button class="product-detail-quantity-btn qty-btn qty-plus" disabled>+</button>
                        @endif
                    </div> --}}
                </div>
                <button class="product-detail-addcart"><img src="{{ asset('images/icon-cart.svg') }}" alt=""><span>เพิ่มไปยังรถเข็น</span></button>
            </div>
        </div>
    </div>
  </section>
  <section class="container-fluid">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <ul class="product-detail-tab">
            <li class="active">รายละเอียดสินค้า</li>
            <li>การรับประกัน</li>
            <li>คู่มือการใช้งาน</li>
          </ul>
          <div>
            <div class="product-detail-tab-content">
              <div class="detail-editor">
                {!! $product->products_detail !!}
                <!-- <ul>
                  <li>สวิตซ์ปรับความเร็วรอบได้</li>
                  <li>เดินหน้าถอยหลังได้</li>
                  <li>หัวจับดอกขนาด 1/4 </li>
                  <li>สามารถปรับได้ 3 Speed I 40 / II 85 / III 140 Nm. (ถอยหลัง 1 Speed)</li>
                  <li>ความเร็วรอบหมุนเปล่า 0-1000/0-2000/0-3200 rpm</li>
                  <li>อัตราการกระแทก 0-1300/0-2500/0-4000 ipm</li>
                  <li>ระบบ Auto Stop ขันสกรูได้อย่างมั่นใจ ป้องกันเกลียวรูด ปรับแรงบิดได้เองตามวัสดุที่ขัน</li>
                  <li>มอเตอร์แบบ Brushless ที่มีคุณภาพระดับท็อป </li>
                  <li>แบตเตอร์รี่ LITHIUM-ION 16V/2.0mAh มีระบบ BMS(ถนอมอายุการใช้งานของเซลล์)</li>
                  <li>แบตเตอรี่ขนาด 2000 mAh แบบ 10C (คลายประจุได้เร็วกว่า ประสิทธิภาพสูงกว่า)</li>
                  <li>แบตเตอรี่ 1 ก้อน ใช้เวลาในการชาร์จเพียง 1.5 ชั่วโมง</li>
                  <li>มีไฟแสดงสถานะแบตเตอร</li>
                  <li>มีไฟส่องสว่าง ไร้เงา, ทำงานในที่มืดสะดวก</li>
                  <li>มีกริปยางที่ออกแบบมาเพื่อความถนัดมือและลดการลื่นหลุดขณะใช้งาน</li>
                  <li>มีขนาดเล็กกะทัดรัด ตัวเล็ก คอสั้นน้ำหนักเบา จับถนัดมือ เหมาะสำหรับงานปรับปรุงซ่อมแซม</li>
                </ul> -->
              </div>
            </div>
            <div class="product-detail-tab-content">
              <div class="detail-editor">
                <h6>เงื่อนไขการรับประกัน</h6>
                {!! $product->products_guarantee !!}
                <!-- <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis dictum erat nisi, a hendrerit lacus feugiat in. Sed at libero accumsan, consectetur erat nec, commodo mauris. Aenean lacinia lacinia gravida. Curabitur semper lectus leo, lobortis tincidunt lorem feugiat non. Duis libero dui, viverra non ex vel, tempus blandit ex. Proin ut pharetra tellus. Vivamus semper, urna sit amet tempor gravida, erat nisl fringilla lectus, ut venenatis mi lectus et ante. Proin pulvinar elementum justo vitae lacinia. Praesent eu ex nibh. Aenean et bibendum arcu. Suspendisse convallis felis augue, sit amet congue felis scelerisque et
                </p> -->
              </div>
            </div>
            <div class="product-detail-tab-content">
                <div class="detail-editor">
                    <h6>คู่มือการใช้งาน</h6>
                </div>
                @if($product->products_vdo)
                    <div class="video-frame">
                        <iframe width="560" height="315" src="{{ $product->products_vdo }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                @endif
                <ul class="file-list">
                    @if($product->products_manual)
                        <li><a href="{{ asset($product->products_manual) }}"><i class="bi bi-file-arrow-down"></i> คู่มือการใช้งานภาษาไทย</a></li>
                    @endif
                    @if($product->products_manual_two)
                        <li><a href="{{ asset($product->products_manual_two) }}"><i class="bi bi-file-arrow-down"></i> คู่มือการใช้งาน</a></li>
                    @endif
                </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="container-fluid related-product-section overflow-hidden">
    <div class="container">
        <div class="row">
            <div class="col-12 head-fp head-fp-center">
                <h2 class="wow fadeInDown">สินค้าที่เกี่ยวข้อง</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12 wow fadeInDown">
                <div class="product-carousel owl-carousel owl-theme">
                    @foreach($productOther as $rs)
                        <?php
                            $productTopic = preg_replace('/[^a-zA-Z0-9ก-๙\s]/u', '', $rs->products_code);
                            $urlProduct = $rs->products_url ? $rs->products_url : $productTopic;
                        ?>
                        <a href="{{ url('product/detail/'.$rs->products_id.'/'.$urlProduct) }}" class="product-item">
                            <figure>
                                <div class="product-img">
                                @php $i = 1; @endphp
                                @foreach($imageOther as $row)
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
                    <!-- <a href="#" class="product-item">
                    <figure>
                        <div class="product-img"><img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt=""></div>
                        <figcaption>
                        <h3>ไขควงกระแทกไร้สาย POWERTEX รุ่น PPT-CL-ID-140</h3>
                        <p>รหัสสินค้า PPT-CL-ID-140</p>
                        <div class="product-price product-price-sale"><span>฿ 3,890</span><div>฿ 3,190</div></div>
                        </figcaption>
                    </figure>
                    </a>
                    <a href="#" class="product-item">
                    <figure>
                        <div class="product-img"><img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt=""></div>
                        <figcaption>
                        <h3>เครื่องเจียรไฟฟ้า 4" POWERTEX รุ่น PPT-AG-100-D</h3>
                        <p>รหัสสินค้า PPT-AG-100-D</p>
                        <div class="product-price product-price-sale"><span>฿ 1,190</span><div>฿ 990</div></div>
                        </figcaption>
                    </figure>
                    </a>
                    <a href="#" class="product-item">
                    <figure>
                        <div class="product-img"><img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt=""></div>
                        <figcaption>
                        <h3>ไขควงกระแทกไร้สาย POWERTEX รุ่น PPT-CL-ID-140</h3>
                        <p>รหัสสินค้า PPT-CL-ID-140</p>
                        <div class="product-price">฿ 3,190</div>
                        </figcaption>
                    </figure>
                    </a>
                    <a href="#" class="product-item">
                    <figure>
                        <div class="product-img"><img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt=""></div>
                        <figcaption>
                        <h3>เครื่องเจียรไฟฟ้า 4" POWERTEX รุ่น PPT-AG-100-D</h3>
                        <p>รหัสสินค้า PPT-AG-100-D</p>
                        <div class="product-price">฿ 990.00</div>
                        </figcaption>
                    </figure>
                    </a>
                    <a href="#" class="product-item">
                    <figure>
                        <div class="product-img"><img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt=""></div>
                        <figcaption>
                        <h3>ไขควงกระแทกไร้สาย POWERTEX รุ่น PPT-CL-ID-140</h3>
                        <p>รหัสสินค้า PPT-CL-ID-140</p>
                        <div class="product-price product-price-sale"><span>฿ 3,890</span><div>฿ 3,190</div></div>
                        </figcaption>
                    </figure>
                    </a>
                    <a href="#" class="product-item">
                    <figure>
                        <div class="product-img"><img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt=""></div>
                        <figcaption>
                        <h3>เครื่องเจียรไฟฟ้า 4" POWERTEX รุ่น PPT-AG-100-D</h3>
                        <p>รหัสสินค้า PPT-AG-100-D</p>
                        <div class="product-price product-price-sale"><span>฿ 1,190</span><div>฿ 990</div></div>
                        </figcaption>
                    </figure>
                    </a>
                    <a href="#" class="product-item">
                    <figure>
                        <div class="product-img"><img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt=""></div>
                        <figcaption>
                        <h3>ไขควงกระแทกไร้สาย POWERTEX รุ่น PPT-CL-ID-140</h3>
                        <p>รหัสสินค้า PPT-CL-ID-140</p>
                        <div class="product-price product-price-sale"><span>฿ 3,890</span><div>฿ 3,190</div></div>
                        </figcaption>
                    </figure>
                    </a>
                    <a href="#" class="product-item">
                    <figure>
                        <div class="product-img"><img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt=""></div>
                        <figcaption>
                        <h3>เครื่องเจียรไฟฟ้า 4" POWERTEX รุ่น PPT-AG-100-D</h3>
                        <p>รหัสสินค้า PPT-AG-100-D</p>
                        <div class="product-price product-price-sale"><span>฿ 1,190</span><div>฿ 990</div></div>
                        </figcaption>
                    </figure>
                    </a>
                    <a href="#" class="product-item">
                    <figure>
                        <div class="product-img"><img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt=""></div>
                        <figcaption>
                        <h3>ไขควงกระแทกไร้สาย POWERTEX รุ่น PPT-CL-ID-140</h3>
                        <p>รหัสสินค้า PPT-CL-ID-140</p>
                        <div class="product-price">฿ 3,190</div>
                        </figcaption>
                    </figure>
                    </a>
                    <a href="#" class="product-item">
                    <figure>
                        <div class="product-img"><img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt=""></div>
                        <figcaption>
                        <h3>เครื่องเจียรไฟฟ้า 4" POWERTEX รุ่น PPT-AG-100-D</h3>
                        <p>รหัสสินค้า PPT-AG-100-D</p>
                        <div class="product-price">฿ 990.00</div>
                        </figcaption>
                    </figure>
                    </a>
                    <a href="#" class="product-item">
                    <figure>
                        <div class="product-img"><img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt=""></div>
                        <figcaption>
                        <h3>ไขควงกระแทกไร้สาย POWERTEX รุ่น PPT-CL-ID-140</h3>
                        <p>รหัสสินค้า PPT-CL-ID-140</p>
                        <div class="product-price product-price-sale"><span>฿ 3,890</span><div>฿ 3,190</div></div>
                        </figcaption>
                    </figure>
                    </a>
                    <a href="#" class="product-item">
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
            </div>
        </div>
    </div>
  </section>
  <?php // require('inc_footer.php'); ?>
  @include('frontend.inc_footer')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    function increaseQty() {
        const input = document.getElementById('quantityInput');
        const max = parseInt(input.max, 10);
        let current = parseInt(input.value, 10);

        if (isNaN(current) || current < 1) current = 1;
        if (current >= max) {
            input.value = max;
            alert('ไม่สามารถเพิ่มจำนวนได้มากกว่าสินค้าที่มีในสต็อก');
        } else {
            input.value = current + 1;
        }
    }

    function decreaseQty() {
        const input = document.getElementById('quantityInput');
        const min = parseInt(input.min, 10);
        let current = parseInt(input.value, 10);

        if (isNaN(current) || current <= min) {
            input.value = min;
        } else {
            input.value = current - 1;
        }
    }

    // เพิ่ม validate กรณีผู้ใช้พิมพ์เอง
    function validateQtyInput(input) {
        let min = parseInt(input.min, 10);
        let max = parseInt(input.max, 10);
        let val = parseInt(input.value, 10);

        if (isNaN(val) || val < min) input.value = min;
        if (val > max) input.value = max;
    }

    $(document).ready(function(){

        $('.product-detail-slide').each(function(){
        (function(_e){
            var sync1 = $(_e).find(".product-detail-slider");
            var sync2 = $(_e).find(".product-detail-carousel");

            var thumbnailItemClass = '.owl-item';

            var slides = sync1.owlCarousel({
                video:true,
                startPosition: 0,
                items:1,
                loop:false,
                rewind: true,
                margin:10,
                autoplay:false,
                autoplayHoverPause: true,
                autoplayTimeout:7000,
                smartSpeed: 700,
                autoHeight:true,
                autoplayHoverPause:true,
                //navText: ['<span><i class="bi bi-chevron-left"></i></span>','<span><i class="bi bi-chevron-right"></i></span>'],
                nav: false,
                dots: false
            }).on('changed.owl.carousel', syncPosition);

            function syncPosition(el) {
                $owl_slider = $(this).data('owl.carousel');
                var loop = $owl_slider.options.loop;

                if(loop){
                var count = el.item.count-1;
                var current = Math.round(el.item.index - (el.item.count/2) - .5);
                if(current < 0) {
                    current = count;
                }
                if(current > count) {
                    current = 0;
                }
                }else{
                var current = el.item.index;
                
                }
                console.log(current);

                var owl_thumbnail = sync2.data('owl.carousel');
                var itemClass = "." + owl_thumbnail.options.itemClass;


                var thumbnailCurrentItem = sync2
                .find(itemClass)
                .removeClass("synced")
                .eq(current);

                thumbnailCurrentItem.addClass('synced');

                //if (!thumbnailCurrentItem.hasClass('active')) {
                var duration = 300;
                sync2.trigger('to.owl.carousel',[current-1, duration, true]);
                //}   
            }
            var thumbs = sync2.owlCarousel({
                startPosition: 0,
                items: 6,
                loop:false,
                margin: 15,
                autoplay:false,
                autoplayHoverPause: true,
                nav: true,
                navText: ['<span><i class="bi bi-chevron-left"></i></span>','<span><i class="bi bi-chevron-right"></i></span>'],
                dots: false,
                responsive:{
                    0:{
                        items:4
                    },
                    768:{
                        items:4
                    },
                    992:{
                        items:4
                    },
                    1201:{
                        items:5
                    }
                },
                onInitialized: function (e) {
                var thumbnailCurrentItem =  $(e.target).find(thumbnailItemClass).eq(this._current);
                thumbnailCurrentItem.addClass('synced');
                },
            })
            .on('click', thumbnailItemClass, function(e) {
                e.preventDefault();
                var duration = 300;
                var itemIndex =  $(e.target).parents(thumbnailItemClass).index();
                sync1.trigger('to.owl.carousel',[itemIndex, duration, true]);
            }).on("changed.owl.carousel", function (el) {
                //var number = el.item.index;
                //$owl_slider = sync1.data('owl.carousel');
                //$owl_slider.to(number, 100, true);
            });
            })(this);
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
                margin: 20
            },
            1201:{
                items:5,
                margin: 20
            }
        }
        });

        $( '.product-detail-tab li' ).click(function (event) {
            var tabno = $(this).index();
            if (  $( ".product-detail-tab-content" ).eq(tabno).is( ":hidden" ) ) {
                $( ".product-detail-tab li" ).removeClass('active');
                $( ".product-detail-tab-content" ).slideUp();
                $(this).addClass("active");
                $( ".product-detail-tab-content" ).eq(tabno).slideDown();
        } else {

        }
        event.stopPropagation();
        });

    });    
</script>

<script>
    $('.product-detail-addcart').on('click', function() {
        var productId = '{{ $product->products_id }}';
        var qty = $('#quantityInput').val();
        $.post('{{ route("cart.add") }}', {
            product_id: productId,
            quantity: qty,
            _token: '{{ csrf_token() }}'
        }, function(response) {
            if(response.status){
                Swal.fire({
                    icon: 'success',
                    title: 'เพิ่มสินค้าในตะกร้าแล้ว',
                    timer: 1200,
                    showConfirmButton: false
                });

                $.get("{{ route('cart.header_text') }}", function(html){
                    $('.header-cart-text').html(html);
                });

                reloadCartBox(); // <<<<<<<<<<<

            }else{
                Swal.fire({
                    icon: 'error',
                    title: response.msg
                });
            }
        }, 'json').fail(function(xhr){
            if(xhr.status === 401){
                var redirectUrl = window.location.pathname + window.location.search;
                if (redirectUrl.indexOf('?') > -1) {
                    redirectUrl += '&qty=' + qty;
                } else {
                    redirectUrl += '?qty=' + qty;
                }
                window.location.href = "{{ route('member.login') }}" + "?redirect=" + encodeURIComponent(redirectUrl);
            }
        });
    });

    // โหลดข้อมูล cart partial แล้วเอาเฉพาะ header-cart-text มาอัปเดต
    function updateHeaderCartText(){
        $.get("{{ route('cart.header_text') }}", function(res){
            if(res.html){
                $('.header-cart-text').html(res.html);
            }
        });
    }
</script>




</body>
</html>