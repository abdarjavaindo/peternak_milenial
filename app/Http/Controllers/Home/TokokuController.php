<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Kategori_produk;
use App\Models\Produk;
use App\Models\ProdukGambar;
use App\Models\UserTernak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TokokuController extends Controller
{
    public function index(Request $request)
    {
        return redirect()->route('shop.user', auth()->user()->slug);
    }

    public function create()
    {
        if (UserTernak::where('user_id', auth()->user()->id)->count() < 1) {
            return redirect()->route('ternak');
        }
        $data['kategori_produk'] = Kategori_produk::orderBy('id', 'desc')->get();
        return view('pages.home.toko.tokoku_form', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => ['required'],
            'kategori_produk_id' => ['required'],
            'deskripsi_singkat' => ['required'],
            'deskripsi' => ['required'],
            'harga' => ['required'],
            'stok' => ['required'],
            'satuan' => ['required'],
            'gambar.*' => 'required|mimes:jpg,jpeg,png|max:11000'
        ]);
        $data_produk = Produk::create([
            'user_id' => auth()->user()->id,
            'nama_produk' => $request->nama_produk,
            'slug' => $this->generateSlugWithRandom($request->nama_produk),
            'kategori_produk_id' => $request->kategori_produk_id,
            'deskripsi_singkat' => $request->deskripsi_singkat,
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
        return redirect()->route('shop.user', auth()->user()->slug)->with('sukses', 'Anda berhasil menambahkan barang');
    }

    public function destroy_gambar(ProdukGambar $produk_gambar)
    {
        if ($produk_gambar->produk->user_id != auth()->user()->id) {
            abort(404);
        }
        $produk_gambar->delete();
        return redirect()->back()->with('sukses', 'Anda berhasil menghapus gambar');
    }

    public function edit(Produk $produk)
    {
        if ($produk->user_id != auth()->user()->id) {
            abort(404);
        }
        $data['kategori_produk'] = Kategori_produk::orderBy('id', 'desc')->get();
        $data['produk'] = $produk;
        return view('pages.home.toko.tokoku_form', $data);
    }
    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama_produk' => ['required'],
            'kategori_produk_id' => ['required'],
            'deskripsi_singkat' => ['required'],
            'deskripsi' => ['required'],
            'harga' => ['required'],
            'stok' => ['required'],
            'satuan' => ['required'],
        ]);
        $produk->nama_produk = $request->nama_produk;
        $produk->kategori_produk_id = $request->kategori_produk_id;
        $produk->deskripsi_singkat = $request->deskripsi_singkat;
        $produk->deskripsi = $request->deskripsi;
        $produk->harga = str_replace('.', '', $request->harga);
        $produk->stok = $request->stok;
        $produk->satuan = $request->satuan;
        $produk->save();
        if ($request->file('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $originalName = $file->getClientOriginalName();
                $safeName = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', pathinfo($originalName, PATHINFO_FILENAME));
                $extension = $file->getClientOriginalExtension();
                $finalName = $safeName . '_' . time() . '.' . $extension;
                $path = $file->storeAs('produk', $finalName, 'public');
                ProdukGambar::create([
                    'produk_id' => $produk->id,
                    'nama_file' => $finalName,
                ]);
            }
        }
        return redirect()->route('shop.detail', $produk->slug)->with('sukses', 'Anda berhasil mengubah data');
    }

    public function destroy(Produk $produk)
    {
        if ($produk->user_id != auth()->user()->id) {
            abort(404);
        }
        $produk->delete();
        return redirect()->route('shop.user', auth()->user()->slug)->with('sukses', 'Anda berhasil menghapus data');
    }
}
