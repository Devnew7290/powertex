@extends('backend.layouts.master')

@section('title_name', 'Responsive Bootstrap 4 Admin Dashboard Template')

@section('styles_link')
<?php
    if($type == 'aboutUs'){
        $activePage = "aboutUs";
        $active = "";
    }else{
        $activePage = "news_promotion";
        $active = $type;
    }
    $i=1;
?>
@endsection

@section('content')
<!-- BEGIN: Content -->
<div class="content">
    <div class="flex items-center mt-8">

    </div>
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box py-10 sm:py-20 mt-5">

        <div class="px-5 mt-10">
            <div class="font-medium text-center text-lg">@if($type == "aboutUs")เกี่ยวกับเรา @elseIf($type=="news") ข่าวสาร @elseIf($type=="promotion") โปรโมชั่น @else บทความ @endif</div>

        </div>

        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    ข้อมูล@if($type == "aboutUs")เกี่ยวกับเรา @elseIf($type=="news") ข่าวสาร @elseIf($type=="promotion") โปรโมชั่น @else บทความ @endif
                </h2>
                @if($type != 'aboutUs')
                <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                    <a href="{{ url ('backend/news_promotion/'.$type.'/form')}}">
                        <button class="btn btn-elevated-primary w-24 mr-1 mb-2">เพิ่มข้อมูล</button>
                    </a>
                </div>
                @endif
            </div>

            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        @if($type != 'aboutUs')
                            <th>
                                <center>รูปภาพปก</center>
                            </th>
                        @endif
                        @if($type == 'news' || $type == 'article')
                            <th>
                                <center>รูปภาพแบนเนอร์</center>
                            </th>
                        @endif
                        <th>
                            <center>หัวข้อ</center>
                        </th>
                        @if($type == 'aboutUs')
                        <th>
                            <center>เนื้อหา</center>
                        </th>
                        @endif
                        <th>
                            <center>ตั้งค่า</center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $rs)
                        <tr>
                            @if($type != 'aboutUs')
                                <td>
                                    <center> <img src="{{ asset($rs->news_image_cover) }}"> </center>
                                </td>
                            @endif
                            @if($type == 'news' || $type == 'article')
                                <td>
                                    <center> <img src="{{ asset($rs->news_image_banner) }}"> </center>
                                </td>
                            @endif
                            <td><center>{{$rs->news_topic}}</center></td>
                            @if($type == 'aboutUs')
                            <td>
                                {!! $rs->news_detail !!}
                            </td>
                            @endif
                            <td><center>
                                <a href="{{ url('/backend/news_promotion/'.$type.'/edit/'.$rs->news_id) }}"> <button type="button" class="btn btn-warning">แก้ไข</button></a>
                                @if($type != 'aboutUs')
                                    <button type="button" class="btn btn-danger" onclick="del_value('{{ $type }}', {{ $rs->news_id }})">ลบ</button>
                                @endif
                            </center></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    <!-- END: Wizard Layout -->
</div>
<!-- END: Content -->
@endsection
@section('javascripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> <!-- delete -->


<script>
    $(document).ready(function () {
        $('#example').DataTable({
            responsive: true
        });
    });

    function del_value(type, id) {
        var baseUrl = "{{ url('/') }}";
        var url = baseUrl + "/backend/news_promotion/" + type + "/delete/" + id;
        
        console.log(type, id, url);

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
