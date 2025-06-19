<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

    @extends('backend.layouts.master')
    <?php
        $activePage = "users";
        $active = "";
    ?>
    @section('title_name', 'Responsive Bootstrap 4 Admin Dashboard Template')
</head>


<body>
    @section('content')
    <div class="container">
        <h1>แก้ไขผู้ใช้</h1>
        <a href="{{ route('backend.users.index') }}" class="btn btn-secondary mb-3">← กลับ</a>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('backend.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>ชื่อ</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>
            <div class="mb-3">
                <label>เปลี่ยน Password <span class="text-muted">(ถ้าไม่เปลี่ยน ปล่อยว่าง)</span></label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="mb-3">
                <label>ยืนยัน Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
            <div class="mb-3">
                <label>สิทธิ์ (Role)</label>
                <select name="role" class="form-control" required>
                    <option value="">--เลือกสิทธิ์--</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>เลือกเมนูที่ user เห็น</label>
                <div class="row">
                    @foreach($allMenus as $key => $label)
                    <div class="col-md-3">
                        <input type="checkbox" name="menus[]" value="{{ $key }}"
                            {{ (isset($user) && is_array($user->menus) && in_array($key, $user->menus)) || (old('menus') && in_array($key, old('menus', []))) ? 'checked' : '' }}>
                        <label>{{ $label }}</label>
                    </div>
                    @endforeach
                </div>
            </div>
            <button class="btn btn-primary">อัปเดต</button>
        </form>
    </div>
    @endsection

    @section('javascripts')
    <script>
        
    </script>
    @endsection
</body>

</html>
