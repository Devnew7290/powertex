<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

    @extends('backend.layouts.master')
    <?php
        $activePage = "home_page";
        $active = "home_page_why";
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
                <div class="font-medium text-center text-lg">เพิ่ม ทำไมต้องพาวเวอร์เท็กซ์</div>

            </div>
            <form action="{{ url('backend/home/why/create') }}" method="post" enctype="multipart/form-data" onSubmit="return checkImage(this)">
                @csrf
                <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-sl ate-200/60 dark:border-darkmode-400">
                    <div class="font-medium text-base">รายละเอียด</div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> หัวข้อ </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="why_us_topic" id="why_us_topic" placeholder="ทำไมต้องเลือก POWERTEX" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> เนื้อหา </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <textarea name="why_us_detail" id="why_us_detail"></textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> วิดีโอ </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" name="why_us_vdo" id="why_us_vdo" class="form-control" required>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">https://www.youtube.com/watch?v=At9Rb5E_InY ใช้ในส่วน v=At9Rb5E_InY</span>
                        </div>
                    </div>

                    <div class="flex items-center mt-8"></div>
                    <hr>
                    <div class="flex items-center mt-8"></div>

                    <b><label for="input-wizard-1" class="form-label">การันตี 1</label></b>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> รูปภาพไอคอน </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input class="form-control box-form-ct" name="guarantee_image[0]" type="file" id="guarantee_image_0" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> หัวข้อ </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input class="form-control box-form-ct" name="guarantee_topic[0]" type="text" id="guarantee_topic_0" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> เนื้อหา </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <textarea name="guarantee_detail[0]" id="guarantee_detail_0"></textarea>
                        </div>
                    </div>

                    <div id="form-container"></div>

                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                        <button type="button" class="btn btn-pending w-24 ml-2" onclick="add_testimonials()">เพิ่ม การันตี</button>        
                    </div>

                </div>
        <br><br><br>
        <center>
            <a href="{{ url('/backend/home/why') }}" class="btn btn-warning w-50">กลับหน้าหลัก</a>
            <button type="submit" class="btn btn-success w-24 ml-2">บันทึก</button>
        </center>

        </form>
    </div>

    </div>

    @endsection


    @section('javascripts')
    <script>
        function add_testimonials() {
            const formContainer = document.getElementById("form-container");
            let formCount = formContainer.querySelectorAll('[id^="study"]').length + 1;

            const div = document.createElement("div");
            div.setAttribute("id", `study${formCount}`);
            div.innerHTML = `
                <div class="flex items-center mt-8"></div>
                <hr>
                <div class="flex items-center mt-8"></div>

                <b><label for="input-wizard-1" class="form-label">การันตี ${formCount+1}</label></b>
                <button class="btn py-0 px-2 btn-elevated-danger" type="button" onclick="del_study(${formCount})">ลบ</button>

                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                        <b><label for="horizontal-form-1" class="form-label "> รูปภาพไอคอน </lable></b>
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                    </div>
                    <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                        <input class="form-control box-form-ct" name="guarantee_image[${formCount}]" type="file" id="guarantee_image_${formCount}" required>
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                        <b><label for="horizontal-form-1" class="form-label "> หัวข้อ </lable></b>
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                    </div>
                    <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                        <input class="form-control box-form-ct" name="guarantee_topic[${formCount}]" type="text" id="guarantee_topic_${formCount}" required>
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                        <b><label for="horizontal-form-1" class="form-label "> เนื้อหา </lable></b>
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                    </div>
                    <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                        <textarea name="guarantee_detail[${formCount}]" id="guarantee_detail_${formCount}"></textarea>
                    </div>
                </div>
            `;
            formContainer.appendChild(div);

            // Initialize CKEditor for the new textareas
            ClassicEditor.create(document.querySelector(`#guarantee_detail_${formCount}`))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });

            // ตรวจสอบไฟล์รูปภาพ
            var extallImage = ["jpg", "jpeg", "png", "gif", "webp"];
            var fileInputImage = document.getElementById(`timeline_image_${formCount}`);
            fileInputImage.addEventListener("change", function () {
                var fileImage = fileInputImage.value;
                var extImage = fileImage.split('.').pop().toLowerCase();
                if (extallImage.indexOf(extImage) < 0) {
                    alert('รองรับไฟล์นามสกุล : ' + extallImage.join(", "));
                    fileInputImage.value = "";
                }
            });
        }

        function del_study(num) {
            const div = document.getElementById(`study${num}`);
            if (div) {
                if (confirm(`Are you sure you want to delete the item ${num}?`)) {
                    div.parentNode.removeChild(div); // ใช้ parentNode.removeChild เพื่อลบองค์ประกอบ
                    formCount--;
                }
            }
        }





        function checkImage(form) {
            var extallImage = "jpg, jpeg, gif, png, webp";

            var fileInputImage1 = document.getElementById("guarantee_image_0");
            var fileImage1 = fileInputImage1.value;
            var extImage1 = fileImage1.split('.').pop().toLowerCase();
            if (extallImage.indexOf(extImage1) < 0) {
                alert('รองรับไฟล์นามสกุล : ' + extallImage);
                fileInputImage1.focus();
                return false;
            }
        }





        ClassicEditor
        .create( document.querySelector( '#why_us_detail' ) )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );
        
        ClassicEditor
        .create( document.querySelector( '#guarantee_detail_0' ) )
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
