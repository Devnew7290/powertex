<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

    @extends('backend.layouts.master')
    <?php
        $activePage = "product";
        $active = "brand";
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
                <div class="font-medium text-center text-lg">แก้ไข แบนเนอร์สินค้า</div>

            </div>
            <form action="{{ url('backend/product/brand/update/'.$brand->brand_id) }}" method="post" enctype="multipart/form-data" onSubmit="return checkImage(this)">
                @csrf
                <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-sl ate-200/60 dark:border-darkmode-400">
                    <div class="font-medium text-base">รายละเอียด</div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> ชื่อ </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="brand_name" id="brand_name" value="{{$brand->brand_name}}" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> โลโก้เดิม </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <img src="{{asset($brand->brand_logo)}}" alt="" style="height: 150px;">
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> โลโก้ </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="file" class="form-control" name="brand_logo_image" id="brand_logo_image">
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> รูปภาพเดิม </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <img src="{{asset($brand->brand_banner)}}" alt="" style="height: 150px;">
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> รูปภาพ </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="file" class="form-control" name="brand_banner_image" id="brand_banner_image">
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> แบนเนอร์ </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="file" class="form-control" name="brand_image[]" id="brand_image" multiple>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <div class="flex flex-wrap px-4">
                                @foreach($image as $row)
                                    <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in" style="width: 44%;">
                                        <img class="rounded-md" src="{{asset($row->bi_image)}}">
                                        <div class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="x" data-lucide="x" class="lucide lucide-x w-4 h-4"
                                                onclick="del_image({{$row->bi_id}})">
                                            </svg>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> ลำดับการแสดง </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="brand_number" id="brand_number" value="{{ $brand->brand_number }}" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> แสดง </lable></b>
                        </div>
                        <div class="form-check form-switch" style="display: flex; justify-content: center;">
                            <input id="brand_status" name="brand_status" class="form-check-input" type="checkbox" @if($brand->brand_status == 'show') checked @endif>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> Meta Keywords </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="brand_keyword" id="brand_keyword" value="{{$brand->brand_keywords}}" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> Meta Description </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="brand_description" id="brand_description" value="{{$brand->brand_description}}" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> URL </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="brand_url" id="brand_url" value="{{$brand->brand_url}}" required>
                        </div>
                    </div>

                </div>
        <br><br><br>
        <center>
            <a href="{{ url('/backend/product/brand') }}" class="btn btn-warning w-50">กลับหน้าหลัก</a>
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
            var url = baseUrl + "/backend/product/brand/image/delete/" + id;

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

            var image_logo = document.getElementById("brand_logo_image");
            var file_image_logo = image_logo.value;
            var ext_image_logo = file_image_logo.split('.').pop().toLowerCase();
            if (extall.indexOf(ext_image_logo) < 0) {
                form.brand_logo_image.focus();
                alert('รองรับไฟล์นามสกุล : ' + extall);
                return false;
            }
        }
    </script>
    @endsection


</body>

</html>
