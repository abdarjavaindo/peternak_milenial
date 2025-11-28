<?php

namespace Database\Seeders;

use App\Models\Kategori_produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KategoriProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            'Daging Segar',
            'Olahan Daging',
            'Telur',
            'Produk Susu',
            'Olahan Susu',
            'Produk Non-Pangan',
            'Produk Lebah',
            'Pupuk & Limbah',
        ];

        foreach ($kategori as $item) {
            Kategori_produk::create([
                'nama_kategori' => $item,
                'slug_kategori' => Str::slug($item),
            ]);
        }
    }
}
