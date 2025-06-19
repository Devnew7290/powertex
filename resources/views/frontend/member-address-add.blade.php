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
                <form action="{{ isset($address) ? route('member.address.update', $address) : route('member.address.store') }}" method="POST">
                @csrf
                @isset($address) @method('PUT') @endisset
                <div class="member-address">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="login-form">
                                <label>ชื่อ</label>
                                <input name="firstname" value="{{ old('firstname', $address->firstname ?? '') }}" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="login-form">
                                <label>นามสกุล</label>
                                <input name="lastname" value="{{ old('lastname', $address->lastname ?? '') }}" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="login-form">
                                <label>ที่อยู่</label>
                                <textarea name="address" required>{{ old('address', $address->address ?? '') }}</textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="login-form">
                                <label>จังหวัด</label>
                                <select name="province" ><!-- options… --></select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="login-form">
                                <label>เขต/อำเภอ</label>
                                <select name="district" ></select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="login-form">
                                <label>แขวง/ตำบล</label>
                                <select name="sub_district" ></select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="login-form">
                                <label>รหัสไปรษณีย์</label>
                                <input name="postcode" value="{{ old('postcode', $address->postcode ?? '') }}" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="login-form">
                                <label>เบอร์ติดต่อ</label>
                                <input name="phone" value="{{ old('phone', $address->phone ?? '') }}" required>
                            </div>
                        </div>
                        <div class="col-12 member-address-btn-wrap">
                            <button class="login-btn member-address-btn-cancel" onclick="history.back()">ยกเลิก</button>
                            <button class="login-btn member-address-btn-edit"type="submit">{{ isset($address) ? 'บันทึก' : 'เพิ่มที่อยู่' }}</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
  </section>

  <?php // require('inc_footer.php'); ?>
  @include('frontend.inc_footer')

<script>
$(document).ready(function(){
    $('.member-sidebar-btn').eq(0).addClass('active');
});    
</script>
</body>
</html>