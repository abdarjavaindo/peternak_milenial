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
        Schema::create('postest_pertanyaans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kursus_materi_id');
            $table->longText('pertanyaan');
            $table->timestamps();

            $table->foreign('kursus_materi_id')->references('id')->on('kursus_materis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postest_pertanyaans');
    }
};
