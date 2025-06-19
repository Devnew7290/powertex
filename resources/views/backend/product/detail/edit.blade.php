<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

    @extends('backend.layouts.master')
    <?php
        $activePage = "product";
        $active = "detail";
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
                <div class="font-medium text-center text-lg">แก้ไข สินค้า</div>

            </div>
            <form action="{{ url('backend/product/detail/update/'.$id) }}" method="post" enctype="multipart/form-data" onSubmit="return checkImage(this)">
                @csrf
                <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-sl ate-200/60 dark:border-darkmode-400">
                    <div class="font-medium text-base">รายละเอียด</div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> รหัสสินค้า </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="product_code" id="product_code" value="{{$product->products_code}}" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> ชื่อสินค้า </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="product_name" id="product_name" value="{{$product->products_name}}" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> แบรนด์สินค้า </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <select name="product_brand" id="product_brand" class="form-control select2" required>
                                <option value="" hidden> กรุณาเลือก </option>
                                @foreach($brand as $rs)
                                    <option value="{{$rs->brand_id}}" @if($product->FK_brand == $rs->brand_id) selected @endif>{{$rs->brand_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> หมวดหมู่สินค้า </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <select name="product_type_main" id="product_type_main" class="form-control select2" onchange="type_main()" required>
                                <option value="" hidden> กรุณาเลือก </option>
                                @foreach($main as $rs)
                                    <option value="{{$rs->cm_id}}" @if($product->FK_category_mains == $rs->cm_id) selected @endif>{{$rs->cm_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> หมวดหมู่สินค้าขั้นที่ 2 </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <select name="product_sub" id="product_sub" class="form-control select2" onchange="type_sub()">
                                <option value="" hidden> กรุณาเลือก </option>
                                @foreach($Sub as $rs)
                                    <option value="{{$rs->cs_id}}" @if($product->FK_category_sub == $rs->cs_id) selected @endif>{{$rs->cs_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> หมวดหมู่สินค้าขั้นที่ 3 </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <select name="product_third" id="product_third" class="form-control select2">
                                <option value="" hidden> กรุณาเลือก </option>
                                @foreach($Third as $rs)
                                    <option value="{{$rs->ct_id}}" @if($product->FK_category_third == $rs->ct_id) selected @endif>{{$rs->ct_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> ราคาตั้ง </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="number" class="form-control" name="product_price_full" id="product_price_full" value="{{$product->products_price_full}}" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> ราคาขาย </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="number" class="form-control" name="product_price_promotion" id="product_price_promotion" value="{{$product->products_price_promotion}}">
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> คำอธิบายสินค้า </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <textarea name="product_note" id="product_note">{{$product->products_note}}</textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> สถานะสินค้า </lable></b>
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500" style="color:red; float: right;">*</span>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <select name="product_send" id="product_send" class="form-control" required>
                                <option value="ready" @if($product->products_send == 'ready') selected @endif>สินค้าพร้อมส่ง (จัดส่งภายใน 2-5 วัน)</option>
                                <option value="nearly" @if($product->products_send == 'nearly') selected @endif>สินค้าใกล้หมด</option>
                                <option value="out" @if($product->products_send == 'out') selected @endif>สินค้าหมด</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> จำนวนสินค้า </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="number" min="0" class="form-control" name="product_quantity" id="product_quantity" value="{{$product->products_quantity}}">
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> รายละเอียดสินค้า </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <textarea name="product_detail" id="product_detail">{{$product->products_detail}}</textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> การันตี </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <textarea name="products_guarantee" id="products_guarantee">{{$product->products_guarantee}}</textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> วิดิโอการใช้งาน </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="product_vdo" id="product_vdo" value="{{$product->products_vdo}}">
                        </div>
                    </div>

                    @if($product->products_manual)
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> คู่มือการใช้งาน 1 เก่า </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <a href="{{ asset($product->products_manual) }}">ดาวน์โหลดคู่มือการใช้งาน 1</a>
                        </div>
                    </div>
                    @endif

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> คู่มือการใช้งาน 1 </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="file" class="form-control" name="products_manual" id="products_manual">
                        </div>
                    </div>

                    @if($product->products_manual_two)
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> คู่มือการใช้งาน 2 เก่า </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <a href="{{ asset($product->products_manual_two) }}">ดาวน์โหลดคู่มือการใช้งาน 2</a>
                        </div>
                    </div>
                    @endif

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> คู่มือการใช้งาน 2 </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="file" class="form-control" name="products_manual_two" id="products_manual_two">
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> รูปภาพ </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="file" class="form-control" name="product_image[]" id="product_image" multiple>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <div class="flex flex-wrap px-4">
                                @foreach($image as $row)
                                    <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in" style="width: 44%;">
                                        <img class="rounded-md" src="{{asset($row->pi_image)}}">
                                        <div class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="x" data-lucide="x" class="lucide lucide-x w-4 h-4"
                                                onclick="del_image({{$row->pi_id}})">
                                            </svg>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> แสดง </lable></b>
                        </div>
                        <div class="form-check form-switch" style="display: flex; justify-content: center;">
                            <input id="product_status" name="product_status" class="form-check-input" type="checkbox" @if($product->products_status == 'show') checked @endif>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> ลำดับการแสดงที่หน้าแรก </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="number" class="form-control" name="product_index" id="product_index" value="{{$product->products_index}}">
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> Meta Keywords </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="product_keyword" id="product_keyword" value="{{$product->products_keywords}}">
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> Meta Description </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="product_description" id="product_description" value="{{$product->products_description}}">
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-3">
                            <b><label for="horizontal-form-1" class="form-label "> URL </lable></b>
                        </div>
                        <div class="mt-2 col-span-12 sm:col-span-6 xl:col-span-6">
                            <input type="text" class="form-control" name="product_url" id="product_url" value="{{$product->products_url}}">
                        </div>
                    </div>

                </div>
        <br><br><br>
        <center>
            <a href="{{ url('/backend/product/detail') }}" class="btn btn-warning w-50">กลับหน้าหลัก</a>
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
            var url = baseUrl + "/backend/product/detail/image/delete/" + id;

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

        function type_main(){
            var product_type_main = document.getElementById("product_type_main").value;
            console.log(product_type_main);
            $.ajax({
                'type': 'post',
                'url': "{{ url('backend/ajax/sub/category') }}",
                'dataType': 'json',
                'data': { 
                    'product_type_main'            : product_type_main,
                    '_token'        : "{{csrf_token()}}"  
                },
            'success': function (data){
                $('#product_sub').html(data.html);
                console.log(data);
                    
                } 
            });  
        }

        function type_sub(){
            var product_sub = document.getElementById("product_sub").value;
            console.log(product_sub);
            $.ajax({
                'type': 'post',
                'url': "{{ url('backend/ajax/third/category') }}",
                'dataType': 'json',
                'data': { 
                    'product_sub'            : product_sub,
                    '_token'        : "{{csrf_token()}}"  
                },
            'success': function (data){
                $('#product_third').html(data.html);
                console.log(data);
                    
                } 
            });  
        }

        function checkImage(form) { 
            var extall = "jpg, jpeg, gif, png, webp";

            var image_banner = document.getElementById("product_banner_image");
            var file_image_banner = image_banner.value;
            var ext_image_banner = file_image_banner.split('.').pop().toLowerCase();
            if (extall.indexOf(ext_image_banner) < 0) {
                form.product_banner_image.focus();
                alert('รองรับไฟล์นามสกุล : ' + extall);
                return false;
            }

            var image_logo = document.getElementById("product_logo_image");
            var file_image_logo = image_logo.value;
            var ext_image_logo = file_image_logo.split('.').pop().toLowerCase();
            if (extall.indexOf(ext_image_logo) < 0) {
                form.product_logo_image.focus();
                alert('รองรับไฟล์นามสกุล : ' + extall);
                return false;
            }

            var extall = "jpg, jpeg, gif, png, webp, pdf";

            var product_manual = document.getElementById("products_manual");
            var file_product_manual = product_manual.value;
            var ext_product_manual = file_product_manual.split('.').pop().toLowerCase();
            if (extall.indexOf(ext_product_manual) < 0) {
                form.products_manual.focus();
                alert('รองรับไฟล์นามสกุล : ' + extall);
                return false;
            }

            var image_logo = document.getElementById("products_manual_two");
            var file_image_logo = image_logo.value;
            var ext_image_logo = file_image_logo.split('.').pop().toLowerCase();
            if (extall.indexOf(ext_image_logo) < 0) {
                form.products_manual_two.focus();
                alert('รองรับไฟล์นามสกุล : ' + extall);
                return false;
            }
        }
        

        


        ClassicEditor
        .create( document.querySelector( '#product_note' ) )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );
        
        ClassicEditor
        .create( document.querySelector( '#product_detail' ) )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );
        
        ClassicEditor
        .create( document.querySelector( '#products_guarantee' ) )
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
