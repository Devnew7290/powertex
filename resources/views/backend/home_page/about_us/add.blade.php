<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

    @extends('backend.layouts.master')
    <?php
        $activePage = "home_page";
        $active = "home_page_powertex";
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
                <div class="font-medium text-center text-lg">เพิ่ม พาวเวอร์เท็กซ์</div>

            </div>
            <form action="{{ url('backend/home/powertex/create') }}" method="post" enctype="multipart/form-data" onSubmit="return checkImage(this)">
                @csrf
                <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-sl ate-200/60 dark:border-darkmode-400">
                    <div class="font-medium text-base">รายละเอียด</div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> หัวข้อ </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="about_topic" id="about_topic" placeholder="POWERTEX พาวเวอร์เท็กซ์" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> เนื้อหา </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <textarea name="about_detail" id="about_detail"></textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> รูปประกอบด้านหน้า </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="file" name="about_image_front" id="about_image_front" class="form-control" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> รูปประกอบด้านหลัง </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="file" name="about_image_back" id="about_image_back" class="form-control" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> โลโก้พาวเวอร์เท็กซ์ </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="file" name="about_powertex" id="about_powertex" class="form-control" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> โลโก้ฮูกง </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="file" name="aobut_hugong" id="aobut_hugong" class="form-control" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> โลโก้ซันฟาล์วเวอร์ </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="file" name="about_sunflower" id="about_sunflower" class="form-control" required>
                        </div>
                    </div>

                </div>
        <br><br><br>
        <center>
            <a href="{{ url('/backend/home/powertex') }}" class="btn btn-warning w-50">กลับหน้าหลัก</a>
            <button type="submit" class="btn btn-success w-24 ml-2">บันทึก</button>
        </center>

        </form>
    </div>

    </div>

    @endsection


    @section('javascripts')
    <script>
        ClassicEditor
        .create( document.querySelector( '#about_detail' ) )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );

        function checkImage(form) { 
            var extall = "jpg, jpeg, gif, png, webp";

            var image_about = document.getElementById("about_image");
            var file_image_about = image_about.value;
            var ext_image_about = file_image_about.split('.').pop().toLowerCase();
            if (extall.indexOf(ext_image_about) < 0) {
                form.about_image.focus();
                alert('รองรับไฟล์นามสกุล : ' + extall);
                return false;
            }

            var image_powertex = document.getElementById("about_powertex");
            var file_image_powertex = image_powertex.value;
            var ext_image_powertex = file_image_powertex.split('.').pop().toLowerCase();
            if (extall.indexOf(ext_image_powertex) < 0) {
                form.about_powertex.focus();
                alert('รองรับไฟล์นามสกุล : ' + extall);
                return false;
            }

            var image_hugong = document.getElementById("aobut_hugong");
            var file_image_hugong = image_hugong.value;
            var ext_image_hugong = file_image_hugong.split('.').pop().toLowerCase();
            if (extall.indexOf(ext_image_hugong) < 0) {
                form.aobut_hugong.focus();
                alert('รองรับไฟล์นามสกุล : ' + extall);
                return false;
            }

            var image_sunflower = document.getElementById("about_sunflower");
            var file_image_sunflower = image_sunflower.value;
            var ext_image_sunflower = file_image_sunflower.split('.').pop().toLowerCase();
            if (extall.indexOf(ext_image_sunflower) < 0) {
                form.about_sunflower.focus();
                alert('รองรับไฟล์นามสกุล : ' + extall);
                return false;
            }
        }
    </script>
    @endsection


</body>

</html>
