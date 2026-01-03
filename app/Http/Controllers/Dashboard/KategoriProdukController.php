<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Hewan;
use App\Models\Kategori_produk;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class KategoriProdukController extends Controller
{
    public function loaddata()
    {
        $data = Kategori_produk::with('hewan')->orderBy('id', 'desc')->get();
        return DataTables::of($data)
            ->addColumn('aksi', function ($data) {
                $editUrl = route('kategori-produk.edit', $data->id);
                $deleteForm = '<form method="POST" action="' . route('kategori-produk.destroy', $data->id) . '" class="delete-form" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="button" class="btn btn-danger delete-button mb-1"><i class="fa fa-trash"></i></button>
                    </form>';

                return $deleteForm . ' <a href="' . $editUrl . '" class="btn btn-sm btn-warning mb-1 btn-icon"><i class="fa fa-edit"></i></a>';
            })
            ->addColumn('hewan', function ($data) {
                return $data->hewan->nama_hewan;
            })
            ->addIndexColumn()
            ->rawColumns(['aksi', 'hewan'])
            ->make(true);
    }
    public function index()
    {
        return view('pages.dashboard.kategori-produk.index');
    }

    public function create()
    {
        $hewan = Hewan::get();
        return view('pages.dashboard.kategori-produk.form', compact('hewan'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'hewan_id' => ['required'],
            'nama_kategori' => ['required'],
            'ikon_komuditas' => 'mimes:jpg,jpeg,png|max:11000'
        ]);
        $data_kategori_produk = Kategori_produk::where('slug_kategori', Str::slug($request->nama_kategori))->first();
        if ($data_kategori_produk) {
            return redirect()->route('kategori-produk')->with('gagal', 'Slug atau nama komuditas sudah ada');
        }
        $data = [
            'hewan_id' => $request->hewan_id,
            'nama_kategori' => $request->nama_kategori,
            'slug_kategori' => Str::slug($request->nama_kategori),
        ];
        if ($request->hasFile('ikon_komuditas')) {
            $data['ikon_komuditas'] = $request->file('ikon_komuditas')->store('komuditas', 'public');
        }
        Kategori_produk::create($data);
        return redirect()->route('kategori-produk')->with('sukses', 'Anda berhasil menambahkan data');
    }

    public function edit(Kategori_produk $kategori_produk)
    {
        $hewan = Hewan::get();
        return view('pages.dashboard.kategori-produk.form', compact('kategori_produk', 'hewan'));
    }
    public function update(Request $request, Kategori_produk $kategori_produk)
    {
        $request->validate([
            'hewan_id' => ['required'],
            'nama_kategori' => ['required'],
            'ikon_komuditas' => 'mimes:jpg,jpeg,png|max:11000',
            'slug_kategori' => [Rule::unique(Kategori_produk::class, 'slug_kategori')->ignore($kategori_produk->id)],
        ]);
        $kategori_produk->hewan_id = $request->hewan_id;
        $kategori_produk->nama_kategori = $request->nama_kategori;
        $kategori_produk->slug_kategori = $request->slug_kategori;
        if ($request->hasFile('ikon_komuditas')) {
            $kategori_produk->ikon_komuditas = $request->file('ikon_komuditas')->store('komuditas', 'public');
        }
        $kategori_produk->save();
        return redirect()->route('kategori-produk')->with('sukses', 'Anda berhasil mengubah data');
    }

    public function destroy(Kategori_produk $kategori_produk)
    {
        $kategori_produk->delete();
        return redirect()->route('kategori-produk')->with('sukses', 'Anda berhasil menghapus data');
    }
}
