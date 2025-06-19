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
            <form action="{{ url('backend/promocode/create') }}" method="post" enctype="multipart/form-data" onSubmit="return checkImage(this)">
                @csrf
                <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-sl ate-200/60 dark:border-darkmode-400">
                    <div class="font-medium text-base">รายละเอียด</div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> รหัสโค้ดส่วนลด </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="promocode_code" id="promocode_code" required>
                        </div>
                    </div>

                    <!-- <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> รูปภาพปก </lable></b>
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
                            <input type="number" class="form-control" name="promocode_price" id="promocode_price" required>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <select name="promotion_type" id="promotion_type" class="form-control">
                                <option value="percent">เปอร์เซ็นต์</option>
                                <option value="bath">บาท</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> ราคาซื้อขั้นต่ำ </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="number" class="form-control" name="promocode_min_price" id="promocode_min_price" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> เริ่มใช้โค้ดส่วนลดได้ </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="date" class="form-control" name="promocode_date_start" id="promocode_date_start" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> สิ้นสุดการใช้โค้ดส่วนลด </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="date" class="form-control" name="promocode_date_end" id="promocode_date_end" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> ประเภทส่วนลด </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <select name="promocode_type" id="promocode_type" class="form-control" required>
                                <option value="all">ส่วนลดทั้งออเดอร์</option>
                                <option value="percent">ส่วนลดแบบเปอร์เซ็นต์</option>
                                <option value="bath">ส่วนลดแบบบาท</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> จำนวนโค้ดส่วนลด </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="number" class="form-control" name="promocode_number" id="promocode_number" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> ผู้ที่สามารถใช้โค้ดได้ </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <select name="promocoes_user_use" id="promocoes_user_use" class="form-control" required>
                                <option value="all">สามารถใช้ได้ทุกคน</option>
                                <option value="new">เฉพาะผู้ที่ยังไม่คเยสั่งสินค้า</option>
                                <option value="old">เฉพาะผู้ที่เคยสั่งซื้อสินค้าแล้ว</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> ใช้โค้ดได้กี่ครั้ง </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="number" class="form-control" name="promocode_user_number" id="promocode_user_number" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> สินค้าเข้าร่วมโปรโมชั่น </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <input type="checkbox" name="promocode_product_all" id="promocode_product_all"> สินค้าทั้งหมด
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <select name="promocode_product[]" id="promocode_product" class="form-control select2" multiple>
                                @foreach($product as $rs)
                                <option value="{{$rs->products_id}}">{{$rs->products_code}} {{$rs->products_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> แสดง </lable></b>
                        </div>
                        <div class="form-check form-switch" style="display: flex; justify-content: center;">
                            <input name="promcode_status" id="promcode_status" class="form-check-input" type="checkbox" checked>
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
    <script>
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

        
        ClassicEditor
        .create( document.querySelector( '#promotion_detail' ) )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );
    </script>
    @endsection


</body>

</html>
