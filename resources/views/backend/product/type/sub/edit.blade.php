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
                <div class="font-medium text-center text-lg">แก้ไข หมวดหมู่สินค้าย่อย ของหมวดหมู่ {{$main->cm_name}}</div>

            </div>
            <form action="{{ url('backend/product/type/sub/update/'.$type.'/'.$id) }}" method="post" enctype="multipart/form-data" onSubmit="return checkImage(this)">
                @csrf
                <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-sl ate-200/60 dark:border-darkmode-400">
                    <div class="font-medium text-base">รายละเอียด</div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> หัวข้อ </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="sub_topic" id="sub_topic" value="{{$sub->cs_name}}" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> ลำดับการแสดง </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="sub_number" id="sub_number" value="{{$sub->cs_number}}" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> แสดง </lable></b>
                        </div>
                        <div class="form-check form-switch" style="display: flex; justify-content: center;">
                            <input id="sub_status" name="sub_status" class="form-check-input" type="checkbox" @if($sub->cs_status == 'show') checked @endif>
                        </div>
                    </div>

                    @php $i = 0; @endphp
                    @foreach($third as $rs)
                    <br>
                    <hr>

                    <input name="type_sub_id[{{$i}}]" id="type_sub_id_{{$i}}" type="hidden" class="form-control" value="{{$rs->ct_id}}" required>

                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                        <div class="intro-y col-span-12 sm:col-span-3">
                            <center><b><label for="input-wizard-1" class="form-label">หัวข้อหมวดหมู่ย่อย {{$i+1}}</label></b></center>
                            <input name="type_sub_topic[{{$i}}]" id="type_sub_topic_{{$i}}" type="text" class="form-control" value="{{$rs->ct_name}}" required>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-3">
                            <center><b><label for="input-wizard-2" class="form-label">ลำดับการแสดง {{$i+1}}</label></b></center>
                            <input name="type_sub_number[{{$i}}]" id="type_sub_number_{{$i}}" type="text" class="form-control" value="{{$rs->ct_number}}" required>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-3">
                            <center><b><label for="input-wizard-2" class="form-label">แสดง {{$i+1}}</label></b></center>
                            <div class="form-check form-switch" style="display: flex; justify-content: center;">
                                <input id="type_sub_status_{{$i}}" name="type_sub_status[{{$i++}}]" class="form-check-input" type="checkbox" @if($rs->ct_status == 'show') checked @endif>
                            </div>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-3" style="margin-top: 30px;">
                            <button class="btn py-0 px-2 btn-elevated-danger" type="button" onclick="del_type_third({{$rs->ct_id}})">ลบ</button>
                        </div>
                    </div>
                    @endforeach

                    <input name="countThird" id="countThird" type="hidden" class="form-control" value="{{$i}}">

                    <div id="form-container"></div>

                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                        <button type="button" class="btn btn-pending w-32 ml-2" onclick="add_sub_type()">เพิ่ม <br> หมวดหมู่ย่อย</button>        
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> <!-- delete -->
    <script>
        function add_sub_type() {
            const formContainer = document.getElementById("form-container");
            let countThirdElement = document.getElementById("countThird");
            let countThird = parseInt(countThirdElement.value); // แปลงค่าเป็นตัวเลข
            countThirdElement.value = countThird; // อัปเดตค่าใน input hidden

            console.log(countThird);

            const div = document.createElement("div");
            div.setAttribute("id", `study${countThird}`);
            div.classList.add("study-item"); 
            div.innerHTML = `
                <br>
                <hr>
                <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                    <div class="intro-y col-span-12 sm:col-span-3">
                        <center><b><label for="input-wizard-1" class="form-label">หัวข้อหมวดหมู่ย่อย ${countThird+1}</label></b></center>
                        <input name="type_sub_topic[${countThird}]" id="type_sub_topic_${countThird}" type="text" class="form-control" required>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-3">
                        <center><b><label for="input-wizard-2" class="form-label">ลำดับการแสดง ${countThird+1}</label></b></center>
                        <input name="type_sub_number[${countThird}]" id="type_sub_number_${countThird}" type="text" class="form-control" value="${countThird+1}" required>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-3">
                        <center><b><label for="input-wizard-2" class="form-label">แสดง ${countThird+1}</label></b></center>
                        <div class="form-check form-switch" style="display: flex; justify-content: center;">
                            <input id="type_sub_status_${countThird}" name="type_sub_status[${countThird}]" class="form-check-input" type="checkbox" checked>
                        </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-3" style="margin-top: 30px;">
                        <button class="btn py-0 px-2 btn-elevated-danger" type="button" onclick="del_study(this)">ลบ</button>
                    </div>
                </div>
            `;

            formContainer.appendChild(div);
            updateOrder(); // อัปเดตลำดับทุกครั้งที่เพิ่มฟอร์มใหม่
            countThird++;
            document.getElementById("countThird").value = countThird;
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

        function del_type_third(id){
            var baseUrl = "{{ url('/') }}";
            var url = baseUrl + "/backend/product/type/sub/third/delete/" + id;
            
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
                if (result.value) {
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function (data) {
                            console.log(data);
                        }
                    });

                    Swal.fire(
                        'สำเร็จ!',
                        'รายการถูกลบสำเร็จแล้ว',
                        'success'
                    ).then(() => {
                        location.reload();
                    })

                }
            })
        }
    </script>
    @endsection


</body>

</html>
