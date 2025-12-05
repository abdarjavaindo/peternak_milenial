<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Kategori_kursus;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class KategoriKursusController extends Controller
{
    public function loaddata()
    {
        $data = Kategori_kursus::orderBy('id', 'desc')->get();
        return DataTables::of($data)
            ->addColumn('aksi', function ($data) {
                $editUrl = route('kategori-kursus.edit', $data->id);;
                $deleteForm = '<form method="POST" action="' . route('kategori-kursus.destroy', $data->id) . '" class="delete-form" style="display:inline;">
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
        return view('pages.dashboard.kategori-kursus.index');
    }

    public function create()
    {
        return view('pages.dashboard.kategori-kursus.form');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => ['required'],
        ]);
        Kategori_kursus::create([
            'nama_kategori' => $request->nama_kategori,
            'slug_kategori' => Str::slug($request->nama_kategori),
        ]);
        return redirect()->route('kategori-kursus')->with('sukses', 'Anda berhasil menambahkan data');
    }

    public function edit(Kategori_kursus $kategori_kursus)
    {
        return view('pages.dashboard.kategori-kursus.form', compact('kategori_kursus'));
    }
    public function update(Request $request, Kategori_kursus $kategori_kursus)
    {
        $request->validate([
            'nama_kategori' => ['required'],
            'slug_kategori' => ['required'],
        ]);
        $kategori_kursus->nama_kategori = $request->nama_kategori;
        $kategori_kursus->slug_kategori = $request->slug_kategori;
        $kategori_kursus->save();
        return redirect()->route('kategori-kursus')->with('sukses', 'Anda berhasil mengubah data');
    }

    public function destroy(Kategori_kursus $kategori_kursus)
    {
        $kategori_kursus->delete();
        return redirect()->route('kategori-kursus')->with('sukses', 'Anda berhasil menghapus data');
    }
}
