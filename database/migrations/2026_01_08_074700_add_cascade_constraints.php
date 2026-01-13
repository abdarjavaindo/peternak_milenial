<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Check if a foreign key exists on a table
     */
    private function foreignKeyExists(string $table, string $column): bool
    {
        $database = config('database.connections.mysql.database');

        $result = DB::select("
            SELECT COUNT(*) as cnt 
            FROM information_schema.KEY_COLUMN_USAGE 
            WHERE TABLE_SCHEMA = ? 
            AND TABLE_NAME = ? 
            AND COLUMN_NAME = ? 
            AND REFERENCED_TABLE_NAME IS NOT NULL
        ", [$database, $table, $column]);

        return $result[0]->cnt > 0;
    }

    /**
     * Add ON DELETE CASCADE constraints for proper cleanup
     * Only adds FK if it doesn't already exist (safe for migrate:fresh)
     */
    public function up(): void
    {
        // kursus_progres already has cascade FK defined in create migration
        // Skip adding duplicate FK
        if (!$this->foreignKeyExists('kursus_progres', 'user_kursus_progres_id')) {
            Schema::table('kursus_progres', function (Blueprint $table) {
                $table->foreign('user_kursus_progres_id')
                    ->references('id')
                    ->on('user_kursus_progres')
                    ->onDelete('cascade');
            });
        }

        // user_postests FK is added by separate migration
        // Skip if already exists
        if (!$this->foreignKeyExists('user_postests', 'user_kursus_progres_id')) {
            Schema::table('user_postests', function (Blueprint $table) {
                $table->foreign('user_kursus_progres_id')
                    ->references('id')
                    ->on('user_kursus_progres')
                    ->onDelete('cascade');
            });
        }

        // user_postest_jawabans - add cascade if not exists
        if (!$this->foreignKeyExists('user_postest_jawabans', 'user_postest_id')) {
            Schema::table('user_postest_jawabans', function (Blueprint $table) {
                $table->foreign('user_postest_id')
                    ->references('id')
                    ->on('user_postests')
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse - no action needed since FKs may have been created elsewhere
     */
    public function down(): void
    {
        // Don't drop FKs here as they may be managed by other migrations
    }
};
