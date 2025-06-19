<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    
    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5/dist/fancybox/fancybox.css"/>

    <!-- Fancybox JS -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5/dist/fancybox/fancybox.umd.js"></script>

    @extends('backend.layouts.master')
    <?php
        $activePage = "repairs";
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
                <div class="font-medium text-center text-lg">แก้ไข ติดต่อเรา</div>

            </div>
            <form action="{{ url('backend/repairs/update/'.$id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-sl ate-200/60 dark:border-darkmode-400">
                    <div class="font-medium text-base">รายละเอียด</div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> ชื่อลูกค้า / ชื่อร้านค้า </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="contact_map" id="contact_map" value="{{$service->service_name}}" disabled>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> อาการแจ้งซ่อม </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="contact_address" id="contact_address" value="{{$service->service_repair}}" disabled>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> ข้อมูลสำหรับส่งกลับ </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="contact_phone" id="contact_phone" value="{{$service->service_address}}" disabled>
                        </div>
                    </div>

                    <style>
                        .form-upload-img-list-transport {
                            display: flex;
                            flex-wrap: wrap; /* ✅ ให้ขึ้นบรรทัดใหม่เมื่อเกิน */
                            gap: 10px;
                            padding-bottom: 10px;
                        }
                    </style>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> รูปใบรับประกันสินค้า </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-9 form-upload-img-list-transport">
                            @foreach($image as $rs)
                                @if($rs->swd_type == 'warranty')
                                    <img 
                                        src="{{ asset($rs->swd_image) }}" 
                                        alt="" 
                                        class="clickable-image" 
                                        data-full="{{ asset($rs->swd_image) }}"
                                        style="height: 100px; cursor: zoom-in;"
                                    >
                                @endif
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> รูปสินค้าแจ้งซ่อม </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-9 form-upload-img-list-transport">
                            @foreach($image as $rs)
                                @if($rs->swd_type == 'repair')
                                    <img 
                                        src="{{ asset($rs->swd_image) }}" 
                                        alt="" 
                                        class="clickable-image" 
                                        data-full="{{ asset($rs->swd_image) }}"
                                        style="height: 100px; cursor: zoom-in;"
                                    >
                                @endif
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> รูปสินค้าแจ้งซ่อม </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-9 form-upload-img-list-transport">
                            @foreach($image as $rs)
                                @if($rs->swd_type == 'transport')
                                    <img 
                                        src="{{ asset($rs->swd_image) }}" 
                                        alt="" 
                                        class="clickable-image" 
                                        data-full="{{ asset($rs->swd_image) }}"
                                        style="height: 100px; cursor: zoom-in;"
                                    >
                                @endif
                            @endforeach
                        </div>
                    </div>

                    @if($service->service_note)
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> หมายเหตุอื่นๆ </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <textarea name="" id="" class="form-control" disabled>{{$service->service_note}}</textarea>
                        </div>
                    </div>
                    @endif

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> สถานะแจ้งซ่อม </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <select name="service_status" id="service_status" class="form-control">
                                <option value="received" @if($service->service_success == 'received') selected @endif>กำลังดำเนินการ</option>
                                <option value="success" @if($service->service_success == 'success') selected @endif>ซ่อมเรียบร้อย</option>
                            </select>
                        </div>
                    </div>

                </div>
        <br><br><br>
        <center>
            <a href="{{ url('/backend/repairs') }}" class="btn btn-warning w-50">กลับหน้าหลัก</a>
            <button type="submit" class="btn btn-success w-24 ml-2">บันทึก</button>
        </center>

        </form>
    </div>

    </div>

    <style>
        .image-modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.85);
            text-align: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .image-modal .modal-content {
            display: block;
            margin: auto;
            max-width: 80%;
            max-height: 80%;
            width: auto;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 0 20px #000;
        }

        .image-modal .close-btn {
            position: absolute;
            top: 20px;
            right: 30px;
            color: #fff;
            font-size: 36px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>

    <div id="imageModal" class="image-modal">
        <span class="close-btn">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>

    @endsection


    @section('javascripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const modal = document.getElementById("imageModal");
            const modalImg = document.getElementById("modalImage");
            const closeBtn = document.querySelector(".close-btn");

            document.querySelectorAll(".clickable-image").forEach(img => {
                img.addEventListener("click", function () {
                    modal.style.display = "block";
                    modalImg.src = this.dataset.full;
                });
            });

            closeBtn.onclick = function () {
                modal.style.display = "none";
            };

            // ปิดเมื่อคลิกนอกภาพ
            modal.addEventListener("click", function (e) {
                if (e.target === modal) {
                    modal.style.display = "none";
                }
            });
        });
    </script>
    @endsection


</body>

</html>
