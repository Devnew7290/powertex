<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

    @extends('backend.layouts.master')
    <?php
        $activePage = "promocode";
        $active = '';
    ?>
    @section('title_name', 'Responsive Bootstrap 4 Admin Dashboard Template')
</head>

<body>

    @section('styles_link')

    @endsection

    @section('styles')


    @endsection

    @section('content')
    <!-- BEGIN: Content -->
    <div class="content">
        <div class="flex items-center mt-8">

        </div>
        <!-- BEGIN: Wizard Layout -->
        <div class="intro-y box py-10 sm:py-20 mt-5">

            <div class="px-5 mt-10">
                <div class="font-medium text-center text-lg">เพิ่ม โค้ดส่วนลด</div>

            </div>
            <form action="{{ url('backend/promocode/update/'.$data->promocode_id) }}" method="post" enctype="multipart/form-data" onSubmit="return checkImage(this)">
                @csrf
                <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-sl ate-200/60 dark:border-darkmode-400">
                    <div class="font-medium text-base">รายละเอียด</div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> รหัสโค้ดส่วนลด </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="promocode_code" id="promocode_code" value="{{$data->promocode_code}}" required>
                        </div>
                    </div>

                    <!-- @if($data->promocode_image)
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> รูปภาพปกเก่า </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in" style="width: 44%;">
                                <img class="rounded-md" src="{{asset($data->promocode_image)}}">
                                <div class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-4 -mt-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="x" data-lucide="x" class="lucide lucide-x w-4 h-4"
                                        onclick="del_image({{$data->promocode_id}})">
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif -->

                    <!-- <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> รูปภาพปก@if($data->promocode_image)ใหม่@endif </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="file" class="form-control" name="promocode_cover" id="promocode_cover">
                        </div>
                    </div> -->

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> ส่วนลด </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <input type="number" class="form-control" name="promocode_price" id="promocode_price" value="{{$data->promocode_price}}" required>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <select name="promotion_type" id="promotion_type" class="form-control">
                                <option value="percent" @if($data->promocode_price_type == 'percent') selected @endif>เปอร์เซ็นต์</option>
                                <option value="bath" @if($data->promocode_price_type == 'bath') selected @endif>บาท</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> ราคาซื้อขั้นต่ำ </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="number" class="form-control" name="promocode_min_price" id="promocode_min_price" value="{{$data->promocode_min_price}}" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> เริ่มใช้โค้ดส่วนลดได้ </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="date" class="form-control" name="promocode_date_start" id="promocode_date_start" value="{{$data->promocode_date_start}}" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> สิ้นสุดการใช้โค้ดส่วนลด </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="date" class="form-control" name="promocode_date_end" id="promocode_date_end" value="{{$data->promocode_date_end}}" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> ประเภทส่วนลด </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <select name="promocode_type" id="promocode_type" class="form-control" required>
                                <option value="all" @if($data->promocode_type == 'all') selected @endif>ส่วนลดทั้งออเดอร์</option>
                                <option value="percent" @if($data->promocode_type == 'percent') selected @endif>ส่วนลดแบบเปอร์เซ็นต์</option>
                                <option value="bath" @if($data->promocode_type == 'bath') selected @endif>ส่วนลดแบบบาท</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> จำนวนโค้ดส่วนลด </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="number" class="form-control" name="promocode_number" id="promocode_number" value="{{$data->promocode_number}}" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> ผู้ที่สามารถใช้โค้ดได้ </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <select name="promocoes_user_use" id="promocoes_user_use" class="form-control" required>
                                <option value="all" @if($data->promocode_user == 'all') selected @endif>สามารถใช้ได้ทุกคน</option>
                                <option value="new" @if($data->promocode_user == 'new') selected @endif>เฉพาะผู้ที่ยังไม่คเยสั่งสินค้า</option>
                                <option value="old" @if($data->promocode_user == 'old') selected @endif>เฉพาะผู้ที่เคยสั่งซื้อสินค้าแล้ว</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> ใช้โค้ดได้กี่ครั้ง </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="number" class="form-control" name="promocode_user_number" id="promocode_user_number" value="{{$data->promocode_user_use}}" required>
                        </div>
                    </div>

                    @php $products = explode(',', $data->promocode_product); @endphp
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> สินค้าเข้าร่วมโปรโมชั่น </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <input type="checkbox" name="promocode_product_all" id="promocode_product_all" @if(count($products) == count($product)) checked @endif> สินค้าทั้งหมด
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <select name="promocode_product[]" id="promocode_product" class="form-control select2" multiple>
                                @foreach($product as $rs)
                                <option value="{{$rs->products_id}}"
                                    @foreach($products as $row)
                                        @if($rs->products_id == $row)
                                            selected
                                        @endif
                                    @endforeach
                                >
                                    {{$rs->products_code}} {{$rs->products_name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> แสดง </lable></b>
                        </div>
                        <div class="form-check form-switch" style="display: flex; justify-content: center;">
                            <input name="promcode_status" id="promcode_status" class="form-check-input" type="checkbox" @if($data->promocode_status == 'show') checked @endif>
                        </div>
                    </div>

                </div>
        <br><br><br>
        <center>
            <a href="{{ url('backend/promocode/') }}" class="btn btn-warning w-50">กลับหน้าหลัก</a>
            <button type="submit" class="btn btn-success w-24 ml-2">บันทึก</button>
        </center>

        </form>
    </div>

    </div>

    @endsection


    @section('javascripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> <!-- delete -->
    <script>
        function del_image(id) {
            var baseUrl = "{{ url('/') }}";
            var url = baseUrl + "/backend/promocode/image/delete/" + id;

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
                if (result.isConfirmed) {  // ✅ `isConfirmed` ใช้แทน `value`
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function (data) {
                            console.log("ลบสำเร็จ", data);
                            Swal.fire(
                                'สำเร็จ!',
                                'รายการถูกลบสำเร็จแล้ว',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function (xhr) {
                            console.error("เกิดข้อผิดพลาด", xhr);
                            Swal.fire("ผิดพลาด!", "ไม่สามารถลบรายการได้", "error");
                        }
                    });
                }
            });
        }

        $(document).ready(function () {
            // ฟังก์ชัน: เปิด/ปิด select2 ตาม checkbox
            function toggleSelect() {
                if ($('#promocode_product_all').is(':checked')) {
                    $('#promocode_product').prop('disabled', true).trigger('change.select2');
                } else {
                    $('#promocode_product').prop('disabled', false).trigger('change.select2');
                }
            }

            // ฟังก์ชัน: เช็คว่า select ถูกเลือกครบหรือไม่
            function updateCheckboxBySelect() {
                let total = $('#promocode_product option').length; // -1 เพราะ option hidden
                let selected = $('#promocode_product').val()?.length || 0;

                if (selected === total) {
                    $('#promocode_product_all').prop('checked', true);
                    toggleSelect(); // disable select เมื่อครบ
                } else {
                    $('#promocode_product_all').prop('checked', false);
                    toggleSelect(); // enable select เมื่อไม่ครบ
                }
            }

            // เรียกครั้งแรกตอนโหลด
            toggleSelect();

            // เมื่อมีการเช็ค/ยกเลิกเช็ค "สินค้าทั้งหมด"
            $('#promocode_product_all').on('change', function () {
                toggleSelect();
            });

            // เมื่อเลือก/ยกเลิกเลือกใน <select>
            $('#promocode_product').on('change', function () {
                updateCheckboxBySelect();
            });
        });
        
        function checkImage(form) { 
            var extall = "jpg, jpeg, gif, png, webp"

            var image_logo = document.getElementById("promotion_cover");
            var file_image_logo = image_logo.value;
            var ext_image_logo = file_image_logo.split('.').pop().toLowerCase();
            if (extall.indexOf(ext_image_logo) < 0) {
                form.promotion_cover.focus();
                alert('รองรับไฟล์นามสกุล : ' + extall);
                return false;
            }

        }
    </script>
    @endsection


</body>

</html>
