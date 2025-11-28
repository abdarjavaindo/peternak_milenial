<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['title'] = "Home";
        return view('pages.home.home', $data);
    }

    public function kontak()
    {
        $data['title'] = "Kontak";
        return view('pages.home.kontak', $data);
    }
}
