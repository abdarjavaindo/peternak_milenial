<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class GaleriController extends Controller
{
    public function loaddata()
    {
        $data = Galeri::orderBy('id', 'desc')->get();
        return DataTables::of($data)
            ->addColumn('aksi', function ($data) {
                $editUrl = route('galeri.edit', $data->id);;
                $deleteForm = '<form method="POST" action="' . route('galeri.destroy', $data->id) . '" class="delete-form" style="display:inline;">
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
        return view('pages.dashboard.galeri.index');
    }

    public function create()
    {
        return view('pages.dashboard.galeri.form');
    }
    public function store(Request $request)
    {
        $request->validate([
            'judul' => ['required'],
            'gambar' => 'required|mimes:jpg,jpeg,png|max:11000'
        ]);
        $data = [
            'judul' => $request->judul,
        ];
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('galeri', 'public');
        }
        Galeri::create($data);
        return redirect()->route('galeri')->with('sukses', 'Anda berhasil menambahkan data');
    }

    public function edit(Galeri $galeri)
    {
        return view('pages.dashboard.galeri.form', compact('galeri'));
    }
    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'judul' => ['required'],
            'gambar' => 'mimes:jpg,jpeg,png|max:11000'
        ]);
        $data = [
            'judul' => $request->judul,
        ];
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('galeri', 'public');
        }
        Galeri::where('id', $galeri->id)->update($data);
        return redirect()->route('galeri')->with('sukses', 'Anda berhasil mengubah data');
    }

    public function destroy(Galeri $galeri)
    {
        $galeri->delete();
        return redirect()->route('galeri')->with('sukses', 'Anda berhasil menghapus data');
    }
}
