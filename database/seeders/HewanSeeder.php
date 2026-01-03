<?php

namespace Database\Seeders;

use App\Models\Hewan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HewanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hewan::create([
            // 1
            'nama_hewan' => 'Sapi'
        ]);
        Hewan::create([
            // 2
            'nama_hewan' => 'Kerbau'
        ]);
        Hewan::create([
            // 3
            'nama_hewan' => 'Kambing'
        ]);
        Hewan::create([
            // 4
            'nama_hewan' => 'Babi'
        ]);
        Hewan::create([
            // 5
            'nama_hewan' => 'Ayam'
        ]);
        Hewan::create([
            // 6
            'nama_hewan' => 'Burung'
        ]);
    }
}
