<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * 
     * This migration:
     * 1. Removes duplicate user_postest records (keeps the latest one)
     * 2. Adds a UNIQUE index to prevent future duplicates
     */
    public function up(): void
    {
        // Step 1: Clean up duplicates - keep only the latest record per user+postest
        $duplicates = DB::table('user_postests')
            ->select('user_id', 'postest_id')
            ->groupBy('user_id', 'postest_id')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        foreach ($duplicates as $dup) {
            // Get all except the latest (highest ID)
            $latestId = DB::table('user_postests')
                ->where('user_id', $dup->user_id)
                ->where('postest_id', $dup->postest_id)
                ->orderBy('id', 'desc')
                ->value('id');

            // Delete old duplicates' jawabans first (foreign key)
            DB::table('user_postest_jawabans')
                ->whereIn('user_postest_id', function ($query) use ($dup, $latestId) {
                    $query->select('id')
                        ->from('user_postests')
                        ->where('user_id', $dup->user_id)
                        ->where('postest_id', $dup->postest_id)
                        ->where('id', '!=', $latestId);
                })
                ->delete();

            // Then delete old duplicates
            DB::table('user_postests')
                ->where('user_id', $dup->user_id)
                ->where('postest_id', $dup->postest_id)
                ->where('id', '!=', $latestId)
                ->delete();
        }

        // Step 2: Add unique index
        Schema::table('user_postests', function (Blueprint $table) {
            $table->unique(['user_id', 'postest_id'], 'user_postests_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();

        try {
            Schema::table('user_postests', function (Blueprint $table) {
                $table->dropUnique('user_postests_unique');
            });
        } catch (\Exception $e) {
            // Index might not exist or already dropped
        }

        Schema::enableForeignKeyConstraints();
    }
};
