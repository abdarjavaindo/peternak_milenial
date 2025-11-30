<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Kategori_produk;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class KategoriProdukController extends Controller
{
    public function loaddata()
    {
        $data = Kategori_produk::orderBy('id', 'desc')->get();
        return DataTables::of($data)
            ->addColumn('aksi', function ($data) {
                $editUrl = route('kategori-produk.edit', $data->id);;
                $deleteForm = '<form method="POST" action="' . route('kategori-produk.destroy', $data->id) . '" class="delete-form" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="button" class="btn btn-danger delete-button mb-1"><i class="fa fa-trash"></i></button>
                    </form>';

                return $deleteForm . ' <a href="' . $editUrl . '" class="btn btn-sm btn-warning mb-1 btn-icon"><i class="fa fa-edit"></i></a>';
            })
            ->addIndexColumn()
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function index()
    {
        return view('pages.dashboard.kategori-produk.index');
    }

    public function create()
    {
        return view('pages.dashboard.kategori-produk.form');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => ['required'],
        ]);
        Kategori_produk::create([
            'nama_kategori' => $request->nama_kategori,
            'slug_kategori' => Str::slug($request->nama_kategori),
        ]);
        return redirect()->route('kategori-produk')->with('sukses', 'Anda berhasil menambahkan data');
    }

    public function edit(Kategori_produk $kategori_produk)
    {
        return view('pages.dashboard.kategori-produk.form', compact('kategori_produk'));
    }
    public function update(Request $request, Kategori_produk $kategori_produk)
    {
        $request->validate([
            'nama_kategori' => ['required'],
            'slug_kategori' => ['required'],
        ]);
        $kategori_produk->nama_kategori = $request->nama_kategori;
        $kategori_produk->slug_kategori = $request->slug_kategori;
        $kategori_produk->save();
        return redirect()->route('kategori-produk')->with('sukses', 'Anda berhasil mengubah data');
    }

    public function destroy(Kategori_produk $kategori_produk)
    {
        $kategori_produk->delete();
        return redirect()->route('kategori-produk')->with('sukses', 'Anda berhasil menghapus data');
    }
}
