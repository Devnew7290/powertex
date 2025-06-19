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
        Schema::create('guarantees', function (Blueprint $table) {
            $table->increments('guarantees_id'); // auto_increment primary key
            $table->text('guarantees_icon', 255)->nullable();
            $table->string('guarantees_topic', 255)->nullable();
            $table->text('guarantees_detail', 255)->nullable();
            $table->integer('guarantees_number')->nullable();
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
        Schema::dropIfExists('guarantees');
    }
};
