<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

    @extends('backend.layouts.master')
    <?php
        if($type == 'aboutUs'){
            $activePage = "aboutUs";
            $active = "";
        }else{
            $activePage = "news_promotion";
            $active = $type;
        }
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
                <div class="font-medium text-center text-lg">เพิ่ม @if($type == "aboutUs")เกี่ยวกับเรา @elseIf($type=="news") ข่าวสาร @elseIf($type=="promotion") โปรโมชั่น @else บทความ @endif</div>

            </div>
            <form action="{{ url('backend/news_promotion/'.$type.'/create') }}" method="post" enctype="multipart/form-data" onSubmit="return checkImage(this)">
                @csrf
                <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-sl ate-200/60 dark:border-darkmode-400">
                    <div class="font-medium text-base">รายละเอียด</div>

                    @if($type == 'aboutUs')
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                                <b><label for="horizontal-form-1" class="form-label "> รูปภาพแบนเนอร์ </lable></b>
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                            </div>
                            <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                                <input type="file" class="form-control" name="news_image_other[]" id="news_image_other" multiple>
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">สามารถเลือกไฟล์ได้หลายไฟล์</span>
                            </div>
                        </div>
                    @else
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                                <b><label for="horizontal-form-1" class="form-label "> รูปภาพปก </lable></b>
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                            </div>
                            <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                                <input type="file" class="form-control" name="news_cover" id="news_cover" required>
                            </div>
                        </div>
                    @endif

                    @if($type == 'news' || $type == 'article')
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                                <b><label for="horizontal-form-1" class="form-label "> รูปภาพแบนเนอร์ </lable></b>
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                            </div>
                            <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                                <input type="file" class="form-control" name="news_banner" id="news_banner" required>
                            </div>
                        </div>
                    @endif

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> หัวข้อ </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="news_topic" id="news_topic" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> เนื้อหา </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <textarea name="news_detail" id="news_detail"></textarea>
                        </div>
                    </div>

                    @if($type != 'aboutUs')
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> วันที่ </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="date" class="form-control" name="news_date" id="news_date" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> แสดง </lable></b>
                        </div>
                        <div class="form-check form-switch" style="display: flex; justify-content: center;">
                            <input id="shipper" name="banner_status" class="form-check-input" type="checkbox" checked>
                        </div>
                    </div>
                    @endif

                    @if($type == 'article' || $type == 'news')
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> รูปภาพประกอบ </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="file" class="form-control" name="news_image_other[]" id="news_image_other" multiple>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">สามารถเลือกไฟล์ได้หลายไฟล์</span>
                        </div>
                    </div>
                    @endif
                    
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> Meta Keywords </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="news_keyword" id="news_keyword">
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> Meta Description </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="news_description" id="news_description">
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> URL </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="news_url" id="news_url">
                        </div>

                </div>
        <br><br><br>
        <center>
            <a href="{{ url('backend/news_promotion/'.$type) }}" class="btn btn-warning w-50">กลับหน้าหลัก</a>
            <button type="submit" class="btn btn-success w-24 ml-2">บันทึก</button>
        </center>

        </form>
    </div>

    </div>

    @endsection


    @section('javascripts')
    <script>
        function checkImage(form) { 
            var extall = "jpg, jpeg, gif, png, webp";

            var image_banner = document.getElementById("brand_banner_image");
            var file_image_banner = image_banner.value;
            var ext_image_banner = file_image_banner.split('.').pop().toLowerCase();
            if (extall.indexOf(ext_image_banner) < 0) {
                form.brand_banner_image.focus();
                alert('รองรับไฟล์นามสกุล : ' + extall);
                return false;
            }

            var image_logo = document.getElementById("news_cover");
            var file_image_logo = image_logo.value;
            var ext_image_logo = file_image_logo.split('.').pop().toLowerCase();
            if (extall.indexOf(ext_image_logo) < 0) {
                form.news_cover.focus();
                alert('รองรับไฟล์นามสกุล : ' + extall);
                return false;
            }

            var image_banner = document.getElementById("news_banner");
            var file_image_banner = image_banner.value;
            var ext_image_banner = file_image_banner.split('.').pop().toLowerCase();
            if (extall.indexOf(ext_image_banner) < 0) {
                form.news_cover.focus();
                alert('รองรับไฟล์นามสกุล : ' + extall);
                return false;
            }

        }

        
        ClassicEditor
        .create( document.querySelector( '#news_detail' ) )
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
