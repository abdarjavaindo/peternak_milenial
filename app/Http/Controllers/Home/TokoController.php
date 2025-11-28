<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    public function index()
    {
        $data['produk'] = 'Produk';
        return view('pages.home.toko.produk', $data);
    }

    public function detail()
    {
        $data['produk'] = 'Detail Produk';
        return view('pages.home.toko.detail_produk', $data);
    }
}
