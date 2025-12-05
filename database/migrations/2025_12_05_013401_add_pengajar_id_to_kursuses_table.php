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
        Schema::table('kursuses', function (Blueprint $table) {
            $table->unsignedBigInteger('pengajar_id')->nullable();
            $table->foreign('pengajar_id')->references('id')->on('pengajars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kursuses', function (Blueprint $table) {
            $table->dropColumn(['pengajar_id']);
        });
    }
};
