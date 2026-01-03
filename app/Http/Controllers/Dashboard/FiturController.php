<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Fitur;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FiturController extends Controller
{
    public function loaddata()
    {
        $data = Fitur::orderBy('id', 'desc')->get();
        return DataTables::of($data)
            ->addColumn('aksi', function ($data) {
                $editUrl = route('fitur.edit', $data->id);;
                $deleteForm = '<form method="POST" action="' . route('fitur.destroy', $data->id) . '" class="delete-form" style="display:inline;">
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
        return view('pages.dashboard.fitur.index');
    }

    public function create()
    {
        return view('pages.dashboard.fitur.form');
    }
    public function store(Request $request)
    {
        $request->validate([
            'judul' => ['required'],
            'deskripsi' => ['required'],
        ]);
        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ];
        Fitur::create($data);
        return redirect()->route('fitur')->with('sukses', 'Anda berhasil menambahkan data');
    }

    public function edit(Fitur $fitur)
    {
        return view('pages.dashboard.fitur.form', compact('fitur'));
    }
    public function update(Request $request, Fitur $fitur)
    {
        $request->validate([
            'judul' => ['required'],
            'deskripsi' => ['required'],
        ]);
        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ];
        Fitur::where('id', $fitur->id)->update($data);
        return redirect()->route('fitur')->with('sukses', 'Anda berhasil mengubah data');
    }

    public function destroy(Fitur $fitur)
    {
        $fitur->delete();
        return redirect()->route('fitur')->with('sukses', 'Anda berhasil menghapus data');
    }
}
