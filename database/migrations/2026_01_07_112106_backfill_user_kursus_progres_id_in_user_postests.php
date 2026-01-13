<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     * 
     * Backfills user_kursus_progres_id for existing user_postests records.
     */
    public function up(): void
    {
        // Skip if no records to backfill (fresh migration scenario)
        $needsBackfill = DB::table('user_postests')
            ->whereNull('user_kursus_progres_id')
            ->exists();

        if (!$needsBackfill) {
            return;
        }

        // Backfill user_kursus_progres_id for existing records
        DB::statement("
            UPDATE user_postests up
            SET user_kursus_progres_id = (
                SELECT ukp.id FROM user_kursus_progres ukp
                INNER JOIN kursus_materis km ON km.id = up.postest_id
                INNER JOIN kursus_bagians kb ON kb.id = km.kursus_bagian_id
                WHERE ukp.user_id = up.user_id AND ukp.kursus_id = kb.kursus_id
                LIMIT 1
            )
            WHERE up.user_kursus_progres_id IS NULL
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Optional: Reset to NULL (not typically needed)
        DB::table('user_postests')->update(['user_kursus_progres_id' => null]);
    }
};
