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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->unsignedBigInteger('member_id');  // FK
            $table->timestamp('order_date');
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->enum('payment_status', ['pending', 'paid', 'cancel'])->default('pending');
            $table->enum('shipping_status', ['processing', 'shipping', 'shipped'])->default('processing');
            $table->unsignedBigInteger('shipping_address_id')->nullable();
            $table->unsignedBigInteger('invoice_address_id')->nullable();
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('member');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
