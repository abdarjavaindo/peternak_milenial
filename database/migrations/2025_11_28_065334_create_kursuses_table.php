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
        Schema::create('kursuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_kursus_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); // user yang membuat course
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->string('youtube')->nullable();
            $table->enum('level', ['pemula', 'menengah', 'ahli'])->default('pemula');
            $table->integer('harga')->default(0);
            $table->string('hari')->default(0);
            $table->boolean('is_published')->default(false);
            $table->unsignedBigInteger('pengajar_id')->nullable();
            $table->timestamps();

            $table->foreign('kategori_kursus_id')->references('id')->on('kategori_kursuses')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pengajar_id')->references('id')->on('pengajars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kursuses');
    }
};
