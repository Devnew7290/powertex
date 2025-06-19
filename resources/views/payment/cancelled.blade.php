<!DOCTYPE html>
<html>
<head>
    <title>Payment Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container py-5">
    <div class="alert alert-warning">
        <h2>ยกเลิกรายการชำระเงิน</h2>
        <p>คุณได้ยกเลิกการชำระเงิน</p>
        <pre>{{ print_r($data, true) }}</pre>
    </div>
    <a href="{{ url('/') }}" class="btn btn-warning">กลับหน้าหลัก</a>
</div>
</body>
</html>


{{-- @section('content')
<div class="container py-5">
    <div class="alert alert-warning">
        <h2>ยกเลิกรายการชำระเงิน</h2>
        <p>คุณได้ยกเลิกการชำระเงิน</p>
        <pre>{{ print_r($data, true) }}</pre>
    </div>
    <a href="{{ url('/') }}" class="btn btn-warning">กลับหน้าหลัก</a>
</div>
@endsection --}}
