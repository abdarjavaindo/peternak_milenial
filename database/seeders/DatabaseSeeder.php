<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RolePermissionSeeder::class);
        $this->call(HewanSeeder::class);
        $this->call(KategoriProdukSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(KategoriKursusSeeder::class);
        $this->call(WilayahKomuditasSeeder::class);
        $this->call(PengaturanSeeder::class);
        $this->call(FiturSeeder::class);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
