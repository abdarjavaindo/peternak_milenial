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
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'slug' => Str::slug('admin'),
            'status' => '1',
        ]);
        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'user',
            'slug' => Str::slug('user 1234'),
            'email' => 'user@gmail.com',
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
        ]);
        $user->assignRole('user');

        UserTernak::create([
            'user_id' => $user->id,
            'kategori_produk_id' => 1,
            'nama_ternak' => 'Sapi Potong',
            'jumlah' => '90',
        ]);
    }
}
