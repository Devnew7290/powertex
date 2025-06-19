<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">เข้าสู่ระบบ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="ปิด"></button>
      </div>
      <div class="modal-body">
        <form id="modalLoginForm" method="POST" action="{{ route('member.login') }}">
            @csrf
            <div class="mb-3">
                <label>อีเมล</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label>รหัสผ่าน</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" name="remember" id="rememberLogin">
                <label class="form-check-label" for="rememberLogin">จดจำการเข้าสู่ระบบ</label>
            </div>
            <button type="submit" class="btn btn-primary w-100">เข้าสู่ระบบ</button>
            <div class="mt-3 text-center">
                หากท่านยังไม่มีบัญชีกรุณา <a href="{{ route('member.register') }}">สมัครสมาชิก</a>
            </div>
        </form>
        <div class="alert alert-danger d-none mt-3" id="loginError"></div>
      </div>
    </div>
  </div>
</div>
