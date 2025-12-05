<?php

namespace Database\Seeders;

use App\Models\Kategori_kursus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KategoriKursusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            'Kursus Online',
            'Kursus Offline',
        ];

        foreach ($kategori as $item) {
            Kategori_kursus::create([
                'nama_kategori' => $item,
                'slug_kategori' => Str::slug($item),
            ]);
        }
    }
}
