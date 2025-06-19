@extends('backend.layouts.master')

@section('title_name', 'Responsive Bootstrap 4 Admin Dashboard Template')

@section('styles_link')
<?php
    $activePage = "repairs";
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
            <div class="font-medium text-center text-lg">แจ้งซ่อม</div>

        </div>

        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    ข้อมูลแจ้งซ่อม
                </h2>
                <!-- <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                    <a href="{{ url ('/backend/contact/form')}}">
                        <button class="btn btn-elevated-primary w-24 mr-1 mb-2">เพิ่มข้อมูล</button>
                    </a>
                </div> -->
            </div>

            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>
                            <center>ลำดับ</center>
                        </th>
                        <th>
                            <center>ชื่อลูกค้า / ชื่อร้านค้า</center>
                        </th>
                        <th>
                            <center>อาการแจ้งซ่อม</center>
                        </th>
                        <th>
                            <center>ข้อมูลสำหรับส่งกลับ</center>
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
                    @foreach($service as $rs)
                        <tr @if($rs->service_new == 'new') style="color: red;" @endif>
                            <td><center>{{$i++}}</center></td>
                            <td><center>{{$rs->service_name}}</center></td>
                            <td><center>{{$rs->service_repair}}</center></td>
                            <td><center>{{$rs->service_address}}</center></td>
                            <td><center>
                                @if($rs->service_success == 'received') กำลังดำเนินการ @else ดำเนินการเรียบร้อย @endif
                            </center></td>
                            <td><center>
                                <a href="{{ url('/backend/repairs/'.$rs->service_id) }}"> <button type="button" class="btn btn-warning">แก้ไข</button></a>
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
            url: "{!! url('/backend/contact/change/') !!}/" + id,
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

    function del_value(id) {
        var baseUrl = "{{ url('/') }}";
        var url = baseUrl + "/backend/contact/delete/" + id;
        
        console.log(id, url);

        Swal.fire({
            title: 'ลบรายการนี้ ?',
            text: "คุณต้องการลบรายการนี้หรือไม่ ? เมื่อคุณดำเนินการแล้ว รายการดังกล่าวจะถูกลบออกจากระบบอย่างถาวร !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function (data) {
                        console.log(data);
                    }
                });

                Swal.fire(
                    'สำเร็จ!',
                    'รายการถูกลบสำเร็จแล้ว',
                    'success'
                ).then(() => {
                    location.reload();
                })

            }
        })
    }
</script>
@endsection
