@extends('backend.layouts.master')
 
@section('title_name', 'Responsive Bootstrap 4 Admin Dashboard Template')

@section('styles_link')
   
@endsection

@section('styles')
<?php
$activePage = "";
$active = "";
$i=1;
?>

@endsection

@section('content')
  <!-- BEGIN: Content -->
  <div class="content">
            <div class="flex items-center mt-8">
               
            </div>
            <!-- BEGIN: Wizard Layout -->
            <!-- <div class="intro-y box py-10 sm:py-20 mt-5">
                <div class="px-5 mt-10">
                    <div class="font-medium text-center text-lg">ข้อมูลลูกค้า</div>
                </div>
                <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
                    <div class="intro-y block sm:flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">รายละเอียดข้อมูลลูกค้า</h2>
                        <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                        <a href="{{ url ('backend/cus/form')}}"  >   <button class="btn btn-elevated-primary w-24 mr-1 mb-2">เพิ่มข้อมูล</button></a>
                        </div>
                    </div>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th><center>ลำดับ</center></th>
                                <th ><center>รูปภาพ</center></th>
                                <th><center>แก้ไข</center></th>
                                <th><center>ลบ</center></th>
                            </tr>
                        </thead>
                        <tbody> 
                        </tbody>
                    </table>
                </div>
            </div> -->
            <!-- END: Wizard Layout -->
        </div>
        <!-- END: Content -->
@endsection
@section('javascripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>  <!-- delete -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>  <!-- delete -->
<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>

@endsection