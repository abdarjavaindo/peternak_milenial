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
}
