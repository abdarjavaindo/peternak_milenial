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
        Schema::create('kursus_materis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kursus_bagian_id')->nullable();
            $table->string('judul')->nullable();
            $table->longText('konten')->nullable();
            $table->string('jenis')->default('materi')->comment('materi/postest');
            $table->timestamps();

            $table->foreign('kursus_bagian_id')->references('id')->on('kursus_bagians')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kursus_materis');
    }
};
