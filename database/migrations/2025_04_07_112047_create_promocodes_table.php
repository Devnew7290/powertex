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
        Schema::create('promocodes', function (Blueprint $table) {
            $table->increments('promocode_id'); // auto_increment primary key
            $table->text('promocode_image')->nullable();
            $table->string('promocode_code', 255)->nullable();
            $table->date('promocode_date_start')->nullable();
            $table->date('promocode_date_end')->nullable();
            $table->integer('promocode_min_price')->nullable()->comment('ราคาขั้นต่ำ');
            $table->integer('promocode_price')->nullable()->comment('ราคาที่ลด');
            $table->enum('promocode_price_type', ['percent', 'bath'])->nullable()->comment('ลดเป็นเปอร์เซ็นต์ หรือบาท');
            $table->enum('promocode_type', ['percent', 'bath', 'all'])->nullable()->comment('ประเภทโค้ด ลดเป็นเปอร์เซ็นต์ บาท หรือทั้งออเดอร์');
            $table->text('promocode_product')->nullable();
            $table->integer('promocode_number')->nullable()->comment('จำนวนโค้ดที่ใช้ได้');
            $table->enum('promocode_user', ['new', 'old', 'all'])->nullable()->comment('user แบบไหนใช้งานได้ new-userใหม่ old-userที่เคยสั่งซื้อแล้ว all-ได้ทุกคน');
            $table->integer('promocode_user_use')->nullable()->comment('จำนวนครั้งที่ user ใช้ได้');
            $table->enum('promocode_status', ['show', 'hide'])->nullable()->comment('แสดง หรือซ่อน แบนเนอร์');
            $table->integer('FK_user_id')->nullable();
            $table->string('FK_user_name', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promocodes');
    }
};
