<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

    @extends('backend.layouts.master')
    <?php
        $activePage = "catalog";
        $active = "";
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
                <div class="font-medium text-center text-lg">เพิ่ม แคตตาล็อก</div>

            </div>
            <form action="{{ url('backend/catalog/update/'.$id) }}" method="post" enctype="multipart/form-data" onSubmit="return checkImage(this)">
                @csrf
                <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-sl ate-200/60 dark:border-darkmode-400">
                    <div class="font-medium text-base">รายละเอียด</div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> ไฟล์แคตตาล็อก เดิม </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <a href="{{ asset($catalog->catalog_pdf) }}" target="_blank">
                                <b><label for="horizontal-form-1" class="form-label "> ดูไฟล์แคตตาล็อก เดิม </lable></b>
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> ไฟล์แคตตาล็อก </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="file" class="form-control" name="file_catalog" id="file_catalog" accept=".pdf" required>
                        </div>
                    </div>

                </div>
        <br><br><br>
        <center>
            <a href="{{ url('backend/catalog/') }}" class="btn btn-warning w-50">กลับหน้าหลัก</a>
            <button type="submit" class="btn btn-success w-24 ml-2">บันทึก</button>
        </center>

        </form>
    </div>

    </div>

    @endsection


    @section('javascripts')
    <script>
    </script>
    @endsection


</body>

</html>
