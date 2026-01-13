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
        Hewan::firstOrCreate([
            // 1
            'nama_hewan' => 'Sapi'
        ]);
        Hewan::firstOrCreate([
            // 2
            'nama_hewan' => 'Kerbau'
        ]);
        Hewan::firstOrCreate([
            // 3
            'nama_hewan' => 'Kambing'
        ]);
        Hewan::firstOrCreate([
            // 4
            'nama_hewan' => 'Babi'
        ]);
        Hewan::firstOrCreate([
            // 5
            'nama_hewan' => 'Ayam'
        ]);
        Hewan::firstOrCreate([
            // 6
            'nama_hewan' => 'Burung'
        ]);
    }
}
