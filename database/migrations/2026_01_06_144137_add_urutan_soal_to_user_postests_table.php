<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_postests', function (Blueprint $table) {
            $table->json('urutan_soal')->nullable()->after('selesai_pada')
                ->comment('Shuffled question IDs order for this attempt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_postests', function (Blueprint $table) {
            $table->dropColumn('urutan_soal');
        });
    }
};
