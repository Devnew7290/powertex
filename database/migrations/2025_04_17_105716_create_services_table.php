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
        Schema::create('services', function (Blueprint $table) {
            $table->increments('service_id');
            $table->string('service_name', 255)->nullable()->comment('ชื่อผู้แจ้งซ่อม');
            $table->text('service_repair')->nullable()->comment('อาการแจ้งซ่อม');
            $table->text('service_address')->nullable()->comment('ข้อมูลสำหรับส่งกลับ');
            $table->text('service_note')->nullable()->comment('หมายเหตุ');
            $table->enum('service_success', ['received', 'success'])->nullable()->comment(' ซ่อมเสร็จแล้ว');
            $table->enum('service_new', ['new', 'old'])->nullable()->comment('อันมาใหม่ หรืออันเก่าเห็นแล้ว');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
