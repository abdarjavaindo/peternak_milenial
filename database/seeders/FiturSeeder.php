<?php

namespace Database\Seeders;

use App\Models\Fitur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FiturSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fitur::create([
            'judul' => 'Marketplace',
            'deskripsi' => 'Tempat jual beli kebutuhan peternak terpercaya Mudah, aman, dan terjangkau untuk semua peternak'
        ]);
        Fitur::create([
            'judul' => 'Pelatihan',
            'deskripsi' => 'Tingkatkan skill beternak bersama ahli berpengalaman Belajar praktis, modern, dan sesuai kebutuhan peternak'
        ]);
        Fitur::create([
            'judul' => 'Forum Peternak',
            'deskripsi' => 'Ruang diskusi, berbagi pengalaman sesama peternak Solusi masalah ternak dari peternak untuk peternak'
        ]);
    }
}
