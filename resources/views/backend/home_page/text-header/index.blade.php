@extends('backend.layouts.master')

@section('title_name', 'Responsive Bootstrap 4 Admin Dashboard Template')

@section('styles_link')
<?php
    $activePage = "home_page";
    $active = "text_header";
    $i=1;
?>
@endsection

@section('content')
<!-- BEGIN: Content -->
<div class="content">
    <div class="flex items-center mt-8">

    </div>
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box py-10 sm:py-20 mt-5">

        <div class="px-5 mt-10">
            <div class="font-medium text-center text-lg">ข้อความ</div>

        </div>

        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    ข้อมูลข้อความ
                </h2>
                <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                    <!-- <a href="{{ url ('/backend/home/text-header/form')}}">
                        <button class="btn btn-elevated-primary w-24 mr-1 mb-2">เพิ่มข้อมูล</button>
                    </a> -->
                </div>
            </div>

            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th style="width:50%">
                            <center>ข้อความ</center>
                        </th>
                        <th>
                            <center>ลิ้งก์</center>
                        </th>
                        <th>
                            <center>สถานะ</center>
                        </th>
                        <th>
                            <center>ตั้งค่า</center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($textheader as $rs)
                        <tr>
                            <td><center>{!!$rs->texth_text!!}</center></td>
                            <td><center>
                                @if($rs->texth_link)
                                    <a href="{{$rs->texth_link}}" target="_blank">ดูลิ้งก์</a>
                                @else
                                    ไม่มีลิ้งก์
                                @endif
                            </center></td>
                            <td><center>
                                <div class="form-check form-switch" style="display: flex; justify-content: center;">
                                    <input id="" name="" class="form-check-input" type="checkbox"
                                        onclick="change_status({{ $rs->texth_id }})" @if($rs->texth_status == 'show') checked @endif>
                                </div>
                            </center></td>
                            <td><center>
                                <a href="{{ url('/backend/home/text-header/edit/'.$rs->texth_id) }}"> <button type="button" class="btn btn-warning">แก้ไข</button></a>
                            </center></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    <!-- END: Wizard Layout -->
</div>
<!-- END: Content -->
@endsection
@section('javascripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> <!-- delete -->


<script>
    $(document).ready(function () {
        $('#example').DataTable({
            responsive: true
        });
    });

    function change_status(id) {
        $.ajax({
            type: "POST",
            url: "{!! url('/backend/home/text-header/change/') !!}/" + id,
            data: {
                _token: "{{ csrf_token() }}" // จำเป็นต้องใช้ CSRF token
            },
            success: function (data) {
                console.log(data);
                location.reload();
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    }
</script>
@endsection
