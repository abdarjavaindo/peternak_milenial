<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Hewan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class HewanController extends Controller
{
    public function loaddata()
    {
        $data = Hewan::orderBy('id', 'desc')->get();
        return DataTables::of($data)
            ->addColumn('aksi', function ($data) {
                $editUrl = route('hewan.edit', $data->id);;
                $deleteForm = '<form method="POST" action="' . route('hewan.destroy', $data->id) . '" class="delete-form" style="display:inline;">
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
        return view('pages.dashboard.hewan.index');
    }

    public function create()
    {
        return view('pages.dashboard.hewan.form');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_hewan' => ['required'],
        ]);
        $data = [
            'nama_hewan' => $request->nama_hewan,
        ];
        Hewan::create($data);
        return redirect()->route('hewan')->with('sukses', 'Anda berhasil menambahkan data');
    }

    public function edit(Hewan $hewan)
    {
        return view('pages.dashboard.hewan.form', compact('hewan'));
    }
    public function update(Request $request, Hewan $hewan)
    {
        $request->validate([
            'nama_hewan' => ['required'],
        ]);
        $data = [
            'nama_hewan' => $request->nama_hewan,
        ];
        Hewan::where('id', $hewan->id)->update($data);
        return redirect()->route('hewan')->with('sukses', 'Anda berhasil mengubah data');
    }

    public function destroy(Hewan $hewan)
    {
        $hewan->delete();
        return redirect()->route('hewan')->with('sukses', 'Anda berhasil menghapus data');
    }
}
