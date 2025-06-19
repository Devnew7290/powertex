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
        Schema::create('brands', function (Blueprint $table) {
            $table->increments('brand_id');
            $table->string('brand_name', 255)->nullable()->comment('brand name');
            $table->text('brand_logo')->nullable()->comment('โลโก้ยี่ห้อสินค้า');
            $table->text('brand_banner')->nullable()->comment('รูปแบนเนอร์ที่หน้าแรก');
            $table->integer('brand_number')->nullable();
            $table->string('brand_keywords', 255)->nullable();
            $table->string('brand_description', 255)->nullable();
            $table->string('brand_url', 255)->nullable();
            $table->enum('brand_status', ['show', 'hide'])->nullable()->comment('แสดง หรือซ่อน แบนเนอร์');
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
        Schema::dropIfExists('brands');
    }
};
