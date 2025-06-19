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
  <section class="container-fluid section-inside login-bg">
    <div class="container register-container">
        <div class="row">
            <div class="col-12 head-fp head-fp-center">
            <h2 class="wow fadeInDown">สมัครสมาชิก</h2>
            </div>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form class="row login-margin" method="POST" action="{{ route('member.register') }}">
            @csrf

            <div class="col-12">
                <div class="login-form">
                    <label>อีเมล</label>
                    <input type="email" name="email" required value="{{ old('email') }}">
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="login-form">
                    <label>ชื่อ</label>
                    <input type="text" name="name" required value="{{ old('name') }}">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="login-form">
                    <label>นามสกุล</label>
                    <input type="text" name="surname" required value="{{ old('surname') }}">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="login-form">
                    <label>วันเกิด</label>
                    <input type="date" name="birthday" required value="{{ old('birthdate') }}">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="login-form">
                    <label>เบอร์โทรศัพท์</label>
                    <input type="text" name="phone" required value="{{ old('phone') }}">
                </div>
            </div>
            <div class="col-12">
                <div class="login-form">
                    <label>ที่อยู่</label>
                    <textarea rows="1" name="address">{{ old('address') }}</textarea>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="login-form">
                    <label>จังหวัด</label>
                    <select id="province" name="province" required>
                        <option value="">-- เลือกจังหวัด --</option>
                        @foreach(\App\Models\Provinces::orderBy('name_th')->get() as $province)
                            <option value="{{ $province->id }}">{{ $province->name_th }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="col-12 col-md-6">
                <div class="login-form">
                    <label>เขต/อำเภอ</label>
                    <select id="amphure" name="district">
                        <option value="">-- เลือกอำเภอ --</option>
                    </select>
                </div>
            </div>
            
            <div class="col-12 col-md-6">
                <div class="login-form">
                    <label>แขวง/ตำบล</label>
                    <select id="district" name="sub_district">
                        <option value="">-- เลือกตำบล --</option>
                    </select>
                </div>
            </div>
            
            <div class="col-12 col-md-6">
                <div class="login-form">
                    <label>รหัสไปรษณีย์</label>
                    <input type="text" name="postcode" id="zipcode" readonly>
                </div>
            </div>
            
            <div class="col-12 col-md-6">
                <div class="login-form">
                    <label>ตั้งรหัสผ่าน</label>
                    <input type="password" name="password" required">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="login-form">
                    <label>ยืนยันรหัสผ่าน</label>
                    <input type="password" name="password_confirmation" required>
                </div>
            </div>
            
            <div class="col-12 offset-md-3 col-md-6 offset-lg-3 col-lg-6">
                <br>
                <button type="submit" class="login-btn">ยืนยันสมัครสมาชิก</button>
        
                <div class="login-form-register">
                    หากท่านมีบัญชีอยู่แล้ว กรุณา <a href="{{ route('member.login') }}">เข้าสู่ระบบ</a>
                </div>
        
                {{-- <div class="login-form-or">หรือ</div>
        
                <a href="{{ url('register/google') }}" class="login-btn login-btn-google">สมัครผ่าน Google</a>
                <a href="{{ url('register/facebook') }}" class="login-btn login-btn-facebook">สมัครผ่าน Facebook</a> --}}
            </div>
        </form>
    </div>
  </section>

  <?php // require('inc_footer.php'); ?>
  @include('frontend.inc_footer')

<script>
    $(document).ready(function () {
        $('form').on('submit', function (e) {
            const password = $('input[name="password"]').val();
            const confirm = $('input[name="password_confirmation"]').val();

            if (password !== confirm) {
                e.preventDefault(); // ยกเลิก submit
                Swal.fire({
                    icon: 'error',
                    title: 'รหัสผ่านไม่ตรงกัน',
                    text: 'กรุณากรอกรหัสผ่านและยืนยันรหัสผ่านให้ตรงกัน',
                });
            }
        });
    });
</script>

<script>
    $(function () {
        $('#province').change(function () {
            let provinceID = $(this).val();
            $('#amphure').html('<option value="">-- กำลังโหลด --</option>');
            $('#district').html('<option value="">-- เลือกตำบล --</option>');
            $('#zipcode').val('');
    
            if (provinceID) {
                $.get('/ajax/amphures/' + provinceID, function (data) {
                    let html = '<option value="">-- เลือกอำเภอ --</option>';
                    data.forEach(function (a) {
                        html += `<option value="${a.id}">${a.name_th}</option>`;
                    });
                    $('#amphure').html(html);
                });
            }
        });
    
        $('#amphure').change(function () {
            let amphureID = $(this).val();
            $('#district').html('<option value="">-- กำลังโหลด --</option>');
            $('#zipcode').val('');
    
            if (amphureID) {
                $.get('/ajax/districts/' + amphureID, function (data) {
                    let html = '<option value="">-- เลือกตำบล --</option>';
                    data.forEach(function (d) {
                        html += `<option value="${d.id}">${d.name_th}</option>`;
                    });
                    $('#district').html(html);
                });
            }
        });
    
        $('#district').change(function () {
            let districtID = $(this).val();
            if (districtID) {
                $.get('/ajax/zipcode/' + districtID, function (data) {
                    $('#zipcode').val(data.zip_code);
                });
            }
        });
    });
</script>
    
</body>
</html>