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
        Schema::create('kursus_progres', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('kursus_id')->nullable();
            $table->unsignedBigInteger('materi_id')->nullable();
            $table->unsignedBigInteger('user_kursus_progres_id')->nullable();
            $table->string('status')->default('progres')->comment("progres/selesai");
            $table->timestamp('selesai_pada')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kursus_id')->references('id')->on('kursuses')->onDelete('cascade');
            $table->foreign('materi_id')->references('id')->on('kursus_materis')->onDelete('cascade');
            $table->foreign('user_kursus_progres_id')->references('id')->on('user_kursus_progres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kursus_progres');
    }
};
