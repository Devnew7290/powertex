<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

    @extends('backend.layouts.master')
    <?php
        $activePage = "product";
        $active = "type";
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
                <div class="font-medium text-center text-lg">เพิ่ม หมวดหมู่สินค้าย่อย ของหมวดหมู่ {{$main->cm_name}}</div>

            </div>
            <form action="{{ url('backend/product/type/sub/create/'.$id) }}" method="post" enctype="multipart/form-data" onSubmit="return checkImage(this)">
                @csrf
                <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-sl ate-200/60 dark:border-darkmode-400">
                    <div class="font-medium text-base">รายละเอียด</div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> หัวข้อ </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="sub_topic" id="sub_topic" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> ลำดับการแสดง </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="sub_number" id="sub_number" value="{{count($sub)+1}}" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> แสดง </lable></b>
                        </div>
                        <div class="form-check form-switch" style="display: flex; justify-content: center;">
                            <input id="sub_status" name="sub_status" class="form-check-input" type="checkbox" checked>
                        </div>
                    </div>

                    <br>
                    <hr>

                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                        <div class="intro-y col-span-12 sm:col-span-4">
                            <center><b><label for="input-wizard-1" class="form-label">หัวข้อหมวดหมู่ย่อย 1</label></b></center>
                            <input name="type_sub_topic[0]" id="type_sub_topic_0" type="text" class="form-control">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-4">
                            <center><b><label for="input-wizard-2" class="form-label">ลำดับการแสดง 1</label></b></center>
                            <input name="type_sub_number[0]" id="type_sub_number_0" type="text" class="form-control" value="1">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-4">
                            <center><b><label for="input-wizard-2" class="form-label">แสดง 1</label></b></center>
                            <div class="form-check form-switch" style="display: flex; justify-content: center;">
                                <input id="type_sub_status_0" name="type_sub_status[0]" class="form-check-input" type="checkbox" checked>
                            </div>
                        </div>
                    </div>

                    <div id="form-container"></div>

                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                        <button type="button" class="btn btn-pending w-32 ml-2" onclick="add_testimonials()">เพิ่ม <br> หมวดหมู่ย่อย</button>        
                    </div>

                </div>
        <br><br><br>
        <center>
            <a href="{{ url('backend/product/type/sub/'.$id) }}" class="btn btn-warning w-50">กลับหน้าหลัก</a>
            <button type="submit" class="btn btn-success w-24 ml-2">บันทึก</button>
        </center>

        </form>
    </div>

    </div>

    @endsection


    @section('javascripts')
    <script>
        let formCount = 0; // ใช้ตัวแปรกลางนับจำนวนฟอร์ม

        function add_testimonials() {
            const formContainer = document.getElementById("form-container");
            formCount++; // เพิ่มค่าทุกครั้งที่มีการเพิ่มฟอร์ม

            const div = document.createElement("div");
            div.setAttribute("id", `study${formCount}`);
            div.classList.add("study-item"); // ใช้ class เพื่อระบุฟอร์มที่เพิ่มเข้ามา
            div.innerHTML = `
                <br>
                <hr>
                <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                    <div class="intro-y col-span-12 sm:col-span-3">
                        <center><b><label class="form-label label-title">หัวข้อหมวดหมู่ย่อย ${formCount}</label></b></center>
                        <input name="type_sub_topic[${formCount}]" id="type_sub_topic_${formCount}" type="text" class="form-control" required>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-3">
                        <center><b><label class="form-label label-order">ลำดับการแสดง ${formCount}</label></b></center>
                        <input name="type_sub_number[${formCount}]" id="type_sub_number_${formCount}" type="text" class="form-control order-input" value="${formCount}" required>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-3">
                        <center><b><label class="form-label label-display">แสดง ${formCount}</label></b></center>
                        <div class="form-check form-switch" style="display: flex; justify-content: center;">
                            <input name="type_sub_status[${formCount}]" id="type_sub_status_0" class="form-check-input" type="checkbox" checked>
                        </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-3" style="margin-top: 30px;">
                        <button class="btn py-0 px-2 btn-elevated-danger" type="button" onclick="del_study(this)">ลบ</button>
                    </div>
                </div>
            `;

            formContainer.appendChild(div);
            updateOrder(); // อัปเดตลำดับทุกครั้งที่เพิ่มฟอร์มใหม่
        }

        function del_study(button) {
            const div = button.closest(".study-item");
            if (div && confirm("Are you sure you want to delete this item?")) {
                div.remove();
                updateOrder(); // อัปเดตลำดับหลังจากลบฟอร์ม
            }
        }

        function updateOrder() {
            const formContainer = document.getElementById("form-container");
            const items = formContainer.querySelectorAll(".study-item");

            items.forEach((item, index) => {
                const number = index + 1;

                // อัปเดตค่าของ input ลำดับ
                const orderInput = item.querySelector(".order-input");
                if (orderInput) {
                    orderInput.value = number+1;
                }

                // อัปเดตข้อความของ label
                const labelTitle = item.querySelector(".label-title");
                const labelOrder = item.querySelector(".label-order");
                const labelDisplay = item.querySelector(".label-display");

                if (labelTitle) labelTitle.textContent = `หัวข้อหมวดหมู่ย่อย ${number+1}`;
                if (labelOrder) labelOrder.textContent = `ลำดับการแสดง ${number+1}`;
                if (labelDisplay) labelDisplay.textContent = `แสดง ${number+1}`;
            });

            formCount = items.length; // ปรับ formCount ใหม่ให้ตรงกับจำนวนฟอร์มปัจจุบัน
        }
    </script>
    @endsection


</body>

</html>
