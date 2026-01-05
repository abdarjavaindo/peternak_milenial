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
        Schema::create('postest_pilihan_jawabans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('postest_pertanyaan_id');
            $table->string('opsi')->nullable();
            $table->string('is_correct')->default('0')->comment('0:salah, 1:benar');
            $table->timestamps();

            $table->foreign('postest_pertanyaan_id')->references('id')->on('postest_pertanyaans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postest_pilihan_jawabans');
    }
};
