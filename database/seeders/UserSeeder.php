<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserTernak;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'admin',
                'password' => bcrypt('password'),
                'slug' => Str::slug('admin'),
                'status' => '1',
            ]
        );
        if (!$admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }

        $user = User::firstOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'user',
                'slug' => Str::slug('user 1234'),
                'no_telp' => '6289695615256',
                'nik' => '3573011001900001',
                'tgl_lahir' => '2000-07-04',
                'kabupaten' => 'Kabupaten Sidoarjo',
                'kecamatan' => 'Candi',
                'desa' => 'Kendalpecabean',
                'password' => bcrypt('password'),
                'status' => '1',
                'img_ktp' => 'ktp.jpg',
                'level' => 'pemula',
            ]
        );
        if (!$user->hasRole('user')) {
            $user->assignRole('user');
        }

        UserTernak::firstOrCreate(
            ['user_id' => $user->id, 'kategori_produk_id' => 1],
            ['nama_ternak' => 'Sapi Potong', 'jumlah' => '90']
        );
    }
}
