@extends('backend.layouts.master')

@section('title_name', 'Responsive Bootstrap 4 Admin Dashboard Template')

@section('styles_link')
<?php
    $activePage = "users";
    $active = "";
    $i=1;
?>
@endsection

@section('content')
<div class="container">
    <h1>จัดการผู้ใช้ (User Management)</h1>
    <a href="{{ route('backend.users.create') }}" class="btn btn-primary mb-3">+ เพิ่มผู้ใช้</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>ชื่อ</th>
                <th>Email</th>
                <th>Role</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $i => $user)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach($user->getRoleNames() as $role)
                            <span class="badge bg-info">{{ $role }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('backend.users.edit', $user) }}" class="btn btn-sm btn-warning">แก้ไข</a>
                        <form action="{{ route('backend.users.destroy', $user) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('ยืนยันการลบ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">ลบ</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
