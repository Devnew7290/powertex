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
        Schema::create('product_promocodes', function (Blueprint $table) {
            $table->increments('ppc_id'); // auto_increment primary key
            $table->integer('FK_ppc_product')->nullable()->comment('products -> id');
            $table->integer('FK_ppc_promocode')->nullable()->comment('promocode -> id');
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
        Schema::dropIfExists('product_promocodes');
    }
};
