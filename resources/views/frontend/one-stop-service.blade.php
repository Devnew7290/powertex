<!doctype html>
<html>
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<title>Powertex</title>
<?php // require('inc_header.php'); ?>
  @include('frontend.inc_header')
</head>
<body>
  <?php // require('inc_menu.php'); ?>
  @include('frontend.inc_menu')
  <section class="container-fluid section-inside login-bg">
    <div class="container register-container">
        <div class="row">
            <div class="col-12 head-fp head-fp-center">
                <h2 class="wow fadeInDown one-stophead">
                    <img src="{{asset('images/icon-one-stop-service.svg')}}" alt="">
                    <div class="one-stophead-text">One-Stop Service<span>ศูนย์บริการแจ้งซ่อมสินค้า</span></div>
                </h2>
            </div>
        </div>
        <form action="{{ url('one-stop-service/create/') }}" method="post" enctype="multipart/form-data" class="row login-margin">
            @csrf
            <div class="col-12">
                <div class="login-form">
                    <label>ชื่อลูกค้า / ชื่อร้านค้า <span>*</span></label>
                    <input type="text" name="service_name" id="service_name" required>
                </div>
            </div>
            <div class="col-12">
                <div class="login-form">
                    <label>อาการแจ้งซ่อม <span>*</span></label>
                    <input type="text" name="service_repair" id="service_repair" required>
                </div>
            </div>
            <div class="col-12">
                <div class="login-form">
                    <label>ข้อมูลสำหรับส่งกลับ <span>*</span></label>
                    <input type="text" name="service_address" id="service_address" required>
                </div>
            </div>
            <style>
                .form-upload-img-list-warranty {
                    display: flex;
                    gap: 10px;
                    overflow-x: auto;
                    white-space: nowrap;
                    padding-bottom: 10px;
                }
            </style>
            <div class="col-12">
                <div class="login-form">
                    <label>รูปใบรับประกันสินค้า <span>*</span></label>
                    <a href="{{asset('images/warranty01.jpg')}}" data-fancybox>ตัวอย่างใบรับประกันสินค้า</a>
                    <div class="form-upload">
                        <div class="form-upload-img-list-warranty"></div> <!-- preview รูปหลายภาพ -->
                        <div class="form-upload-img-btn">
                            <img src="{{asset('images/icon-upload.svg')}}" alt="">
                            <input 
                                type="file" 
                                class="form-upload-img-btn-input" 
                                name="service_warranty[]" 
                                id="service_warranty" 
                                multiple
                            >
                        </div>
                    </div>
                </div>
            </div>
            <style>
                .form-upload-img-list {
                    display: flex;
                    gap: 10px;
                    overflow-x: auto;
                    white-space: nowrap;
                    padding-bottom: 10px;
                }
            </style>
            <div class="col-12">
                <div class="login-form">
                    <label>รูปสินค้าแจ้งซ่อม <span>*</span></label>
                    <div class="form-upload">
                        <div class="form-upload-img-list"></div> <!-- preview รูปหลายภาพ -->
                        <div class="form-upload-img-btn">
                            <img src="{{asset('images/icon-upload.svg')}}" alt="">
                            <input 
                                type="file" 
                                class="form-upload-img-btn-input" 
                                name="service_image_repair[]" 
                                id="service_image_repair" 
                                multiple
                            >
                        </div>
                    </div>
                </div>
            </div>
            <style>
                .form-upload-img-list-transport {
                    display: flex;
                    gap: 10px;
                    overflow-x: auto;
                    white-space: nowrap;
                    padding-bottom: 10px;
                }
            </style>
            <div class="col-12">
                <div class="login-form">
                    <label>รูปตอนแพ็คเสร็จ / บิลขนส่ง / เลขแทรคกิ้ง <span>*</span></label>
                    <div class="form-upload">
                        <div class="form-upload-img-list-transport"></div> <!-- preview รูปหลายภาพ -->
                        <div class="form-upload-img-btn">
                            <img src="{{asset('images/icon-upload.svg')}}" alt="">
                            <input 
                                type="file" 
                                class="form-upload-img-btn-input" 
                                name="service_transport[]" 
                                id="service_transport" 
                                multiple
                            >
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="login-form">
                    <label>หมายเหตุอื่นๆ</label>
                    <textarea colspan="1" name="service_note" id="service_note"></textarea>
                </div>
            </div>
            <div class="col-12 offset-md-3 col-md-6 offset-lg-3 col-lg-6">
                <button class="login-btn">ยืนยันข้อมูล</button>
            </div>
        </form>
    </div>
  </section>

  <?php // require('inc_footer.php'); ?>
  @include('frontend.inc_footer')

