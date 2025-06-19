<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('warranties', function (Blueprint $table) {
            $table->increments('warranty_id');
            $table->string('warranty_name', 255)->nullable()->comment('ชื่อผู้ขอประกัน');
            $table->string('warranty_product', 255)->nullable()->comment('สินค้าที่ขอประกัน');
            $table->string('warranty_serial_number', 255)->nullable()->comment('Serial Number');
            $table->string('warranty_number', 255)->nullable()->comment('หมายเลขบัตรรับประกันสินค้า');
            $table->enum('warranty_success', ['received', 'success'])->nullable()->comment(' ซ่อมเสร็จแล้ว');
            $table->enum('warranty_new', ['new', 'old'])->nullable()->comment('อันมาใหม่ หรืออันเก่าเห็นแล้ว');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warranties');
    }
};
