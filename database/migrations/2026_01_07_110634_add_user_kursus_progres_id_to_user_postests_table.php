<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * 
     * Adds FK to user_kursus_progres for cascade delete when admin deletes participation.
     * Column is nullable to preserve existing data without breaking changes.
     */
    public function up(): void
    {
        Schema::table('user_postests', function (Blueprint $table) {
            // Add nullable FK column - won't break existing data
            $table->unsignedBigInteger('user_kursus_progres_id')->nullable()->after('postest_id');

            // Add foreign key with cascade delete
            $table->foreign('user_kursus_progres_id')
                ->references('id')
                ->on('user_kursus_progres')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_postests', function (Blueprint $table) {
            $table->dropForeign(['user_kursus_progres_id']);
            $table->dropColumn('user_kursus_progres_id');
        });
    }
};
