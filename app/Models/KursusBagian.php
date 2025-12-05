<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KursusBagian extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public function kursus()
    {
        return $this->belongsTo(Kursus::class);
    }

    public function materi()
    {
        return $this->hasMany(KursusMateri::class, 'kursus_bagian_id');
    }
}
