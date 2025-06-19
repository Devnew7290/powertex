@extends('backend.layouts.master')

@section('title_name', 'Responsive Bootstrap 4 Admin Dashboard Template')

@section('styles_link')
<?php
    $activePage = "warranty";
    $active = "";
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
            <div class="font-medium text-center text-lg">ลงทะเบียนรับประกันออนไลน์</div>

        </div>

        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    ข้อมูลลงทะเบียนรับประกันออนไลน์
                </h2>
            </div>

            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>
                            <center>ลำดับ</center>
                        </th>
                        <th>
                            <center>ที่ซื้อสินค้า</center>
                        </th>
                        <th>
                            <center>ชื่อสินค้า / ชื่อรุ่นสินค้า</center>
                        </th>
                        <th>
                            <center>Serial Number</center>
                        </th>
                        <th>
                            <center>หมายเลขบัตรรับประกันสินค้า</center>
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
                    @foreach($warranty as $rs)
                        <tr @if($rs->warranty_new == 'new') style="color: red;" @endif>
                            <td><center>{{$i++}}</center></td>
                            <td><center>{{$rs->warranty_name}}</center></td>
                            <td><center>{{$rs->warranty_product}}</center></td>
                            <td><center>{{$rs->warranty_serial_number}}</center></td>
                            <td><center>{{$rs->warranty_number}}</center></td>
                            <td><center>
                                @if($rs->warranty_success == 'received') กำลังดำเนินการ @else ดำเนินการเรียบร้อย @endif
                            </center></td>
                            <td><center>
                                <a href="{{ url('/backend/warranty/'.$rs->warranty_id) }}"> <button type="button" class="btn btn-warning">แก้ไข</button></a>
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
