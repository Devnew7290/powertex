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
                <table class="member-order-table">
                    <thead>
                        <tr>
                            <th scope="col">หมายเลขคำสั่งซื้อ</th>
                            <th scope="col">วันที่</th>
                            <th scope="col">สถานะการชำระเงิน</th>
                            <th scope="col">สถานะการจัดการ</th>
                            <th scope="col">ยอดรวม</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span>หมายเลขคำสั่งซื้อ</span><a href="{{ url('member/member-order-detail') }}">#PTX0123</a></td>
                            <td><span>วันที่</span>10 มีนาคม 2025</td>
                            <td><span>สถานะการชำระเงิน</span>ชำระเงินแล้ว</td>
                            <td><span>สถานะการจัดการ</span>อยู่ระหว่างดำเนินการ</td>
                            <td><span>ยอดรวม</span>฿ 3,190</td>
                        </tr>
                        <tr>
                            <td><span>หมายเลขคำสั่งซื้อ</span><a href="{{ url('member/member-order-detail') }}">#PTX0122</a></td>
                            <td><span>วันที่</span>7 มีนาคม 2025</td>
                            <td><span>สถานะการชำระเงิน</span>ชำระเงินแล้ว</td>
                            <td><span>สถานะการจัดการ</span>จัดส่งสำเร็จ</td>
                            <td><span>ยอดรวม</span>฿ 3,190</td>
                        </tr>
                        <tr>
                            <td><span>หมายเลขคำสั่งซื้อ</span><a href="{{ url('member/member-order-detail') }}">#PTX0121</a></td>
                            <td><span>วันที่</span>3 มีนาคม 2025</td>
                            <td><span>สถานะการชำระเงิน</span>ชำระเงินแล้ว</td>
                            <td><span>สถานะการจัดการ</span>จัดส่งสำเร็จ</td>
                            <td><span>ยอดรวม</span>฿ 3,190</td>
                        </tr>
                    </tbody>
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