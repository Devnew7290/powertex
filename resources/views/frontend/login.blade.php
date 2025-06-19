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
    <div class="container login-container">
        <div class="row">
            <div class="col-12 head-fp head-fp-center">
            <h2 class="wow fadeInDown">เข้าสู่ระบบ</h2>
            </div>
        </div>
        <div class="row">
            <form class="col-12 login-margin" method="POST" action="{{ route('member.login') }}">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <div class="login-form">
                    <label>อีเมล</label>
                    <input type="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="login-form">
                    <label>รหัสผ่าน</label>
                    <input type="password" name="password" required>
                </div>

                <div class="login-checkbox">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <div class="login-checkbox-icon"><i class="bi bi-check"></i>จดจำการเข้าสู่ระบบ</div>
                    </label>
                </div>
                <input type="hidden" name="redirect" value="{{ request('redirect', url()->previous()) }}">

                <button type="submit" class="login-btn">เข้าสู่ระบบ</button>

                <div class="login-form-register">
                    หากท่านยังไม่มีบัญชีกรุณา <a href="{{ route('member.register') }}">สมัครสมาชิก</a>
                </div>

                {{-- <div class="login-form-or">หรือ</div>

                <a href="{{ url('login/google') }}" class="login-btn login-btn-google">เข้าสู่ระบบผ่าน Google</a>
                <a href="{{ url('login/facebook') }}" class="login-btn login-btn-facebook">เข้าสู่ระบบผ่าน Facebook</a> --}}
            </form>
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