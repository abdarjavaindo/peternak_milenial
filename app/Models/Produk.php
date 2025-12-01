<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori_produk::class, 'kategori_produk_id');
    }

    public function gambar()
    {
        return $this->hasMany(ProdukGambar::class, 'produk_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
