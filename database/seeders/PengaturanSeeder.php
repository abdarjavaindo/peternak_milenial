<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengaturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pengaturan::firstOrCreate(
            ['judul' => 'Peternak Milenial & Gen Z'],
            [
                'slogan' => 'Sinergi Membangun Negeri, "Nawabaktisatya", "Jer basuki mawa beya"',
                'deskripsi' => "Peternak Milenial adalah aplikasi digital yang dirancang untuk mendukung peternak modern dalam mengelola usaha secara lebih cerdas dan efisien. Melalui satu platform terintegrasi, peternak dapat mengakses marketplace, pelatihan, serta forum diskusi untuk meningkatkan produktivitas dan daya saing.",
                'instansi' => 'Dinas Peternakan Provinsi Jawa Timur',
                'keyword' => 'disnak, jawa timur, peternak',
                'logo' => 'pengaturan/EFkguE8Oo4hFBNKBCnbdBLOWw89PLFYM8mwKSIA4.png',
                'ikon' => 'pengaturan/5BdlyDvHwBqTuNXf243VmlQDik70aKd0rCpBRdwn.png',
                'slider' => 'pengaturan/vGzw5Whh9U1NVLjoeFZ42xkaFV5VKSk1gCyY64ZT.jpg',
                'img_fitur' => 'pengaturan/3uBejS8wDdcDnJRuqlP9DZsTVIhud6gFy9N0ntXX.png',
                'no_telp' => '0318292545',
                'email' => 'disnak@jatimprov.go.id',
                'hari_oprasional' => 'Senin - Jumat',
                'jam_oprasional' => '08:00 - 16:00',
                'lokasi' => 'Jl. Ahmad Yani No.202, Surabaya, Jawa Timur 60235',
                'link_maps' => 'https://maps.app.goo.gl/hoRT439X1qbveLLB8',
                'iframe_maps' => '<iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.1867983740462!2d112.7297632!3d-7.3329070000000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb63a8b86057%3A0x393ac895d4783754!2sDinas%20Peternakan%20Provinsi%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1766029240208!5m2!1sid!2sid"
                                style="border:0" allowfullscreen></iframe>',
                'fb' => 'https://www.facebook.com/',
                'twitter' => 'https://x.com/',
                'youtube' => 'https://www.youtube.com/',
                'ig' => 'https://www.instagram.com/',
                'tiktok' => 'https://www.tiktok.com/',
            ]
        );
    }
}
