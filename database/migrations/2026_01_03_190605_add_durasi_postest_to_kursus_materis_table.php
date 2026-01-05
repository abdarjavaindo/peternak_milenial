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
        Schema::table('kursus_materis', function (Blueprint $table) {
            $table->string('durasi_postest')->nullable()->comment('Per menit');
            $table->string('nilai_lulus_postest')->nullable()->comment('KKM');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kursus_materis', function (Blueprint $table) {
            $table->dropColumn([
                'durasi_postest',
                'nilai_lulus_postest',
            ]);
        });
    }
};
