<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Fitur;
use App\Models\Galeri;
use App\Models\Kategori_produk;
use App\Models\Testimoni;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['title'] = "Home";
        $data['fitur'] = Fitur::count();
        $data['data_fitur'] = Fitur::orderBy('id', 'asc')->get();
        $data['data_testimoni'] = Testimoni::orderBy('id', 'desc')->get();

        // return view('pages.home.home', $data);
        return view('pages.home.home-new', $data);
    }

    public function kontak()
    {
        $data['title'] = "Kontak";
        // return view('pages.home.kontak', $data);
        return view('pages.home.kontak-new', $data);
    }

    public function galeri()
    {
        $data['title'] = "Galeri";
        $data['galeri'] = Galeri::orderBy('id', 'desc')->get();
        return view('pages.home.galeri', $data);
    }
}
