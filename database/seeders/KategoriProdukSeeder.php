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
        Kategori_produk::firstOrCreate(
            ['slug_kategori' => Str::slug("Sapi Potong")],
            ['hewan_id' => 1, 'nama_kategori' => "Sapi Potong"]
        );
        Kategori_produk::firstOrCreate(
            ['slug_kategori' => Str::slug("Sapi Perah")],
            ['hewan_id' => 1, 'nama_kategori' => "Sapi Perah"]
        );
        Kategori_produk::firstOrCreate(
            ['slug_kategori' => Str::slug("Kerbau")],
            ['hewan_id' => 2, 'nama_kategori' => "Kerbau"]
        );
        Kategori_produk::firstOrCreate(
            ['slug_kategori' => Str::slug("Domba/Kambing")],
            ['hewan_id' => 3, 'nama_kategori' => "Domba/Kambing"]
        );
        Kategori_produk::firstOrCreate(
            ['slug_kategori' => Str::slug("Babi")],
            ['hewan_id' => 4, 'nama_kategori' => "Babi"]
        );
        Kategori_produk::firstOrCreate(
            ['slug_kategori' => Str::slug("Ayam Petelur")],
            ['hewan_id' => 5, 'nama_kategori' => "Ayam Petelur"]
        );
        Kategori_produk::firstOrCreate(
            ['slug_kategori' => Str::slug("Ayam Pedaging")],
            ['hewan_id' => 5, 'nama_kategori' => "Ayam Pedaging"]
        );
        Kategori_produk::firstOrCreate(
            ['slug_kategori' => Str::slug("Burung Puyuh")],
            ['hewan_id' => 6, 'nama_kategori' => "Burung Puyuh"]
        );
    }
}
