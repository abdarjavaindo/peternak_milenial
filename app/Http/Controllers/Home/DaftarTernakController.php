<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Kategori_produk;
use App\Models\User;
use App\Models\UserTernak;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DaftarTernakController extends Controller
{
    public function loaddata()
    {
        $data = UserTernak::with('kategori')->where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        return DataTables::of($data)
            ->addColumn('aksi', function ($data) {
                $editUrl = route('ternak.edit', $data->id);;
                $deleteForm = '<form method="POST" action="' . route('ternak.destroy', $data->id) . '" class="delete-form" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="button" class="btn btn-danger btn-sm delete-button mb-1">Hapus</button>
                    </form>';

                return $deleteForm . ' <a href="' . $editUrl . '" class="btn btn-sm btn-warning mb-1">Edit</a>';
            })
            ->addColumn('kategori', function ($data) {
                return $data->kategori->nama_kategori;
            })
            ->addIndexColumn()
            ->rawColumns(['aksi', 'kategori'])
            ->make(true);
    }
    public function index()
    {
        $ternak = UserTernak::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        return view('pages.home.ternak.index', compact('ternak'));
    }

    public function create()
    {
        $kategori_produk = Kategori_produk::get();
        return view('pages.home.ternak.form', compact('kategori_produk'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_ternak' => ['required'],
            'jumlah' => ['required'],
        ]);
        if (UserTernak::where(['user_id' => auth()->user()->id, 'nama_ternak' => $request->nama_ternak])->count() > 0) {
            return redirect()->route('ternak')->with('gagal', 'Anda sudah menginputkan hewan ini sebelumnya');
        }
        $kategori_produk = Kategori_produk::where('nama_kategori', $request->nama_ternak)->first();
        UserTernak::create([
            'user_id' => auth()->user()->id,
            'kategori_produk_id' => $kategori_produk->id,
            'nama_ternak' => $request->nama_ternak,
            'jumlah' => str_replace('.', '', $request->jumlah),
        ]);
        $this->hitungLevelUser(auth()->user());
        return redirect()->route('ternak')->with('sukses', 'Anda berhasil menambahkan data');
    }

    public function edit(UserTernak $ternak)
    {
        if (auth()->user()->id != $ternak->user_id) {
            return redirect()->route('ternak');
        }
        $kategori_produk = Kategori_produk::get();
        return view('pages.home.ternak.form', compact('kategori_produk', 'ternak'));
    }
    public function update(Request $request, UserTernak $ternak)
    {
        $request->validate([
            'jumlah' => ['required'],
        ]);
        UserTernak::where('id', $ternak->id)->update([
            'jumlah' => str_replace('.', '', $request->jumlah),
        ]);
        $this->hitungLevelUser(auth()->user());
        return redirect()->route('ternak')->with('sukses', 'Anda berhasil mengubah data');
    }

    public function destroy(UserTernak $ternak)
    {
        if ($ternak->user_id != auth()->user()->id) {
            return redirect()->route('ternak');
        }
        $ternak->delete();
        $this->hitungLevelUser(auth()->user());
        return redirect()->route('ternak')->with('sukses', 'Anda menghapus data');
    }
}
