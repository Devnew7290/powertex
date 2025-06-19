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
        Schema::create('text_haeders', function (Blueprint $table) {
            $table->increments('texth_id');
            $table->text('texth_text')->nullable();
            $table->text('texth_link')->nullable();
            $table->enum('texth_status', ['show', 'hide'])->nullable()->comment('แสดง หรือซ่อน');
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
        Schema::dropIfExists('text_haeders');
    }
};
