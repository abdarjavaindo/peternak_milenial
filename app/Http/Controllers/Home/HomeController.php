<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['title'] = "Home";
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
        return view('pages.home.galeri', $data);
    }
}
