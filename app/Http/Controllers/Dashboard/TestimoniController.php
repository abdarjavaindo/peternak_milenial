<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TestimoniController extends Controller
{
    public function loaddata()
    {
        $data = Testimoni::orderBy('id', 'desc')->get();
        return DataTables::of($data)
            ->addColumn('aksi', function ($data) {
                $editUrl = route('testimoni.edit', $data->id);;
                $deleteForm = '<form method="POST" action="' . route('testimoni.destroy', $data->id) . '" class="delete-form" style="display:inline;">
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
        return view('pages.dashboard.testimoni.index');
    }

    public function create()
    {
        return view('pages.dashboard.testimoni.form');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required'],
            'jabatan' => ['required'],
            'testimoni' => ['required', 'string', 'min:50'],
            'gambar' => 'required|mimes:jpg,jpeg,png|max:11000'
        ]);
        $data = [
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'testimoni' => $request->testimoni,
        ];
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('testimoni', 'public');
        }
        Testimoni::create($data);
        return redirect()->route('testimoni')->with('sukses', 'Anda berhasil menambahkan data');
    }

    public function edit(Testimoni $testimoni)
    {
        return view('pages.dashboard.testimoni.form', compact('testimoni'));
    }
    public function update(Request $request, Testimoni $testimoni)
    {
        $request->validate([
            'nama' => ['required'],
            'jabatan' => ['required'],
            'testimoni' => ['required', 'string', 'min:50'],
            'gambar' => 'mimes:jpg,jpeg,png|max:11000'
        ]);
        $data = [
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'testimoni' => $request->testimoni,
        ];
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('testimoni', 'public');
        }
        Testimoni::where('id', $testimoni->id)->update($data);
        return redirect()->route('testimoni')->with('sukses', 'Anda berhasil mengubah data');
    }

    public function destroy(Testimoni $testimoni)
    {
        $testimoni->delete();
        return redirect()->route('testimoni')->with('sukses', 'Anda berhasil menghapus data');
    }
}
