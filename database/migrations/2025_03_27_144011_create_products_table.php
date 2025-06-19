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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('products_id');
            $table->string('products_name', 255)->nullable()->comment('ชื่อสินค้า');
            $table->string('products_code', 255)->nullable()->comment('รหัสสินค้า');
            $table->integer('FK_brand')->nullable()->comment('brand -> id');
            $table->integer('FK_category_mains')->nullable()->comment('category_mains -> id');
            $table->integer('FK_category_sub')->nullable()->comment('category_sub -> id');
            $table->integer('FK_category_third')->nullable()->comment('category_third -> id');
            $table->integer('products_price_full')->nullable()->comment('ราคาเต็มของสินค้า');
            $table->integer('products_price_promotion')->nullable()->comment('ราคาโปรโมชั่นของสินค้า');
            $table->text('products_note')->nullable()->comment('คำอธิบายสินค้า');
            $table->enum('products_send', ['ready', 'out'])->nullable()->comment('พร้อมส่ง หรือหมด');
            $table->integer('products_quantity')->nullable()->comment('จำนวนสินค้าที่มี');
            $table->text('products_detail')->nullable()->comment('รายละเอียดสินค้า');
            $table->text('products_guarantee')->nullable()->comment('รับประกันสินค้า');
            $table->string('products_vdo', 255)->nullable()->comment('vdoการใช้งาน');
            $table->text('products_manual')->nullable()->comment('คู่มือการใช้งาน');
            $table->text('products_manual_two')->nullable()->comment('คู่มือการใช้งาน');
            $table->integer('products_index')->nullable()->comment('ลำดับที่หน้าindex');
            $table->enum('products_status', ['show', 'hide'])->nullable()->comment('แสดง หรือซ่อน แบนเนอร์');
            $table->string('products_keywords', 255)->nullable()->comment('products name');
            $table->string('products_description', 255)->nullable()->comment('products name');
            $table->string('products_url', 255)->nullable()->comment('products name');
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
        Schema::dropIfExists('products');
    }
};
