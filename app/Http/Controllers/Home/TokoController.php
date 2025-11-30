<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Kategori_produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TokoController extends Controller
{
    public function index(Request $request)
    {
        $kategori_produk = Kategori_produk::orderBy('id', 'desc')->get();
        $search = $request->s; // keyword pencarian
        $slug = $request->slug; // kategori slug
        $sort = $request->sort;

        $query = DB::table('produks')
            ->leftJoin('kategori_produks', 'produks.kategori_produk_id', '=', 'kategori_produks.id')
            ->leftJoin('users', 'produks.user_id', '=', 'users.id')
            ->leftJoin('produk_gambars', function ($join) {
                $join->on('produks.id', '=', 'produk_gambars.produk_id')
                    ->whereRaw('produk_gambars.id = (
                            SELECT id FROM produk_gambars
                            WHERE produk_id = produks.id
                            ORDER BY id ASC LIMIT 1
                            )');
            });

        // --- Jika slug ada → filter kategori ---
        $current_kategori = null;
        if ($slug) {
            $current_kategori = DB::table('kategori_produks')
                ->where('slug_kategori', $slug)
                ->first();
            if (!$current_kategori) {
                abort(404, 'Kategori tidak ditemukan.');
            }
            $query->where('produks.kategori_produk_id', $current_kategori->id);
        }

        // --- Jika ada keyword pencarian ---
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('produks.nama_produk', 'like', "%$search%")
                    ->orWhere('produks.harga', 'like', "%$search%");
            });
        }

        // SORTING
        if ($sort == 'terbaru') {
            $query->orderBy('produks.created_at', 'DESC');
        } elseif ($sort == 'harga_desc') {
            $query->orderBy('produks.harga', 'DESC');
        } elseif ($sort == 'harga_asc') {
            $query->orderBy('produks.harga', 'ASC');
        }

        // --- Eksekusi query ---
        $produks = $query->select(
            'produks.*',
            'kategori_produks.*',
            'users.name',
            'produk_gambars.nama_file as thumbnail'
        )
            ->paginate(12) // <= pagination 12 produk per halaman
            ->withQueryString(); // supaya search & slug tidak hilang ketika pindah halaman

        return view('pages.home.toko.produk', [
            'kategori_produk' => $kategori_produk,
            'produks' => $produks,
            'current_kategori' => $current_kategori
        ]);
    }

    public function detail($slug)
    {
        $data['produk'] = 'Detail Produk';
        return view('pages.home.toko.detail_produk', $data);
    }
}
