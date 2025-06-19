<footer class="footer-bg wow fadeInUp">
    <div class="container">
        <div class="row">
            <div class="col-12 footer-slogan"><h3>พาวเวอร์เท็กซ์ เครื่องมือไฟฟ้าคุณภาพ จากประเทศอินเดีย</h3></div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-3">
                <h4>คิดถึงคุณภาพ คิดถึงพาวเวอร์เท็กซ์</h4>
                <p>ศูนย์รวมเครื่องมือช่างครบวงจร เป็นที่ยอดรับและไว้วางใจจากลูกค้าทั่วประเทศ มีอะไหล่แท้และศูนย์ซ่อมบำรุง การันตียอดขาย</p>
                <?php
                    $contact = App\Models\Contact::first();
                    $catalog = App\Models\Catalog::orderBy('created_at', 'desc')->first();
                ?>
                <h5>ช่องทางการติดตาม</h5>
                <div class="footer-social">
                    @if($contact->contacts_facebook) <a href="{{$contact->contacts_facebook}}"><img src="{{asset('images/facebook-footer.svg')}}" alt=""></a> @endif
                    @if($contact->contacts_line) <a href="{{$contact->contacts_line}}"><img src="{{asset('images/line-footer.svg')}}" alt=""></a> @endif
                    @if($contact->contacts_ig) <a href="{{$contact->contacts_ig}}"><img src="{{asset('images/instagram-footer.svg')}}" alt=""></a> @endif
                    @if($contact->contacts_yt) <a href="{{$contact->contacts_yt}}"><img src="{{asset('images/youtube-footer.svg')}}" alt=""></a> @endif
                    @if($contact->contacts_tiktok) <a href="{{$contact->contacts_tiktok}}"><img src="{{asset('images/tiktok-footer.svg')}}" alt=""></a> @endif
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-6">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <h5>สินค้าพาวเวอร์เท็กซ์</h5>
                        <ul class="footer-menu">
                            <li><a href="{{ url('products/new') }}">สินค้าใหม่</a></li>
                            <li><a href="{{ url('products/promotion') }}">สินค้าราคาพิเศษ</a></li>
                            <li><a href="#" class="hassub-product">สินค้าทั้งหมด</a></li>
                            <li><a href="{{asset($catalog->catalog_pdf)}}" target="_blank">แคตตาล็อก</a></li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-4">
                        <h5>แผนกบริการลูกค้า</h5>
                        <ul class="footer-menu">
                            <li><a href="{{ url('/warranty') }}">ลงทะเบียนรับประกันสินค้า</a></li>
                            <li><a href="{{ url('/one-stop-service') }}">แจ้งซ่อมสินค้า</a></li>
                            <li><a href="{{ url('/distributor') }}">ตัวแทนจำหน่าย</a></li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-4">
                        <h5>เกี่ยวกับเรา</h5>
                        <ul class="footer-menu">
                            <li><a href="{{ url('/news/news') }}">ข่าวสาร และกิจกรรม</a></li>
                            <li><a href="{{ url('/contact') }}">ติดต่อเรา</a></li>
                            <li><a href="#">นโยบายความเป็นส่วนตัว</a></li>
                            <li><a href="#">ข้อตกลงการใช้งาน</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-3 footer-map">
                <iframe src="{{$contact->contacts_map}}" width="100%" height="215" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
    <div class="footer-copyright-bg">
        <div class="container">
            <div class="row">
                <div class="col-12 footer-copyright">
                    <small>Copyright ©2025 powertex worldwide. All rights reserved.</small>
                    <img src="{{asset('images/visa-mastercard.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="submenu-product">
        <div class="container">
            <div class="row">
                @php
                    $brand = DB::table('brands')->where('brand_status', 'show')->get();
                @endphp
                <div class="col-12 submenu-product-grid">
                    @foreach($brand as $rs)
                        @php
                            $brandName = preg_replace('/[^a-zA-Z0-9ก-๙\s]/u', '', $rs->brand_name);
                            $URLbrand = $rs->brand_url ? $rs->brand_url : $brandName;
                        @endphp
                        <a href="{{ url('products/'.$rs->brand_id.'/'.$URLbrand) }}" class="submenu-product-list"><img src="{{asset($rs->brand_logo)}}" alt="">{{$rs->brand_name}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/modernizr.js')}}"></script>
<script src="{{asset('js/jquery.fancybox.min.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/wow.js')}}"></script>
{{-- sweet alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    var mmH = $('.header-bg').outerHeight(true);
    if (Modernizr.mq('(min-width: 992px)')) {
        $('body').eq(0).css('padding-top', mmH);
    }else{
        $('body').eq(0).css('padding-top', mmH);
    }

    $( '.header-menu-btn' ).click(function (event) {
        var mmH = $('.header-bg').outerHeight(true);
        $('.main-nav').css('top', mmH);
	  if (  $( ".main-nav" ).is( ":hidden" ) ) {
            $( ".submenu-product" ).fadeOut();
            $( ".search-popup" ).slideUp();
            $(this).addClass("active");
            $( ".cart-box" ).effect('slide', { direction: 'right', mode: 'hide' }, 500);
            $( ".main-nav" ).effect('slide', { direction: 'left', mode: 'show' }, 500);
            $('.overlay').fadeIn(500);
	  } else {
          $(this).removeClass("active");
          $( ".main-nav" ).effect('slide', { direction: 'left', mode: 'hide' }, 500);
          $( ".header-menu-btn" ).removeClass('active');
          $('.overlay').fadeOut();
	  }
	  event.stopPropagation();
	});

    $( '.hassub' ).click(function (event) {
	  if (  $(this).children( ".submenu" ).is( ":hidden" ) ) {
            $( '.hassub' ).removeClass('active');
            $( ".search-popup" ).slideUp();
            $(this).addClass("active");
            $(this).children( ".submenu" ).slideDown();
            $('.overlay').fadeIn(500);
	  } else {
            $( '.hassub' ).removeClass('active');
          $( ".submenu" ).slideUp();
	  }
	  event.stopPropagation();
	});

    $( '.hassub-product, .company-fp-btn-product' ).click(function (event) {
        if (  $( ".submenu-product" ).is( ":hidden" ) ) {
            $( ".main-nav" ).effect('slide', { direction: 'left', mode: 'hide' }, 500);
            $( ".cart-box" ).effect('slide', { direction: 'right', mode: 'hide' }, 500);
            $( ".header-menu-btn" ).removeClass('active');
            $( ".search-popup" ).slideUp();
            $(this).addClass("active");
            $( ".submenu-product" ).slideDown();
            $('.overlay').fadeIn(500);
	  } else {
          $(this).removeClass("active");
          $( ".submenu-product" ).slideUp();
          $('.overlay').fadeOut();
	  }
	  event.stopPropagation();
	});

    $( '.header-search' ).click(function (event) {
        if (  $( ".search-popup" ).is( ":hidden" ) ) {
            $( ".main-nav" ).effect('slide', { direction: 'left', mode: 'hide' }, 500);
            $( ".cart-box" ).effect('slide', { direction: 'right', mode: 'hide' }, 500);
            $( ".submenu-product" ).slideUp();
            $( ".header-menu-btn" ).removeClass('active');
            $( ".search-popup" ).slideDown();
            $('.overlay').fadeIn(500);
	  } else {
          $( ".search-popup" ).slideUp();
          $('.overlay').fadeOut();
	  }
	  event.stopPropagation();
	});

    $( '.search-popup-close' ).click(function (event) {
        $( ".search-popup" ).slideUp();
        $('.overlay').fadeOut();
	    event.stopPropagation();
	});

    $( '.header-cart' ).click(function (event) {
        if (  $( ".cart-box" ).is( ":hidden" ) ) {
            $( ".main-nav" ).effect('slide', { direction: 'left', mode: 'hide' }, 500);
            $( ".submenu-product" ).slideUp();
            $( ".header-menu-btn" ).removeClass('active');
            $( ".search-popup" ).slideUp();
            $( ".cart-box" ).effect('slide', { direction: 'right', mode: 'show' }, 500);
            $('.overlay').fadeIn(500);
	  } else {
            $( ".cart-box" ).effect('slide', { direction: 'right', mode: 'hide' }, 500);
          $('.overlay').fadeOut();
	  }
	  event.stopPropagation();
	});

    $( '.overlay' ).click(function (event) {
        $( ".main-nav" ).effect('slide', { direction: 'left', mode: 'hide' }, 500);
        $( ".cart-box" ).effect('slide', { direction: 'right', mode: 'hide' }, 500);
        $( ".header-menu-btn" ).removeClass('active');
        $('.overlay').fadeOut();
        $( '.submenu' ).fadeOut();
        $( '.hassub' ).removeClass('active');
        $( ".submenu-product" ).fadeOut();
        $( ".search-popup" ).fadeOut();
	    event.stopPropagation();
	});

    var winH = $(window).height();
    $('.sticky-section').each(function() {
        var sectionH = $(this).height();
        if (sectionH > winH ) {
        var sectionNH = (winH - sectionH) - 150;
            $(this).css('top', sectionNH);
        }
    });
    
    $('html').click(function(){
        if (Modernizr.mq('(min-width: 992px)')) {
        }
    });

    $(function(){
        jQuery('img.svg').each(function(){
            var $img = jQuery(this);
            var imgID = $img.attr('id');
            var imgClass = $img.attr('class');
            var imgURL = $img.attr('src');

            jQuery.get(imgURL, function(data) {
                // Get the SVG tag, ignore the rest
                var $svg = jQuery(data).find('svg');

                // Add replaced image's ID to the new SVG
                if(typeof imgID !== 'undefined') {
                    $svg = $svg.attr('id', imgID);
                }
                // Add replaced image's classes to the new SVG
                if(typeof imgClass !== 'undefined') {
                    $svg = $svg.attr('class', imgClass+' replaced-svg');
                }

                // Remove any invalid XML tags as per http://validator.w3.org
                $svg = $svg.removeAttr('xmlns:a');

                // Check if the viewport is set, else we gonna set it if we can.
                if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                    $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
                }

                // Replace image with new SVG
                $img.replaceWith($svg);

            }, 'xml');

        });
    });

    if ($(this).scrollTop() > 150){ 
        $('.header-bg').addClass("sticky");
        $('.header-promotion').slideUp();
    } else{
        $('.header-bg').removeClass("sticky");
        $('.header-promotion').slideDown();
    }

    $(".qty-btn").on("click", function () {
        var $button = $(this);
        var oldValue = $button.siblings('.qty-input').val();
        

        if ($(this).hasClass('qty-plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }

        $button.siblings('.qty-input').val(newVal);

    });

});


    
$(window).on('load', function () {    

    wow = new WOW(
		  {
			animateClass: 'animated',
			offset: 100
		  }
		);
    wow.init();

});
    
$(window).scroll(function() {
    if ($(this).scrollTop() > 150){ 
        $('.header-bg').addClass("sticky");
        $('.header-promotion').slideUp();
    } else{
        $('.header-bg').removeClass("sticky");
        $('.header-promotion').slideDown();
    }
});

</script>

{{-- @if (session('register_success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'สมัครสมาชิกสำเร็จ!',
    text: 'ระบบได้สร้างบัญชีของคุณเรียบร้อยแล้ว',
    confirmButtonText: 'ตกลง'
});
</script>
@endif --}}
