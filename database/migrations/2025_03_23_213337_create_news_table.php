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
        Schema::create('news', function (Blueprint $table) {
            $table->increments('news_id'); // auto_increment primary key
            $table->text('news_image_cover')->nullable();
            $table->text('news_image_banner')->nullable();
            $table->string('news_topic', 255)->nullable();
            $table->text('news_detail')->nullable();
            $table->date('news_date')->nullable();
            $table->enum('news_status', ['show', 'hide'])->nullable()->comment('แสดง หรือซ่อน แบนเนอร์');
            $table->enum('news_type', ['article', 'news', 'aboutUs'])->nullable();
            $table->text('news_keywords')->nullable();
            $table->text('news_description')->nullable();
            $table->text('news_url')->nullable();
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
        Schema::dropIfExists('news');
    }
};
