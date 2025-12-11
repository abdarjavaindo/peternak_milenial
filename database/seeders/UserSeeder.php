<?php

namespace Database\Seeders;

use App\Models\User;
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
            'slug' => Str::slug('admin')
        ]);
        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
            'nik' => '3573011001900001',
            'slug' => Str::slug('user 1234'),
            'no_telp' => '6289695615256',
            'kabupaten' => 'Kabupaten Sidoarjo',
            'kecamatan' => 'Candi',
            'desa' => 'Kendalpecabean',
            'tgl_lahir' => '2000-07-04',
        ]);
        $user->assignRole('user');
    }
}
