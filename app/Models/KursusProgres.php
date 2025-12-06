<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KursusProgres extends Model
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

    public function materi()
    {
        return $this->belongsTo(KursusMateri::class, 'materi_id');
    }

    // Relasi ke progres utama user
    public function userProgres()
    {
        return $this->belongsTo(UserKursusProgres::class, 'user_kursus_progres_id');
    }
}
