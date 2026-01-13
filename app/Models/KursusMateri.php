<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KursusMateri extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public function bagian()
    {
        return $this->belongsTo(KursusBagian::class, 'kursus_bagian_id');
    }

    public function progres()
    {
        return $this->belongsTo(KursusProgres::class, 'materi_id');
    }

    /**
     * Get postest questions for this materi
     */
    public function pertanyaans()
    {
        return $this->hasMany(Postest_pertanyaan::class, 'kursus_materi_id');
    }

    /**
     * Check if this materi is a postest type
     */
    public function isPostest(): bool
    {
        return $this->jenis === 'postest';
    }
}
