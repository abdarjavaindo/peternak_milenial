<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kursus extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pengajar()
    {
        return $this->belongsTo(Pengajar::class, 'pengajar_id');
    }

    public function bagian()
    {
        return $this->hasMany(KursusBagian::class, 'kursus_id');
    }

    // Relasi progres user
    public function progres()
    {
        return $this->hasMany(KursusProgres::class);
    }

    // Relasi ke kategori
    public function kategori()
    {
        return $this->belongsTo(KategoriKursus::class, 'kategori_kursus_id');
    }

    public function user_status()
    {
        return $this->hasOne(UserKursusProgres::class, 'kursus_id')->where('user_id', auth()->id());
    }

    /**
     * Relationship to get all enrolled users (peserta)
     */
    public function peserta()
    {
        return $this->hasMany(UserKursusProgres::class, 'kursus_id');
    }
}
