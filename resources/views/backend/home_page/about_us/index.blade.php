@extends('backend.layouts.master')

@section('title_name', 'Responsive Bootstrap 4 Admin Dashboard Template')

@section('styles_link')
<?php
    $activePage = "home_page";
    $active = "home_page_powertex";
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
            <div class="font-medium text-center text-lg">พาวเวอร์เท็กซ์</div>

        </div>

        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    ข้อมูลพาวเวอร์เท็กซ์
                </h2>
                <!-- <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                    <a href="{{ url ('/backend/home/powertex/form')}}">
                        <button class="btn btn-elevated-primary w-24 mr-1 mb-2">เพิ่มข้อมูล</button>
                    </a>
                </div> -->
            </div>

            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>
                            <center>หัวข้อ</center>
                        </th>
                        <th>
                            <center>เนื้อหา</center>
                        </th>
                        <th>
                            <center>รูปภาพด้านหน้า</center>
                        </th>
                        <th>
                            <center>รูปภาพด้านหน้า</center>
                        </th>
                        <th>
                            <center>ตั้งค่า</center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($aboutUs as $rs)
                        <tr>
                            <td><center>{{$rs->about_us_topic}}</center></td>
                            <td><center>{!! $rs->about_us_detail !!}</center></td>
                            <td><center><img src="{{asset($rs->about_us_image_front)}}" alt="" style="width: 100px;"></center></td>
                            <td><center><img src="{{asset($rs->about_us_image_back)}}" alt="" style="width: 100px;"></center></td>
                            <td><center>
                                <a href="{{ url('/backend/home/powertex/edit/'.$rs->about_us_id) }}"> <button type="button" class="btn btn-warning">แก้ไข</button></a>
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
</script>
@endsection
