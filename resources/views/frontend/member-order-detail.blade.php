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
        <?php // require('inc_member_menu.php'); ?>
        @include('frontend.inc_member_menu')
        <div class="col-12 col-lg-9">
            <div class="member-order-box">
                <h3>คำสั่งซื้อ</h3>
                <table class="member-order-table member-order-table-detail">
                    <thead>
                        <tr>
                            <th scope="col">สินค้า</th>
                            <th scope="col">ราคา</th>
                            <th scope="col">จำนวน</th>
                            <th scope="col">ยอดรวม</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                            <td>
                                <div class="member-order-detail">
                                <img src="{{ asset($item->product->image_url ?? 'images/default.png') }}" alt="">
                                <h6>{{ $item->product_name }}</h6>
                                </div>
                            </td>
                            <td><span>ราคา</span>฿ {{ number_format($item->price, 2) }}</td>
                            <td><span>จำนวน</span>{{ $item->quantity }}</td>
                            <td><span>ยอดรวม</span>฿ {{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="3">ยอดรวม</td>
                            <td>฿ {{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity), 2) }}</td>
                        </tr>
                    </tfoot>


                    {{-- <tbody>
                        <tr>
                            <td>
                                <div class="member-order-detail">
                                    <img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt="">
                                    <h6>ไขควงกระแทกไร้สาย รุ่น PPT-CL-ID-140</h6>
                                </div>
                            </td>
                            <td><span>ราคา</span>฿ 3,190</td>
                            <td><span>จำนวน</span>1</td>
                            <td><span>ยอดรวม</span>฿ 3,190</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="member-order-detail">
                                    <img src="{{asset('images/th-11134207-7r98s-lz5m439l87mx17.webp')}}" alt="">
                                    <h6>ไขควงกระแทกไร้สาย รุ่น PPT-CL-ID-140</h6>
                                </div>
                            </td>
                            <td><span>ราคา</span>฿ 3,190</td>
                            <td><span>จำนวน</span>1</td>
                            <td><span>ยอดรวม</span>฿ 3,190</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">ยอดรวม</td>
                            <td>฿ 6,380</td>
                        </tr>
                    </tfoot> --}}
                </table>
            </div>
        </div>
    </div>
  </section>

  <?php // require('inc_footer.php'); ?>
  @include('frontend.inc_footer')

<script>
$(document).ready(function(){
    $('.member-sidebar-btn').eq(1).addClass('active');
});    
</script>
</body>
</html>