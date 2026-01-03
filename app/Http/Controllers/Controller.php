<?php

namespace App\Http\Controllers;

use App\Models\Kategori_produk;
use App\Models\Pengaturan;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $webdata = Pengaturan::first();
        $data['set_judul'] = @$webdata->judul;
        $data['set_slogan'] = @$webdata->slogan;
        $data['set_deskripsi'] = @$webdata->deskripsi;
        $data['set_instansi'] = @$webdata->instansi;
        $data['set_keyword'] = @$webdata->keyword;
        $data['set_logo'] = @$webdata->logo;
        $data['set_ikon'] = @$webdata->ikon;
        $data['set_slider'] = @$webdata->slider;
        $data['set_img_fitur'] = @$webdata->img_fitur;
        $data['set_no_telp'] = @$webdata->no_telp;
        $data['set_email'] = @$webdata->email;
        $data['set_hari_oprasional'] = @$webdata->hari_oprasional;
        $data['set_jam_oprasional'] = @$webdata->jam_oprasional;
        $data['set_lokasi'] = @$webdata->lokasi;
        $data['set_link_maps'] = @$webdata->link_maps;
        $data['set_iframe_maps'] = @$webdata->iframe_maps;
        $data['set_fb'] = @$webdata->fb;
        $data['set_twitter'] = @$webdata->twitter;
        $data['set_youtube'] = @$webdata->youtube;
        $data['set_ig'] = @$webdata->ig;
        $data['set_tiktok'] = @$webdata->tiktok;

        $data['set_inaugurasi'] = User::role('user')->count();
        $data['set_aktif'] = User::role('user')->where('status', 1)->count();
        $data['set_komuditas'] = Kategori_produk::count();
        view()->share($data);
    }

    public function generateSlugWithRandom($nama, $number = null)
    {
        // slug dasar dari nama produk
        $slug = Str::slug($nama);
        // karakter random (huruf besar + angka)
        if ($number) {
            $random = strtoupper(Str::random($number));
        } else {
            $random = strtoupper(Str::random(6));
        }
        return $slug . '-' . $random;
    }

    public function hitungLevelUser(User $user)
    {
        // Ambil seluruh ternak milik user
        $ternaks = $user->ternak; // pastikan relasi: User hasMany Ternak
        $total = 0;
        foreach ($ternaks as $t) {
            $jenis = $t->nama_ternak;
            $jumlah = $t->jumlah;
            switch ($jenis) {
                case 'Sapi Potong':
                    if ($jumlah >= 100) $total += 3;
                    elseif ($jumlah >= 5) $total += 2;
                    elseif ($jumlah >= 1) $total += 1;
                    break;
                case 'Sapi Perah':
                    if ($jumlah >= 20) $total += 3;
                    elseif ($jumlah >= 5) $total += 2;
                    elseif ($jumlah >= 1) $total += 1;
                    break;
                case 'Kerbau':
                    if ($jumlah >= 75) $total += 3;
                    elseif ($jumlah >= 5) $total += 2;
                    elseif ($jumlah >= 1) $total += 1;
                    break;
                case 'Kambing':
                case 'Domba':
                    if ($jumlah >= 300) $total += 3;
                    elseif ($jumlah >= 15) $total += 2;
                    elseif ($jumlah >= 1) $total += 1;
                    break;
                case 'Babi':
                    if ($jumlah >= 125) $total += 3;
                    elseif ($jumlah >= 5) $total += 2;
                    elseif ($jumlah >= 1) $total += 1;
                    break;
                case 'Ayam Petelur':
                    if ($jumlah >= 10000) $total += 3;
                    elseif ($jumlah >= 100) $total += 2;
                    elseif ($jumlah >= 1) $total += 1;
                    break;
                case 'Ayam Pedaging':
                    if ($jumlah >= 15000) $total += 3;
                    elseif ($jumlah >= 100) $total += 2;
                    elseif ($jumlah >= 1) $total += 1;
                    break;
                case 'Burung Puyuh':
                    if ($jumlah >= 25000) $total += 3;
                    elseif ($jumlah >= 5000) $total += 2;
                    elseif ($jumlah >= 1) $total += 1;
                    break;
            }
        }
        // Tentukan level berdasarkan total skor
        if ($total >= 3) {
            $level = 'ahli';
        } elseif ($total == 2) {
            $level = 'menengah';
        } else {
            $level = 'pemula';
        }
        // Update ke database
        $user->update([
            'level' => $level,
        ]);
    }
}
