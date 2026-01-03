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
        Kategori_produk::create([
            'hewan_id' => 1,
            'nama_kategori' => "Sapi Potong",
            'slug_kategori' => Str::slug("Sapi Potong"),
        ]);
        Kategori_produk::create([
            'hewan_id' => 1,
            'nama_kategori' => "Sapi Perah",
            'slug_kategori' => Str::slug("Sapi Perah"),
        ]);
        Kategori_produk::create([
            'hewan_id' => 2,
            'nama_kategori' => "Kerbau",
            'slug_kategori' => Str::slug("Kerbau"),
        ]);
        Kategori_produk::create([
            'hewan_id' => 3,
            'nama_kategori' => "Domba/Kambing",
            'slug_kategori' => Str::slug("Domba/Kambing"),
        ]);
        Kategori_produk::create([
            'hewan_id' => 4,
            'nama_kategori' => "Babi",
            'slug_kategori' => Str::slug("Babi"),
        ]);
        Kategori_produk::create([
            'hewan_id' => 5,
            'nama_kategori' => "Ayam Petelur",
            'slug_kategori' => Str::slug("Ayam Petelur"),
        ]);
        Kategori_produk::create([
            'hewan_id' => 5,
            'nama_kategori' => "Ayam Pedaging",
            'slug_kategori' => Str::slug("Ayam Pedaging"),
        ]);
        Kategori_produk::create([
            'hewan_id' => 6,
            'nama_kategori' => "Burung Puyuh",
            'slug_kategori' => Str::slug("Burung Puyuh"),
        ]);
    }
}
