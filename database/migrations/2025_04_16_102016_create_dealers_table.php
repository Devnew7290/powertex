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
        Schema::create('dealers', function (Blueprint $table) {
            $table->increments('dealer_id');
            $table->string('dealer_name', 255)->nullable()->comment('ชื่อตัวแทนจำหน่าย');
            $table->text('dealer_image')->nullable()->comment('ภาพหน้าร้าน');
            $table->string('dealer_address', 255)->nullable()->comment('ที่อยู่');
            $table->integer('FK_province_id')->nullable()->comment('provinces->id');
            $table->integer('FK_amphures_id')->nullable()->comment('amphures->id');
            $table->integer('FK_districts_id')->nullable()->comment('districts->id');
            $table->string('dealer_address_code', 255)->nullable()->comment('รหัสไปรษณีย์');
            $table->string('dealer_day_open', 255)->nullable()->comment('วันเปิดร้าน');
            $table->time('dealer_time_open')->nullable()->comment('เวลาเปิดร้าน');
            $table->time('dealer_time_close')->nullable()->comment('เวลาปิดร้าน');
            $table->string('dealer_phone', 255)->nullable()->comment('เบอร์โทร');
            $table->text('dealer_map')->nullable()->comment('google map');
            $table->text('dealer_line')->nullable();
            $table->text('dealer_facebook')->nullable();
            $table->enum('dealer_show', ['show', 'hide'])->nullable()->comment('แสดง หรือซ่อน');
            $table->integer('FK_user_id')->nullable()->comment('user.id->users');
            $table->string('FK_user_name', 255)->nullable()->comment('user.name->users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dealers');
    }
};
