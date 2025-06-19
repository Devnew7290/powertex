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
            <h2 class="wow fadeInDown">ลงทะเบียนรับประกันออนไลน์</h2>
            </div>
        </div>
        <form action="{{ url('warranty/create/') }}" method="post" enctype="multipart/form-data" class="row login-margin">
        @csrf
            <div class="col-12">
                <div class="login-form">
                    <label>ชื่อบริษัท / ห้าง / ร้านค้า ที่ท่านทำการซื้อสินค้า <span>*</span></label>
                    <input type="text" name="name" id="name" required>
                </div>
            </div>
            <div class="col-12">
                <div class="login-form">
                    <label>รูปใบรับประกันสินค้า <span>*</span></label>
                    <a href="{{asset('images/warranty01.jpg')}}" data-fancybox>ตัวอย่างใบรับประกันสินค้า</a>
                    <div class="form-upload">
                        <!-- <div class="form-upload-img">
                            <img src="{{asset('images/warranty01.jpg')}}" alt="">
                            <button class="form-upload-del">
                                <img src="{{asset('images/icon-del.svg')}}" alt="">
                            </button>
                        </div>
                        <div class="form-upload-img">
                            <img src="{{asset('images/warranty01.jpg')}}" alt="">
                            <button class="form-upload-del">
                                <img src="{{asset('images/icon-del.svg')}}" alt="">
                            </button>
                        </div> -->
                        <style>
                            .form-upload-img-list {
                                display: flex;
                                gap: 10px;
                                overflow-x: auto;
                                white-space: nowrap;
                                padding-bottom: 10px;
                            }
                        </style>
                        <div class="form-upload-img-list"></div> <!-- preview รูปหลายภาพ -->
                        <div class="form-upload-img-btn">
                            <img src="images/icon-upload.svg" alt="">
                            <input type="file" class="form-upload-img-btn-input" name="image_warranty[]" id="image_warranty" multiple>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="login-form">
                    <label>โปรดระบุชื่อสินค้า / ชื่อรุ่นสินค้า <span>*</span></label>
                    <a href="{{asset('images/warranty02.jpg')}}" data-fancybox>ตัวอย่างชื่อรุ่น / รหัสสินค้า</a>
                    <input type="text" name="product" id="product" required>
                </div>
            </div>
            <div class="col-12">
                <div class="login-form">
                    <label>โปรดระบุหมายเลขเครื่อง ( Serial Number ) <span>*</span></label>
                    <a href="{{asset('images/warranty03.jpg')}}" data-fancybox>ตัวอย่างหมายเลขเครื่อง</a>
                    <input type="text" name="serial_number" id="serial_number" required>
                </div>
            </div>
            <div class="col-12">
                <div class="login-form">
                    <label>โปรดระบุหมายเลขบัตรรับประกันสินค้า <span>*</span></label>
                    <a href="{{asset('images/warranty04.jpg')}}" data-fancybox>ตัวอย่างหมายเลขธนบัตรรับประกันสินค้า</a>
                    <input type="text" name="warranty_number" id="warranty_number" required>
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
    document.addEventListener("DOMContentLoaded", function () {
        const fileInput = document.getElementById("image_warranty");
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

    document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector("form");
        const requiredUploadFields = [
            { id: "image_warranty", name: "รูปใบรับประกันสินค้า" },
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