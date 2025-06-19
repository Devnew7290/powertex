@extends('backend.layouts.master')

@section('title_name', 'Responsive Bootstrap 4 Admin Dashboard Template')

@section('styles_link')
<?php
    $activePage = "promocode";
    $active = '';
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
            <div class="font-medium text-center text-lg">โค้ดส่วนลด</div>

        </div>

        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    ข้อมูลโค้ดส่วนลด
                </h2>
                <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                    <a href="{{ url ('backend/promocode/form')}}">
                        <button class="btn btn-elevated-primary w-24 mr-1 mb-2">เพิ่มข้อมูล</button>
                    </a>
                </div>
            </div>

            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>
                            <center>เริ่มใช้โค้ดส่วนลดได้</center>
                        </th>
                        <th>
                            <center>สิ้นสุดการใช้โค้ดส่วนลด</center>
                        </th>
                        <th>
                            <center>โค้ดส่วนลด</center>
                        </th>
                        <th>
                            <center>ซื้อสินค้าครบ</center>
                        </th>
                        <th>
                            <center>ส่วนลด</center>
                        </th>
                        <th>
                            <center>แสดง</center>
                        </th>
                        <th>
                            <center>ตั้งค่า</center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $rs)
                        <tr>
                            <td><center>{{$rs->promocode_date_start}}</center></td>
                            <td><center>{{$rs->promocode_date_end}}</center></td>
                            <td><center>{{$rs->promocode_code}}</center></td>
                            <td><center>{{$rs->promocode_min_price}} บาท</center></td>
                            <td><center>{{$rs->promocode_price}} @if($rs->promocode_price_type == 'percent') % @else บาท @endif </center></td>
                            <td><center>
                                <div class="form-check form-switch" style="display: flex; justify-content: center;">
                                    <input name="promotion_status" id="promotion_status" class="form-check-input" type="checkbox"
                                        onclick="change_status({{ $rs->promocode_id }})" @if($rs->promocode_status == 'show') checked @endif>
                                </div>
                            </center></td>
                            <td><center>
                                <a href="{{ url('/backend/promocode/edit/'.$rs->promocode_id) }}"> <button type="button" class="btn btn-warning">แก้ไข</button></a>
                                    <button type="button" class="btn btn-danger" onclick="del_value({{ $rs->promocode_id }})">ลบ</button>
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
            url: "{!! url('/backend/promocode/change/') !!}/" + id,
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
        var url = baseUrl + "/backend/promocode/delete/" + id;
        
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
