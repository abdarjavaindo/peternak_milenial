<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postest_pilihan_jawaban extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public function pertanyaan()
    {
        return $this->belongsTo(Postest_pertanyaan::class, 'postest_pertanyaan_id');
    }
}
