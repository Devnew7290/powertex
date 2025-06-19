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
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('banner_id');
            $table->string('banner_number',50)->nullable()->comment('ลำดับการแสดงผล');
            $table->text('banner_image')->nullable();
            $table->enum('banner_shown', ['show', 'hide'])->nullable()->comment('แสดง หรือซ่อน แบนเนอร์');
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
        Schema::dropIfExists('banners');
    }
};
