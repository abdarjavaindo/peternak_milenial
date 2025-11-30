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
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->enum('level', ['pemula', 'menengah', 'ahli'])->default('pemula');
            $table->unsignedBigInteger('author_id')->nullable(); // user yang membuat course
            $table->integer('price')->default(0);
            $table->boolean('is_published')->default(false);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('kategori_kursuses')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
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
