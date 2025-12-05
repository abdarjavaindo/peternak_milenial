<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Pengajar;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PengajarController extends Controller
{
    public function loaddata()
    {
        $data = Pengajar::orderBy('id', 'desc')->get();
        return DataTables::of($data)
            ->addColumn('aksi', function ($data) {
                $editUrl = route('pengajar.edit', $data->id);;
                $deleteForm = '<form method="POST" action="' . route('pengajar.destroy', $data->id) . '" class="delete-form" style="display:inline;">
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
        return view('pages.dashboard.pengajar.index');
    }

    public function create()
    {
        return view('pages.dashboard.pengajar.form');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required'],
            'title' => ['required'],
            'gambar' => 'required|mimes:jpg,jpeg,png|max:11000'
        ]);
        $data = [
            'nama' => $request->nama,
            'title' => $request->title,
        ];
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('pengajar', 'public');
        }
        Pengajar::create($data);
        return redirect()->route('pengajar')->with('sukses', 'Anda berhasil menambahkan data');
    }

    public function edit(Pengajar $pengajar)
    {
        return view('pages.dashboard.pengajar.form', compact('pengajar'));
    }
    public function update(Request $request, Pengajar $pengajar)
    {
        $request->validate([
            'nama' => ['required'],
            'title' => ['required'],
            'gambar' => 'mimes:jpg,jpeg,png|max:11000'
        ]);
        $data = [
            'nama' => $request->nama,
            'title' => $request->title,
        ];
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('pengajar', 'public');
        }
        Pengajar::where('id', $pengajar->id)->update($data);
        return redirect()->route('pengajar')->with('sukses', 'Anda berhasil mengubah data');
    }

    public function destroy(Pengajar $pengajar)
    {
        $pengajar->delete();
        return redirect()->route('pengajar')->with('sukses', 'Anda berhasil menghapus data');
    }
}
