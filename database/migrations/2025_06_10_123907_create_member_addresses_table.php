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
        Schema::create('member_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->enum('type', ['shipping', 'invoice']);
            $table->string('firstname');
            $table->string('lastname');
            $table->text('address');
            $table->string('province');
            $table->string('district');
            $table->string('sub_district');
            $table->string('postcode');
            $table->string('phone');
            $table->string('company_name')->nullable();
            $table->string('tax_number')->nullable();
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('member');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_addresses');
    }
};
