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
        Schema::create('pengaturans', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->string('slogan')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('instansi')->nullable();
            $table->string('keyword')->nullable();
            $table->string('logo')->nullable();
            $table->string('ikon')->nullable();
            $table->string('slider')->nullable();
            $table->string('img_fitur')->nullable();

            // untuk kontak
            $table->string('no_telp')->nullable();
            $table->string('email')->nullable();
            $table->string('hari_oprasional')->nullable();
            $table->string('jam_oprasional')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('link_maps')->nullable();
            $table->text('iframe_maps')->nullable();
            $table->string('fb')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('ig')->nullable();
            $table->string('tiktok')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturans');
    }
};
