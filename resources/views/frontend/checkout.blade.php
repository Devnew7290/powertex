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
  <section class="container-fluid overflow-hidden">
    <div class="container">
        <form method="POST" action="{{ route('order.store') }}">
        @csrf
            <div class="row">
                
                <div class="col-12 col-lg-7 section-inside checkout-left wow fadeInLeft">
                    <div class="head-fp">
                        <h2 class="wow fadeInDown">CHECK OUT</h2>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 checkout-address-head"><h6>ที่อยู่จัดส่ง</h6></div>
                        <div class="col-12 col-md-6">
                            <div class="login-form">
                                <label>ชื่อ</label>
                                <input type="text" name="shipping_firstname" value="{{ $member->name ?? '' }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="login-form">
                                <label>นามสกุล</label>
                                <input type="text" name="shipping_lastname" value="{{ $member->surname ?? '' }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="login-form">
                                <label>ที่อยู่</label>
                                <textarea name="shipping_address" rows="5">{{ $member->address ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="login-form">
                                <label>จังหวัด</label>
                                <select name="shipping_province" id="province-select">
                                    <option value="">เลือกจังหวัด</option>
                                    @foreach($provinces as $prov)
                                        <option value="{{ $prov->id }}"
                                            {{ (isset($member->province) && $member->province == $prov->id) ? 'selected' : '' }}>
                                            {{ $prov->name_th }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="login-form">
                                <label>เขต/อำเภอ</label>
                                <select name="shipping_district" id="amphure-select">
                                    <option value="">เลือกเขต/อำเภอ</option>
                                    @foreach($amphures as $amp)
                                        <option value="{{ $amp->id }}"
                                            {{ (isset($member->district) && $member->district == $amp->id) ? 'selected' : '' }}>
                                            {{ $amp->name_th }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="login-form">
                                <label>แขวง/ตำบล</label>
                                <select name="shipping_sub_district" id="district-select">
                                    <option value="">เลือกแขวง/ตำบล</option>
                                    @foreach($districts as $dist)
                                        <option value="{{ $dist->id }}"
                                            {{ (isset($member->sub_district) && $member->sub_district == $dist->id) ? 'selected' : '' }}>
                                            {{ $dist->name_th }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="login-form">
                                <label>รหัสไปรษณีย์</label>
                                <input type="text" name="shipping_postcode" value="{{ $member->postcode ?? '' }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="login-form">
                                <label>เบอร์ติดต่อ</label>
                                <input type="text" name="shipping_phone" value="{{ $member->phone ?? '' }}">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12 checkout-address-head">
                            <h6>ที่อยู่สำหรับออกใบกำกับภาษี</h6>
                            <div class="login-checkbox">
                                <label>
                                    <input type="checkbox" id="copy-address-checkbox">
                                    <div class="login-checkbox-icon">
                                        <i class="bi bi-check"></i>ใช้ที่อยู่เดียวกันกับที่อยู่จัดส่ง
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="login-form">
                                <label>ออกในนาม</label>
                                <select name="invoice_type">
                                    <option value="บุคคล">บุคคล</option>
                                    <option value="บริษัท">บริษัท</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="login-form">
                                <label>เลขประจำตัวผู้เสียภาษี</label>
                                <input type="text" name="invoice_tax_number">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="login-form">
                                <label>ชื่อ</label>
                                <input type="text" name="invoice_firstname">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="login-form">
                                <label>นามสกุล</label>
                                <input type="text" name="invoice_lastname">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="login-form">
                                <label>ที่อยู่</label>
                                <textarea rows="2" name="invoice_address"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="login-form">
                                <label>จังหวัด</label>
                                <select name="invoice_province" id="invoice_province">
                                    <option value="">เลือกจังหวัด</option>
                                    @php $new_provinces = \App\Models\Provinces::all(); @endphp
                                    @foreach($new_provinces as $prov)
                                        <option value="{{ $prov->id }}">
                                            {{ $prov->name_th }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="login-form">
                                <label>เขต/อำเภอ</label>
                                <select name="invoice_district" id="invoice_district">
                                    <option value="">เลือกเขต/อำเภอ</option>
                                    @php $new_amphures = \App\Models\Amphures::all(); @endphp
                                    @foreach($new_amphures as $amp)
                                        <option value="{{ $amp->id }}">
                                            {{ $amp->name_th }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="login-form">
                                <label>แขวง/ตำบล</label>
                                <select name="invoice_sub_district" id="invoice_sub_district">
                                    <option value="">เลือกแขวง/ตำบล</option>
                                    @php $new_districts = \App\Models\Districts::all(); @endphp
                                    @foreach($new_districts as $dist)
                                        <option value="{{ $dist->id }}">
                                            {{ $dist->name_th }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="login-form">
                                <label>รหัสไปรษณีย์</label>
                                <input type="text" name="invoice_postcode">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="login-form">
                                <label>เบอร์ติดต่อ</label>
                                <input type="text" name="invoice_phone">
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-12 col-lg-5 checkout-right wow fadeInRight">
                    @php
                        $subtotal = 0;
                        $cartCount = 0;
                    @endphp
                    @forelse($cart as $pid => $qty)
                        @php
                            $p = $products[$pid] ?? null;
                            if (!$p) continue;
                            $price = $p->products_price_promotion ?: $p->products_price_full;
                            $price_full = $p->products_price_full;
                            $price_total = $price * $qty;
                            $subtotal += $price_total;
                            $cartCount += $qty;
                            $urlProduct = $p->products_url ?: preg_replace('/[^a-zA-Z0-9ก-๙\s]/u', '', $p->products_code);
                        @endphp
                        <figure class="cart-item">
                            <div class="cart-img"><img src="{{ $p->image_url }}" alt=""></div>
                            <figcaption>
                                <h3>{{ $p->products_name }}</h3>
                                <p>รหัสสินค้า {{ $p->products_code }}</p>
                                <div class="cart-qty">
                                    <div class="checkout-qty">x {{ $qty }}</div>
                                    <div class="product-price {{ $p->products_price_promotion ? 'product-price-sale' : '' }}">
                                        @if($p->products_price_promotion)
                                            <span>฿ {{ number_format($price_full) }}</span>
                                            <div>฿ {{ number_format($price) }}</div>
                                        @else
                                            <div>฿ {{ number_format($price) }}</div>
                                        @endif
                                    </div>
                                </div>
                            </figcaption>
                        </figure>
                    @empty
                        <div class="text-center py-4">ยังไม่มีสินค้าในตะกร้า</div>
                    @endforelse

                    <div class="cart-price-box">
                        <div class="cart-price-box-subtotal">
                            <h6>Subtotal - {{ $cartCount }} items</h6>
                            <div class="cart-price-box-subtotal-number">฿ {{ number_format($subtotal) }}</div>
                        </div>
                        <div class="cart-price-box-total">
                            <h6>Total</h6>
                            <div class="cart-price-box-total-number">฿ {{ number_format($subtotal) }}</div>
                            <input type="hidden" name="total_amount" value="{{ $subtotal }}">
                            <input type="hidden" name="cart_count" value="{{ $cartCount }}">
                            <input type="hidden" name="cart_items" value="{{ json_encode($cart) }}">
                            <input type="hidden" name="cart_products" value="{{ json_encode($products) }}">
                        </div>
                        <button type="submit" class="cart-submit-button" {{ $cartCount == 0 ? 'disabled' : '' }}>ดำเนินการชำระเงิน</button>
                    </div>
                </div>
                
            </div>
        </form>
    </div>
  </section>

  <?php // require('inc_footer.php'); ?>
  @include('frontend.inc_footer')

<script>
       $(function() {
        // province change
        $('#province-select').on('change', function() {
            let pid = $(this).val();
            $('#amphure-select').html('<option value="">รอโหลด...</option>');
            $('#district-select').html('<option value="">เลือกแขวง/ตำบล</option>');
            if (pid) {
                $.get('/ajax/amphures/' + pid, function(data) {
                    let html = '<option value="">เลือกเขต/อำเภอ</option>';
                    $.each(data, function(i, row){
                        html += '<option value="'+row.id+'">'+row.name_th+'</option>';
                    });
                    $('#amphure-select').html(html);
                });
            } else {
                $('#amphure-select').html('<option value="">เลือกเขต/อำเภอ</option>');
            }
        });

        // amphure change
        $('#amphure-select').on('change', function() {
            let aid = $(this).val();
            $('#district-select').html('<option value="">รอโหลด...</option>');
            if (aid) {
                $.get('/ajax/districts/' + aid, function(data) {
                    let html = '<option value="">เลือกแขวง/ตำบล</option>';
                    $.each(data, function(i, row){
                        html += '<option value="'+row.id+'">'+row.name_th+'</option>';
                    });
                    $('#district-select').html(html);
                });
            } else {
                $('#district-select').html('<option value="">เลือกแขวง/ตำบล</option>');
            }
        });

        // district change
        $('#district-select').on('change', function() {
            let aid = $(this).val();
            $.get('/ajax/zipcode/' + aid, function(data) {
                $('input[name="postcode"]').val(data.zip_code);
            });            
        });


    });

</script>

<script>
    $(function(){
        $('#copy-address-checkbox').on('change', function() {
            if ($(this).is(':checked')) {
                // Copy values จากที่อยู่จัดส่ง

                console.log($('#province-select').val());
                console.log($('#amphure-select').val());
                console.log($('#district-select').val());

                $('input[name="invoice_firstname"]').val($('input[name="shipping_firstname"]').val());
                $('input[name="invoice_lastname"]').val($('input[name="shipping_lastname"]').val());
                $('textarea[name="invoice_address"]').val($('textarea[name="shipping_address"]').val());
                $('select[name="invoice_province"]').val($('#province-select').val()).trigger('change');
                setTimeout(function() {
                    $('select[name="invoice_district"]').val($('#amphure-select').val()).trigger('change');
                    setTimeout(function(){
                        $('select[name="invoice_sub_district"]').val($('#district-select').val()).trigger('change');
                    }, 200);
                }, 200);
                $('input[name="invoice_postcode"]').val($('input[name="shipping_postcode"]').val());
                $('input[name="invoice_phone"]').val($('input[name="shipping_phone"]').val());
            }
        });
    });

</script>
</body>
</html>