<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori_produk extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public function produks()
    {
        return $this->hasMany(Produk::class, 'kategori_produk_id');
    }

    public function hewan()
    {
        return $this->belongsTo(Hewan::class, 'hewan_id');
    }
}