<script>
    // อัพโหลดรูปประกัน
    document.addEventListener("DOMContentLoaded", function () {
        const fileInput = document.getElementById("service_warranty");
        const previewContainer = document.querySelector(".form-upload-img-list-warranty");
        let allFiles = [];

        fileInput.addEventListener("change", function (event) {
            const newFiles = Array.from(event.target.files);

            newFiles.forEach((file) => {
                if (file.type.startsWith("image/")) {
                    allFiles.push(file);
                } else {
                    alert(`ไฟล์ "${file.name}" ไม่ใช่รูปภาพ`);
                }
            });

            updatePreview();
            updateInputFiles();
        });

        function updateInputFiles() {
            const dataTransfer = new DataTransfer();
            allFiles.forEach(file => dataTransfer.items.add(file));
            fileInput.files = dataTransfer.files;
        }

        function updatePreview() {
            previewContainer.innerHTML = "";

            allFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const imgWrapper = document.createElement("div");
                    imgWrapper.classList.add("form-upload-img");

                    const img = document.createElement("img");
                    img.src = e.target.result;

                    const delBtn = document.createElement("button");
                    delBtn.classList.add("form-upload-del");
                    delBtn.innerHTML = '<img src="{{asset("images/icon-del.svg")}}" alt="ลบ">';

                    delBtn.addEventListener("click", function (e) {
                        e.preventDefault();
                        allFiles.splice(index, 1);
                        updatePreview();
                        updateInputFiles();
                    });

                    imgWrapper.appendChild(img);
                    imgWrapper.appendChild(delBtn);
                    previewContainer.appendChild(imgWrapper);
                };

                reader.readAsDataURL(file);
            });
        }
    });
    

    // อัพโหลดรูปสินค้าที่ต้องการซ่อม
    document.addEventListener("DOMContentLoaded", function () {
        const fileInput = document.getElementById("service_image_repair");
        const previewContainer = document.querySelector(".form-upload-img-list");
        let allFiles = [];

        fileInput.addEventListener("change", function (event) {
            const newFiles = Array.from(event.target.files);

            newFiles.forEach((file) => {
                if (file.type.startsWith("image/")) {
                    allFiles.push(file);
                } else {
                    alert(`ไฟล์ "${file.name}" ไม่ใช่รูปภาพ`);
                }
            });

            updatePreview();
            updateInputFiles();
        });

        function updateInputFiles() {
            const dataTransfer = new DataTransfer();
            allFiles.forEach(file => dataTransfer.items.add(file));
            fileInput.files = dataTransfer.files;
        }

        function updatePreview() {
            previewContainer.innerHTML = "";

            allFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const imgWrapper = document.createElement("div");
                    imgWrapper.classList.add("form-upload-img");

                    const img = document.createElement("img");
                    img.src = e.target.result;

                    const delBtn = document.createElement("button");
                    delBtn.classList.add("form-upload-del");
                    delBtn.innerHTML = '<img src="{{asset("images/icon-del.svg")}}" alt="ลบ">';

                    delBtn.addEventListener("click", function (e) {
                        e.preventDefault();
                        allFiles.splice(index, 1);
                        updatePreview();
                        updateInputFiles();
                    });

                    imgWrapper.appendChild(img);
                    imgWrapper.appendChild(delBtn);
                    previewContainer.appendChild(imgWrapper);
                };

                reader.readAsDataURL(file);
            });
        }
    });
    

    // อัพโหลดรูปขนส่ง
    document.addEventListener("DOMContentLoaded", function () {
        const fileInput = document.getElementById("service_transport");
        const previewContainer = document.querySelector(".form-upload-img-list-transport");
        let allFiles = [];

        fileInput.addEventListener("change", function (event) {
            const newFiles = Array.from(event.target.files);

            newFiles.forEach((file) => {
                if (file.type.startsWith("image/")) {
                    allFiles.push(file);
                } else {
                    alert(`ไฟล์ "${file.name}" ไม่ใช่รูปภาพ`);
                }
            });

            updatePreview();
            updateInputFiles();
        });

        function updateInputFiles() {
            const dataTransfer = new DataTransfer();
            allFiles.forEach(file => dataTransfer.items.add(file));
            fileInput.files = dataTransfer.files;
        }

        function updatePreview() {
            previewContainer.innerHTML = "";

            allFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const imgWrapper = document.createElement("div");
                    imgWrapper.classList.add("form-upload-img");

                    const img = document.createElement("img");
                    img.src = e.target.result;

                    const delBtn = document.createElement("button");
                    delBtn.classList.add("form-upload-del");
                    delBtn.innerHTML = '<img src="{{asset("images/icon-del.svg")}}" alt="ลบ">';

                    delBtn.addEventListener("click", function (e) {
                        e.preventDefault();
                        allFiles.splice(index, 1);
                        updatePreview();
                        updateInputFiles();
                    });

                    imgWrapper.appendChild(img);
                    imgWrapper.appendChild(delBtn);
                    previewContainer.appendChild(imgWrapper);
                };

                reader.readAsDataURL(file);
            });
        }
    });
    

    document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector("form");
        const requiredUploadFields = [
            { id: "service_warranty", name: "รูปใบรับประกันสินค้า" },
            { id: "service_image_repair", name: "รูปสินค้าแจ้งซ่อม" },
            { id: "service_transport", name: "รูปแพ็ค/ขนส่ง/แทรคกิ้ง" }
        ];

        form.addEventListener("submit", function (e) {
            let missingFields = [];

            requiredUploadFields.forEach(field => {
                const input = document.getElementById(field.id);
                if (!input || input.files.length === 0) {
                    missingFields.push(field.name);
                }
            });

            if (missingFields.length > 0) {
                e.preventDefault();
                alert(`กรุณาอัปโหลดไฟล์ในช่องต่อไปนี้:\n- ${missingFields.join("\n- ")}`);
                return;
            }

            // ถ้าไฟล์ครบ ถามยืนยันก่อน submit จริง
            const confirmSubmit = confirm("คุณต้องการส่งข้อมูลใช่หรือไม่?");
            if (!confirmSubmit) {
                e.preventDefault();
            }
        });
    });

$(document).ready(function(){

});    
</script>
</body>
</html>