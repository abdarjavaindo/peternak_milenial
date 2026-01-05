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
        Schema::create('user_postest_jawabans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_postest_id')->comment('hasil postest per user');
            $table->unsignedBigInteger('pertanyaan_id');
            $table->unsignedBigInteger('jawaban_id');
            $table->string('is_correct')->nullable()->comment('benar/salah');
            $table->timestamps();

            $table->foreign('user_postest_id')->references('id')->on('user_postests')->onDelete('cascade');
            $table->foreign('pertanyaan_id')->references('id')->on('postest_pertanyaans')->onDelete('cascade');
            $table->foreign('jawaban_id')->references('id')->on('postest_pilihan_jawabans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_postest_jawabans');
    }
};
