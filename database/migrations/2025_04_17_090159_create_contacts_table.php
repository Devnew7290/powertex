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
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('contacts_id');
            $table->text('contacts_map')->nullable()->comment('google map');
            $table->string('contacts_address', 255)->nullable();
            $table->string('contacts_phone', 255)->nullable();
            $table->string('contacts_fax', 255)->nullable();
            $table->string('contacts_email', 255)->nullable();
            $table->text('contacts_facebook')->nullable();
            $table->text('contacts_line')->nullable();
            $table->text('contacts_ig')->nullable();
            $table->text('contacts_yt')->nullable();
            $table->text('contacts_tiktok')->nullable();
            $table->text('contacts_twitter')->nullable();
            $table->text('contacts_keyword')->nullable();
            $table->text('contacts_description')->nullable();
            $table->text('contacts_url')->nullable();
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
        Schema::dropIfExists('contacts');
    }
};
