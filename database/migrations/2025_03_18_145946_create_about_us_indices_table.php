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
        Schema::create('about_us_indices', function (Blueprint $table) {
            $table->increments('about_us_id');
            $table->string('about_us_topic',255)->nullable()->comment('หัวข้อ');
            $table->text('about_us_detail',255)->nullable()->comment('เนื้อหน้า');
            $table->text('about_us_image_front')->nullable()->comment('รูปภาพประกอบ');
            $table->text('about_us_image_back')->nullable()->comment('รูปภาพประกอบ');
            $table->text('about_us_powertex')->nullable()->comment('โลโก้ powertex');
            $table->text('about_us_hugong')->nullable()->comment('โลโก้ hugong');
            $table->text('about_us_sunflower')->nullable()->comment('โลโก้ sunflower');
            $table->string('about_us_keyword',255)->nullable();
            $table->string('about_us_description',255)->nullable();
            $table->integer('FK_user_id')->nullable()->comment('id -> users');
            $table->string('FK_user_name', 255)->nullable()->comment('name -> users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us_indices');
    }
};
