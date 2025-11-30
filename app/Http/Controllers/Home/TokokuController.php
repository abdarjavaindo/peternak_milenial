<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Kategori_produk;
use App\Models\Produk;
use App\Models\ProdukGambar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TokokuController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->user()->id;

        // Ambil kategori berdasarkan produk milik user
        $kategori_produk  = DB::table('kategori_produks')
            ->join('produks', 'kategori_produks.id', '=', 'produks.kategori_produk_id')
            ->where('produks.user_id', $userId)
            ->select('kategori_produks.*')
            ->distinct()
            ->get();

        $search = $request->s; // keyword pencarian
        $slug = $request->slug; // kategori slug

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
            })
            ->where('produks.user_id', $userId);

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

        // --- Eksekusi query ---
        $produks = $query->select(
            'produks.*',
            'kategori_produks.*',
            'users.name',
            'produk_gambars.nama_file as thumbnail'
        )
        ->paginate(12) // <= pagination 12 produk per halaman
        ->withQueryString(); // supaya search & slug tidak hilang ketika pindah halaman

        return view('pages.home.toko.tokoku', [
            'kategori_produk' => $kategori_produk,
            'produks' => $produks,
            'current_kategori' => $current_kategori
        ]);
    }

    public function create()
    {
        $data['kategori_produk'] = Kategori_produk::orderBy('id', 'desc')->get();
        return view('pages.home.toko.tokoku_form', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => ['required'],
            'kategori_produk_id' => ['required'],
            'deskripsi' => ['required'],
            'harga' => ['required'],
            'stok' => ['required'],
            'satuan' => ['required'],
            'gambar.*' => 'required|mimes:jpg,jpeg,png|max:11000'
        ]);
        $data_produk = Produk::create([
            'user_id' => auth()->user()->id,
            'nama_produk' => $request->nama_produk,
            'slug' => Str::slug($request->nama_produk),
            'kategori_produk_id' => $request->kategori_produk_id,
            'deskripsi' => $request->deskripsi,
            'harga' => str_replace('.', '', $request->harga),
            'stok' => $request->stok,
            'satuan' => $request->satuan,
            'aktif' => 1,
        ]);
        if ($request->file('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $originalName = $file->getClientOriginalName();
                $safeName = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', pathinfo($originalName, PATHINFO_FILENAME));
                $extension = $file->getClientOriginalExtension();
                $finalName = $safeName . '_' . time() . '.' . $extension;
                $path = $file->storeAs('produk', $finalName, 'public');
                ProdukGambar::create([
                    'produk_id' => $data_produk->id,
                    'nama_file' => $finalName,
                ]);
            }
        }
        return redirect()->route('tokoku')->with('sukses', 'Anda berhasil menambahkan barang');
    }
}
