@extends('backend.layouts.master')

@section('title_name', 'Responsive Bootstrap 4 Admin Dashboard Template')

@section('styles_link')
<?php
    $activePage = "catalog";
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
            <div class="font-medium text-center text-lg">แคตตาล็อก</div>

        </div>

        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    ข้อมูลแคตตาล็อก
                </h2>
                <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                    <a href="{{ url ('backend/catalog/form')}}">
                        <button class="btn btn-elevated-primary w-24 mr-1 mb-2">เพิ่มข้อมูล</button>
                    </a>
                </div>
            </div>

            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>
                            <center>ลำดับ</center>
                        </th>
                        <th>
                            <center>วันที่เพิ่มข้อมูล</center>
                        </th>
                        <th>
                            <center>แคตตาล็อก</center>
                        </th>
                        <th>
                            <center>ตั้งค่า</center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($catalog as $rs)
                        <tr>
                            <td>
                                <center>{{$i++}}</center>
                            </td>
                            <td>
                                <center>{{ $rs->created_at->format('Y/m/d') }}</center>
                            </td>
                            <td>
                                <center><a href="{{ asset($rs->catalog_pdf) }}" target="_blank">ดูแคตตาล็อก</a></center>
                            </td>
                            <td><center>
                                <a href="{{ url('/backend/catalog/edit/'.$rs->catalog_id) }}"> <button type="button" class="btn btn-warning">แก้ไข</button></a>
                                <button type="button" class="btn btn-danger" onclick="del_value({{ $rs->catalog_id }})">ลบ</button>
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

    function del_value(id) {
        var baseUrl = "{{ url('/') }}";
        var url = baseUrl + "/backend/catalog/delete/" + id;
        
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
