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
        Schema::create('category_thirds', function (Blueprint $table) {
            $table->increments('ct_id');
            $table->string('ct_name', 255)->nullable()->comment('ชื่อหมวดหมู่');
            $table->integer('ct_number')->nullable()->comment('ลำดับแสดงผล');
            $table->integer('FK_category_main')->nullable()->comment('category_mains->id');
            $table->integer('FK_category_sub')->nullable()->comment('category_subs->id');
            $table->enum('ct_status', ['show', 'hide'])->nullable()->comment('แสดง หรือซ่อน');
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
        Schema::dropIfExists('category_thirds');
    }
};
