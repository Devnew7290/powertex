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
                <h3>
                    ที่อยู่
                    <a href="{{ route('member.address.add') }}" class="btn btn-sm btn-primary float-end">+ เพิ่มที่อยู่</a>
                </h3>
                <div class="member-address">

                    @foreach($addresses as $addr)
                        <div class="member-address-list">
                        <h6>
                            {{-- {{ $addr->type ?? 'ที่อยู่' }} --}}
                            @if($addr->is_default) <span>(ที่อยู่หลัก)</span> @endif
                        </h6>
                        <p>ชื่อ : {{ $addr->firstname }} นามสกุล : {{ $addr->lastname }}</p>
                        <address>ที่อยู่ : {{ $addr->address }}, {{ $addr->postcode }}</address>
                        {{-- {{ $addr->sub_district }}, {{ $addr->district }}, {{ $addr->province }} --}}
                        <p>เบอร์โทร {{ $addr->phone }}</p>
                        <div class="member-address-edit">
                            <a href="{{ route('member.address.edit', $addr) }}" class="member-address-edit-btn">แก้ไข</a>
                            <form action="{{ route('member.address.destroy', $addr) }}" method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button class="member-address-edit-btn">ลบ</button>
                            </form>
                            @unless($addr->is_default)
                            <form action="{{ route('member.address.default', $addr) }}" method="POST" style="display:inline">
                            @csrf
                            <button class="member-address-edit-btn">ตั้งเป็นที่อยู่หลัก</button>
                            </form>
                            @endunless
                        </div>
                        </div>
                    @endforeach

                    {{-- Uncomment below if you want to show static addresses
                    {{-- <div class="member-address-list">
                        <h6>ออฟฟิศ<span>(ที่อยู่หลัก)</span></h6>
                        <address>
                            32/1 Charansanitwong Road, Bang Aor,  Bang Plad, Bangkok 10700
                        </address>
                        <p>เบอร์ติดต่อ 081-591-0000</p>
                        <div class="member-address-edit">
                            <a href="{{ url('member-address-edit') }}" class="member-address-edit-btn">แก้ไข</a>
                            <button class="member-address-edit-btn member-address-edit-btn-del">ลบที่อยู่</button>
                        </div>
                    </div>
                    <div class="member-address-list">
                        <h6>บ้าน</h6>
                        <address>
                            1232/1 Charansanitwong Road, Bang Aor,  Bang Plad, Bangkok 10700
                        </address>
                        <p>เบอร์ติดต่อ 081-591-0000</p>
                        <div class="member-address-edit">
                            <a href="{{ url('member-address-edit') }}" class="member-address-edit-btn">แก้ไข</a>
                            <button class="member-address-edit-btn member-address-edit-btn-del">ลบที่อยู่</button>
                            <button class="member-address-edit-btn">ตั้งเป็นที่อยู่หลัก</button>
                        </div>
                    </div> --}}
                </div>
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