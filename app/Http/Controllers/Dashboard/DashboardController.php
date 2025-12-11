<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['pemula'] = User::where('level', 'pemula')->count();
        $data['menengah'] = User::where('level', 'menengah')->count();
        $data['ahli'] = User::where('level', 'ahli')->count();
        $data['semua_user'] = User::role('user')->count();

        $data['produk'] = Produk::count();
        $data['kursus'] = Kursus::count();
        return view('dashboard', $data);
    }
}
