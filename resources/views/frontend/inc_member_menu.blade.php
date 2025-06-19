<div class="col-12 col-lg-3 member-sidebar-box">
    <h4>บัญชีผู้ใช้</h4>
    @if(Auth::guard('member')->check())
    <p>{{ Auth::guard('member')->user()->name }} {{ Auth::guard('member')->user()->surname }}</p>
    @else
        <p>Guest</p> {{-- หรือไม่แสดงเลยก็ได้ --}}
    @endif
    <ul class="member-sidebar">
        <li><a class="member-sidebar-btn" href="{{ url('member/member-address') }}">ที่อยู่</a></li>
        <li><a class="member-sidebar-btn" href="{{ url('member/member-order') }}">คำสั่งซื้อ</a></li>
        <li><a class="member-sidebar-btn" href="{{ url('member/member-change-password') }}">เปลี่ยนรหัสผ่าน</a></li>
        <li>
            <form id="logout-form" action="{{ route('member.logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="member-sidebar-btn" style="background:none;border:none;padding:0;color:#000;text-align:left;">
                    ออกจากระบบ
                </button>
            </form>
        </li>
        {{-- <li><a class="member-sidebar-btn" href="{{ url('/') }}">ออกจากระบบ</a></li> --}}
    </ul>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('logout-form');
        const btn = form.querySelector('button');
    
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'ยืนยันการออกจากระบบ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'ออกจากระบบ',
                cancelButtonText: 'ยกเลิก',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
    </script>
   