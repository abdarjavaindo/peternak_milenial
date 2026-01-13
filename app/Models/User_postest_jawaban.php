<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_postest_jawaban extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public function userPostest()
    {
        return $this->belongsTo(User_postest::class, 'user_postest_id');
    }

    public function pertanyaan()
    {
        return $this->belongsTo(Postest_pertanyaan::class, 'pertanyaan_id');
    }

    public function jawaban()
    {
        return $this->belongsTo(Postest_pilihan_jawaban::class, 'jawaban_id');
    }
}
