<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

    @extends('backend.layouts.master')
    <?php
        $activePage = "news_promotion";
        $active = 'promotion';
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
                <div class="font-medium text-center text-lg">เพิ่ม โปรโมชั่น</div>

            </div>
            <form action="{{ url('backend/promotion/create') }}" method="post" enctype="multipart/form-data" onSubmit="return checkImage(this)">
                @csrf
                <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-sl ate-200/60 dark:border-darkmode-400">
                    <div class="font-medium text-base">รายละเอียด</div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> รูปภาพปก </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="file" class="form-control" name="promotion_cover" id="promotion_cover" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> หัวข้อ </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="promotion_topic" id="promotion_topic" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> เนื้อหา </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <textarea name="promotion_detail" id="promotion_detail"></textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> ราคาโปรโมชั่น </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <input type="number" class="form-control" name="promotion_price" id="promotion_price" required>
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
                            <b><label for="horizontal-form-1" class="form-label "> วันที่เริ่มโปรโมชั่น </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="date" class="form-control" name="promotion_date_start" id="promotion_date_start" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> วันที่สิ้นสุดโปรโมชั่น </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="date" class="form-control" name="promotion_date_end" id="promotion_date_end" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> สินค้าเข้าร่วมโปรโมชั่น </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <input type="checkbox" name="promotion_product_all" id="promotion_product_all"> สินค้าทั้งหมด
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <select name="promotion_product[]" id="promotion_product" class="form-control select2" multiple>
                                <option value="" hidden> เลือกสินค้า </option>
                                @foreach($product as $rs)
                                <option value="{{$rs->products_id}}">{{$rs->products_code}} {{$rs->products_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> ลำดับการแสดง </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="number" class="form-control" name="promotion_number" id="promotion_number" value="{{ count($data)+1 }}" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> แสดง </lable></b>
                        </div>
                        <div class="form-check form-switch" style="display: flex; justify-content: center;">
                            <input name="promotion_status" id="promotion_status" class="form-check-input" type="checkbox" checked>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> Meta Keywords </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="promotion_keyword" id="promotion_keyword">
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> Meta Description </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="promotion_description" id="promotion_description">
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> URL </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="promotion_url" id="promotion_url">
                        </div>
                    </div>

                </div>
        <br><br><br>
        <center>
            <a href="{{ url('backend/promotion/') }}" class="btn btn-warning w-50">กลับหน้าหลัก</a>
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
                if ($('#promotion_product_all').is(':checked')) {
                    $('#promotion_product').prop('disabled', true).trigger('change.select2');
                } else {
                    $('#promotion_product').prop('disabled', false).trigger('change.select2');
                }
            }

            // ฟังก์ชัน: เช็คว่า select ถูกเลือกครบหรือไม่
            function updateCheckboxBySelect() {
                let total = $('#promotion_product option').length - 1; // -1 เพราะ option hidden
                let selected = $('#promotion_product').val()?.length || 0;

                if (selected === total) {
                    $('#promotion_product_all').prop('checked', true);
                    toggleSelect(); // disable select เมื่อครบ
                } else {
                    $('#promotion_product_all').prop('checked', false);
                    toggleSelect(); // enable select เมื่อไม่ครบ
                }
            }

            // เรียกครั้งแรกตอนโหลด
            toggleSelect();

            // เมื่อมีการเช็ค/ยกเลิกเช็ค "สินค้าทั้งหมด"
            $('#promotion_product_all').on('change', function () {
                toggleSelect();
            });

            // เมื่อเลือก/ยกเลิกเลือกใน <select>
            $('#promotion_product').on('change', function () {
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
