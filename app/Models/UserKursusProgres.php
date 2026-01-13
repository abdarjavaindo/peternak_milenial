<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserKursusProgres extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke kursus
    public function kursus()
    {
        return $this->belongsTo(Kursus::class);
    }

    // Relasi ke user_postest
    public function user_postest()
    {
        return $this->belongsTo(User_postest::class);
    }

    // Relasi ke detail progres (materi-materi)
    public function progresMateri()
    {
        return $this->hasMany(KursusProgres::class, 'user_kursus_progres_id');
    }
}
