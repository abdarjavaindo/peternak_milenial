<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_postest extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'mulai_pada' => 'datetime',
        'selesai_pada' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function materi()
    {
        return $this->belongsTo(KursusMateri::class, 'postest_id');
    }

    public function jawabans()
    {
        return $this->hasMany(User_postest_jawaban::class, 'user_postest_id');
    }

    /**
     * Relationship to user's course enrollment for cascade delete
     * @since v1.2
     */
    public function userKursusProgres()
    {
        return $this->belongsTo(UserKursusProgres::class, 'user_kursus_progres_id');
    }

    /**
     * Alias for userKursusProgres - used by cleanup command
     */
    public function userProgress()
    {
        return $this->userKursusProgres();
    }

    /**
     * Check if timer has expired
     * Uses effective_duration if set, otherwise falls back to materi default
     */
    public function isExpired(): bool
    {
        if (!$this->mulai_pada || !$this->materi) {
            return false;
        }

        // Use effective_duration if set, otherwise fallback to materi duration
        $durasi = $this->effective_duration ?? (int) $this->materi->durasi_postest;
        if ($durasi <= 0) {
            return false;
        }

        $deadline = $this->mulai_pada->addMinutes($durasi);
        return now()->greaterThan($deadline);
    }

    /**
     * Get remaining time in seconds
     * Uses effective_duration if set, otherwise falls back to materi default
     * Returns large value (24 hours) if no duration is set (unlimited time)
     */
    public function getRemainingSeconds(): int
    {
        if (!$this->mulai_pada || !$this->materi) {
            return 86400; // Default to 24 hours if no data
        }

        // Use effective_duration if set, otherwise fallback to materi duration
        $durasi = $this->effective_duration ?? (int) $this->materi->durasi_postest;
        if ($durasi <= 0) {
            return 86400; // No time limit - default to 24 hours
        }

        $deadline = $this->mulai_pada->copy()->addMinutes($durasi);
        $remaining = now()->diffInSeconds($deadline, false);

        return max(0, $remaining);
    }
}
