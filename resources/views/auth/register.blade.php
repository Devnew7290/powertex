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
        <form class="row login-margin">
            <div class="col-12">
                <div class="login-form">
                    <label>อีเมล</label>
                    <input type="text">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="login-form">
                    <label>ชื่อ</label>
                    <input type="text">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="login-form">
                    <label>นามสกุล</label>
                    <input type="text">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="login-form">
                    <label>วันเกิด</label>
                    <input type="date">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="login-form">
                    <label>เบอร์โทรศัพท์</label>
                    <input type="text">
                </div>
            </div>
            <div class="col-12">
                <div class="login-form">
                    <label>ที่อยู่</label>
                    <textarea rows="1"></textarea>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="login-form">
                    <label>จังหวัด</label>
                    <select></select>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="login-form">
                    <label>เขต/อำเภอ</label>
                    <select></select>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="login-form">
                    <label>แขวง/ตำบล</label>
                    <select></select>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="login-form">
                    <label>รหัสไปรษณีย์</label>
                    <input type="text">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="login-form">
                    <label>ตั้งรหัสผ่าน</label>
                    <input type="password">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="login-form">
                    <label>ยืนยันรหัสผ่าน</label>
                    <input type="password">
                </div>
            </div>
            <div class="col-12 offset-md-3 col-md-6 offset-lg-3 col-lg-6">
                <button class="login-btn">ยืนยันสมัครสมาชิก</button>
                <div class="login-form-register">
                    หากท่านยังไม่มีบัญชีกรุณา <a href="login.php">สมัครสมาชิก</a>
                </div>
                <div class="login-form-or">หรือ</div>
                <button class="login-btn login-btn-google">
                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M27.5068 12.9545C23.4231 12.9525 19.3394 12.9535 15.2557 12.954C15.2563 14.6478 15.2537 16.3416 15.2567 18.0348C17.6217 18.0343 19.9867 18.0338 22.3512 18.0348C22.0772 19.6579 21.1126 21.1422 19.7447 22.056C18.8848 22.6341 17.8968 23.0094 16.8783 23.1878C15.8532 23.3628 14.794 23.3852 13.7714 23.1782C12.7316 22.9707 11.739 22.5375 10.8731 21.9267C9.48846 20.954 8.43178 19.5308 7.88923 17.929C7.33445 16.2998 7.33038 14.487 7.89177 12.8593C8.28128 11.7122 8.92961 10.6525 9.7813 9.7901C10.8318 8.71463 12.1977 7.94581 13.6692 7.63054C14.9292 7.36156 16.2579 7.41289 17.4916 7.78611C18.5401 8.10445 19.5067 8.67902 20.2984 9.43514C21.0988 8.63933 21.8951 7.83897 22.694 7.04168C23.113 6.61253 23.5533 6.20217 23.9591 5.76132C22.7458 4.63855 21.3236 3.73601 19.7696 3.16547C16.9719 2.13582 13.8167 2.11397 11.0002 3.08879C7.82615 4.17543 5.12351 6.54904 3.62502 9.54917C3.10332 10.5829 2.72243 11.6864 2.49362 12.8213C1.918 15.649 2.31921 18.6639 3.62349 21.2394C4.47115 22.9204 5.68643 24.4149 7.16057 25.5864C8.55131 26.6955 10.1723 27.5146 11.8911 27.9718C14.0598 28.5535 16.3683 28.5403 18.5513 28.0435C20.5242 27.5894 22.3909 26.6467 23.8813 25.2707C25.4566 23.823 26.5803 21.9156 27.1753 19.8659C27.8241 17.6301 27.9136 15.2432 27.5068 12.9545Z" fill="white"/>
                    </svg>
                    เข้าสู่ระบบผ่าน Google
                </button>
                <button class="login-btn login-btn-facebook">
                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.875 11.25V9.01758C16.875 8.00977 17.0977 7.5 18.6621 7.5H20.625V3.75H17.3496C13.3359 3.75 12.0117 5.58984 12.0117 8.74805V11.25H9.375V15H12.0117V26.25H16.875V15H20.1797L20.625 11.25H16.875Z" fill="white"/>
                    </svg>
                    เข้าสู่ระบบผ่าน Facebook
                </button>
            </div>
        </form>
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