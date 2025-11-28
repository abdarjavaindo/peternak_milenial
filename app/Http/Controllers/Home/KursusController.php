<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use Illuminate\Http\Request;

class KursusController extends Controller
{
    public function index()
    {
        $data['pelatihan'] = Kursus::where('is_published', 1)->get();
        return view('pages.home.kursus.index', $data);
    }

    public function detail()
    {
        $data['title'] = 'Detail Pelatihan';
        return view('pages.home.kursus.detail', $data);
    }
}
