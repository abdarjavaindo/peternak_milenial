<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * 
     * Adds effective_duration column to store the actual postest duration
     * which may be truncated based on remaining training time.
     */
    public function up(): void
    {
        Schema::table('user_postests', function (Blueprint $table) {
            $table->integer('effective_duration')->nullable()->after('urutan_soal')
                ->comment('Actual postest duration in minutes, may differ from materi default');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_postests', function (Blueprint $table) {
            $table->dropColumn('effective_duration');
        });
    }
};
