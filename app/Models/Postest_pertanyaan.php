<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postest_pertanyaan extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public function materi()
    {
        return $this->belongsTo(KursusMateri::class, 'kursus_materi_id');
    }

    /**
     * Get answer options for this question
     */
    public function pilihans()
    {
        return $this->hasMany(Postest_pilihan_jawaban::class, 'postest_pertanyaan_id');
    }
}
