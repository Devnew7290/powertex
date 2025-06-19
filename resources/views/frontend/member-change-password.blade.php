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
                <h3>ที่อยู่</h3>
                <div class="member-address">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="login-form">
                                <label>รหัสผ่านเดิม</label>
                                <input type="password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="login-form">
                                <label>รหัสผ่านใหม่</label>
                                <input type="password">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="login-form">
                                <label>ยืนยันรหัสผ่านใหม่</label>
                                <input type="password">
                            </div>
                        </div>
                        <div class="col-12 member-address-btn-wrap">
                            <button class="login-btn member-address-btn-cancel">ยกเลิก</button><button class="login-btn member-address-btn-edit">เปลี่ยนรหัสผ่าน</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>

  <?php // require('inc_footer.php'); ?>
  @include('frontend.inc_footer')

<script>
$(document).ready(function(){
    $('.member-sidebar-btn').eq(2).addClass('active');
});    
</script>
</body>
</html>