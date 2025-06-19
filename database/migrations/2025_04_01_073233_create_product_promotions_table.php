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
        Schema::create('product_promotions', function (Blueprint $table) {
            $table->increments('pp_id'); // auto_increment primary key
            $table->integer('FK_pp_product')->nullable()->comment('products -> id');
            $table->integer('FK_pp_promotion')->nullable()->comment('promotion -> id');
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
        Schema::dropIfExists('product_promotions');
    }
};
