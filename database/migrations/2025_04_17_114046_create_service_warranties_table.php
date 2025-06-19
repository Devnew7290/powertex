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
        Schema::create('service_warranties', function (Blueprint $table) {
            $table->increments('swd_id');
            $table->text('swd_image')->nullable();
            $table->enum('swd_type', ['warranty', 'repair', 'transport', 'product'])->nullable()->comment('รูปประกัน, รูปสินค้าที่เสีย, รูปขนส่ง, สินค้าที่จะรับประกัน');
            $table->integer('swd_FK_id')->nullable()->comment('service->id หรือ warranties->id');
            $table->timestamps();
        });
    }
    protected $table = 'service_warranties';
    protected $primaryKey = 'swd_id';
    protected $fillable = [
        'swd_image',
        'swd_type',
        'swd_FK_id',
    ];

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_warranties');
    }
};
