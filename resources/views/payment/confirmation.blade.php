<!DOCTYPE html>
<html>
<head>
    <title>Payment Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container py-5">
    <div class="alert alert-success">
        <h2>ชำระเงินสำเร็จ!</h2>
        <p>ขอบคุณสำหรับการสั่งซื้อของคุณ</p>
        <pre>{{ print_r($data, true) }}</pre>
    </div>
    <a href="{{ url('/') }}" class="btn btn-primary">กลับหน้าหลัก</a>
</div>
</body>
</html>

{{-- @section('content')
<div class="container py-5">
    <div class="alert alert-success">
        <h2>ชำระเงินสำเร็จ!</h2>
        <p>ขอบคุณสำหรับการสั่งซื้อของคุณ</p>
        <pre>{{ print_r($data, true) }}</pre>
    </div>
    <a href="{{ url('/') }}" class="btn btn-primary">กลับหน้าหลัก</a>
</div>
@endsection --}}

