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
                <div class="font-medium text-center text-lg">แก้ไข ทำไมต้องพาวเวอร์เท็กซ์</div>

            </div>
            <form action="{{ url('backend/home/why/update/'.$whyUs->why_us_id) }}" method="post" enctype="multipart/form-data" onSubmit="return checkImage(this)">
                @csrf
                <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-sl ate-200/60 dark:border-darkmode-400">
                    <div class="font-medium text-base">รายละเอียด</div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> หัวข้อ </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="why_us_topic" id="why_us_topic" placeholder="ทำไมต้องเลือก POWERTEX" value="{{$whyUs->why_us_topic}}" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> เนื้อหา </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <textarea name="why_us_detail" id="why_us_detail">{{$whyUs->why_us_detail}}</textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> วิดีโอ </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" name="why_us_vdo" id="why_us_vdo" class="form-control" value="{{$whyUs->why_us_vdo}}" required>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">https://www.youtube.com/watch?v=At9Rb5E_InY ใช้ในส่วน v=At9Rb5E_InY</span>
                        </div>
                    </div>

                    @php $i = 0; @endphp
                    @foreach($guarantee as $rs)
                        <div class="flex items-center mt-8"></div>
                        <hr>
                        <div class="flex items-center mt-8"></div>

                        <div class="intro-y col-span-12 sm:col-span-6">
                            <b><label class="form-label">การันตี {{$i+1}}</label></b>
                            <button class="btn py-0 px-2 btn-elevated-danger" type="button" onclick="del_warranty({{$rs->guarantees_id}})">ลบ</button>
                        </div>

                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                                <b><label for="horizontal-form-1" class="form-label "> Image Old </lable></b>
                            </div>
                            <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                                <img src="{{ asset($rs->guarantees_icon) }}" style="width: 50px; height:auto; background:#000000;">
                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                                <b><label for="horizontal-form-1" class="form-label "> รูปภาพไอคอน </lable></b>
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                            </div>
                            <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                                <input class="form-control box-form-ct" name="guarantee_image[{{$i}}]" type="file" id="guarantee_image_{{$i}}">
                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                                <b><label for="horizontal-form-1" class="form-label "> หัวข้อ </lable></b>
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                            </div>
                            <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                                <input class="form-control box-form-ct" name="guarantee_topic[{{$i}}]" type="text" id="guarantee_topic_{{$i}}" value="{{$rs->guarantees_topic}}" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                                <b><label for="horizontal-form-1" class="form-label "> เนื้อหา </lable></b>
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                            </div>
                            <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                                <textarea name="guarantee_detail[{{$i}}]" id="guarantee_detail_{{$i}}">{{$rs->guarantees_detail}}</textarea>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                                <b><label for="horizontal-form-1" class="form-label "> ลำดับการแสดง </lable></b>
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                            </div>
                            <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                                <input class="form-control box-form-ct" name="guarantee_number[{{$i}}]" type="text" id="guarantee_number_{{$i}}" value="{{$rs->guarantees_number}}" required>
                            </div>
                        </div>
                        <input class="form-control box-form-ct" name="guarantee_id[{{$i}}]" type="hidden" id="guarantee_id_{{$i++}}" value="{{$rs->guarantees_id }}" required>
                    @endforeach

                    <input type="hidden" name="countGuarantee" id="countGuarantee" value="{{count($guarantee)}}">

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> <!-- delete -->

    <script>
        function del_warranty(id) {
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
                        url: "{!! url('/backend/home/why/warranty/delete/" + id + "') !!}",
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

        function add_testimonials() {
            const formContainer = document.getElementById("form-container");
            let countGuarantee = parseInt(document.getElementById("countGuarantee").value); // แปลงค่าเป็นตัวเลข

            let formCount = countGuarantee;

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
                        <input class="form-control box-form-ct" name="guarantee_image[${formCount}]" type="file" id="guarantee_image_${formCount}">
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

                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                        <b><label for="horizontal-form-1" class="form-label "> ลำดับการแสดง </lable></b>
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                    </div>
                    <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                        <input class="form-control box-form-ct" name="guarantee_number[${formCount}]" type="text" id="guarantee_number_${formCount}" value="${formCount+1}" required>
                    </div>
                </div>
            `;
            formContainer.appendChild(div);

            countGuarantee++;
            document.getElementById("countGuarantee").value = countGuarantee;
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





        document.addEventListener("DOMContentLoaded", function() {
            let countTime = 0;
            @foreach($guarantee as $row)
                ClassicEditor.create(document.querySelector(`#guarantee_detail_${countTime}`))
                .then(editor => {
                    console.log(`Editor for guarantee_detail_${countTime} initialized`);
                })
                .catch(error => {
                    console.error(error);
                });

                countTime++; // อัปเดตค่าหลังจากวนลูป
                
                document.getElementById(`guarantee_image_${countTime}`).addEventListener("change", function () {
                    var extallImage = ["jpg", "jpeg", "gif", "png", "webp"];
                    var fileImage = this.value;
                    var extImage = fileImage.split('.').pop().toLowerCase();
                    if (!extallImage.includes(extImage)) {
                        alert('รองรับไฟล์นามสกุล : ' + extallImage.join(", "));
                        this.value = "";
                    }
                });
            @endforeach
        });





        ClassicEditor
        .create( document.querySelector( '#why_us_detail' ) )
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
