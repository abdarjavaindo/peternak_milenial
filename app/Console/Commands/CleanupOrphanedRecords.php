<?php

namespace App\Console\Commands;

use App\Models\KursusProgres;
use App\Models\User_postest;
use App\Models\User_postest_jawaban;
use App\Models\UserKursusProgres;
use Illuminate\Console\Command;

class CleanupOrphanedRecords extends Command
{
    protected $signature = 'cleanup:orphaned {--dry-run : Preview what would be deleted without actually deleting}';
    protected $description = 'Remove orphaned records from kursus_progres, user_postests, and user_postest_jawabans tables';

    public function handle()
    {
        $dryRun = $this->option('dry-run');
        $deletedCount = ['progress' => 0, 'postest' => 0, 'jawaban' => 0];

        $this->info('Scanning for orphaned records...');

        // 1. Find orphaned KursusProgres (no parent UserKursusProgres)
        $orphanedProgress = KursusProgres::whereDoesntHave('userProgres')->get();
        $deletedCount['progress'] = $orphanedProgress->count();

        if ($deletedCount['progress'] > 0) {
            $this->warn("Found {$deletedCount['progress']} orphaned KursusProgres records");
            if (!$dryRun) {
                KursusProgres::whereDoesntHave('userProgres')->delete();
                $this->info("✓ Deleted {$deletedCount['progress']} KursusProgres records");
            }
        }

        // 2. Find orphaned User_postest (no parent UserKursusProgres via FK)
        $orphanedPostests = User_postest::whereNotNull('user_kursus_progres_id')
            ->whereDoesntHave('userProgress')
            ->get();
        $deletedCount['postest'] = $orphanedPostests->count();

        if ($deletedCount['postest'] > 0) {
            $this->warn("Found {$deletedCount['postest']} orphaned User_postest records with FK");
            if (!$dryRun) {
                foreach ($orphanedPostests as $postest) {
                    $postest->jawabans()->delete();
                    $postest->delete();
                }
                $this->info("✓ Deleted {$deletedCount['postest']} User_postest records (with jawabans)");
            }
        }

        // 3. Find orphaned User_postest_jawaban (no parent User_postest)
        $orphanedJawabans = User_postest_jawaban::whereDoesntHave('userPostest')->get();
        $deletedCount['jawaban'] = $orphanedJawabans->count();

        if ($deletedCount['jawaban'] > 0) {
            $this->warn("Found {$deletedCount['jawaban']} orphaned User_postest_jawaban records");
            if (!$dryRun) {
                User_postest_jawaban::whereDoesntHave('userPostest')->delete();
                $this->info("✓ Deleted {$deletedCount['jawaban']} User_postest_jawaban records");
            }
        }

        // Summary
        $this->newLine();
        if ($dryRun) {
            $this->info('=== DRY RUN SUMMARY ===');
            $this->info("Would delete: {$deletedCount['progress']} KursusProgres, {$deletedCount['postest']} User_postest, {$deletedCount['jawaban']} User_postest_jawaban");
            $this->warn('Run without --dry-run to actually delete these records.');
        } else {
            $this->info('=== CLEANUP COMPLETE ===');
            $total = array_sum($deletedCount);
            $this->info("Total deleted: {$total} records");
        }

        return 0;
    }
}
