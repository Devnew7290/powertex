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
        Schema::create('amphures', function (Blueprint $table) {
            $table->id();
            $table->string('code', 4)->nullable();
            $table->string('name_th', 150)->nullable();
            $table->string('name_en', 150)->nullable();
            $table->integer('province_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amphures');
    }
};
