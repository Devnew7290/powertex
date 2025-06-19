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
        Schema::create('promotions', function (Blueprint $table) {
            $table->increments('promotion_id'); // auto_increment primary key
            $table->text('promotion_image_cover')->nullable();
            $table->string('promotion_topic', 255)->nullable();
            $table->text('promotion_detail')->nullable();
            $table->date('promotion_date_start')->nullable();
            $table->date('promotion_date_end')->nullable();
            $table->integer('promotion_price')->nullable()->comment('จำนวนที่เป็นโปรโมรชั่น');
            $table->enum('promotion_type', ['percent', 'bath'])->nullable()->comment('ลดเป็นเปอร์เซ็นต์ หรือบาท');
            $table->integer('promotion_number')->nullable()->comment('ลำดับการแสดง');
            $table->text('promotion_product')->nullable();
            $table->enum('promotion_status', ['show', 'hide'])->nullable()->comment('แสดง หรือซ่อน แบนเนอร์');
            $table->text('promotion_keyword')->nullable();
            $table->text('promotion_description')->nullable();
            $table->text('promotion_url')->nullable();
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
        Schema::dropIfExists('promotions');
    }
};
