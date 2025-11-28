<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $data['produk'] = 'Produk';
        return view('pages.home.produk', $data);
    }

    public function detail()
    {
        $data['produk'] = 'Detail Produk';
        return view('pages.home.detail_produk', $data);
    }
}
