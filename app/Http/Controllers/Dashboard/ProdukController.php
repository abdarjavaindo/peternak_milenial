<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Kategori_produk;
use App\Models\Produk;
use App\Models\ProdukGambar;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProdukController extends Controller
{
    public function loaddata()
    {
        $data = Produk::with(['user'])->orderBy('id', 'desc')->get();
        return DataTables::of($data)
            ->addColumn('aksi', function ($data) {
                $editUrl = route('produk.edit', $data->id);
                $changeUrl = route('produk.change', $data->id);
                $deleteForm = '<form method="POST" action="' . route('produk.destroy', $data->id) . '" class="delete-form" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="button" class="btn btn-danger delete-button mb-1"><i class="fa fa-trash"></i></button>
                        </form>';

                return $deleteForm . ' <a href="' . $editUrl . '" class="btn btn-sm btn-warning mb-1 btn-icon"><i class="fa fa-edit"></i></a>'
                . ' <a href="' . $changeUrl . '" class="badge bg-info text-white mb-1 btn-icon">change status</a>';
            })
            ->addColumn('peternak', function ($data) {
                return $data->user->name;
            })
            ->addColumn('status', function ($data) {
                if ($data->aktif == 1) {
                    return '<span class="text-success">Published</span>';
                }
                return '<span class="text-danger">Suspend</span>';
            })
            ->addIndexColumn()
            ->rawColumns(['aksi', 'peternak', 'status'])
            ->make(true);
    }
    public function index()
    {
        return view('pages.dashboard.produk.produk');
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('produk')->with('sukses', 'Anda berhasil menghapus data');
    }

    public function change(Produk $produk)
    {
        if ($produk->aktif == '1') {
            Produk::where('id', $produk->id)->update(['aktif' => 0]);
        } else {
            Produk::where('id', $produk->id)->update(['aktif' => 1]);
        }
        return redirect()->route('produk')->with('sukses', 'Anda berhasil memperbarui data');
    }

    public function edit(Produk $produk)
    {
        $data['kategori_produk'] = Kategori_produk::orderBy('id', 'desc')->get();
        $data['produk'] = $produk;
        return view('pages.dashboard.produk.produk_form', $data);
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
        return redirect()->back()->with('sukses', 'Anda berhasil mengubah data');
    }

    public function destroy_gambar(ProdukGambar $produk_gambar)
    {
        $produk_gambar->delete();
        return redirect()->back()->with('sukses', 'Anda berhasil menghapus gambar');
    }
}
