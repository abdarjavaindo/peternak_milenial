<?php

namespace App\Http\Controllers;

use App\Models\Pengadaan;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PengadaanController extends Controller
{
    public function loaddata()
    {
        $data = Pengadaan::with(['user', 'vendor'])->orderBy('id', 'desc')->get();
        return DataTables::of($data)
            ->addColumn('aksi', function ($data) {
                if (auth()->user()->hasRole('user')) {
                    $editUrl = route('vendor.edit', $data->id);
                    $changeUrl = route('vendor.change', $data->id);
                    $deleteForm = '<form method="POST" action="' . route('vendor.destroy', $data->id) . '" class="delete-form" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="button" class="btn btn-danger delete-button mb-1"><i class="fa fa-trash"></i></button>
                        </form>';

                    return $deleteForm . ' <a href="' . $editUrl . '" class="btn btn-sm btn-warning mb-1 btn-icon"><i class="fa fa-edit"></i></a>';
                } else {
                    return ' <a href="#" class="btn btn-sm btn-info mb-1 btn-icon"><i class="fa fa-eyes"></i></a>';
                }
            })
            ->addColumn('nama', function ($data) {
                return $data->user->name;
            })
            ->addColumn('nama_vendor', function ($data) {
                return $data->vendor->nama_vendor;
            })
            ->addIndexColumn()
            ->rawColumns(['nama', 'nama_vendor', 'aksi'])
            ->make(true);
    }

    public function index()
    {
        return view('pages.pengadaan.pengadaan');
    }

    public function create()
    {
        $data['data_vendor'] = Vendor::get();
        return view('pages.pengadaan.pengadaan_form', $data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'vendor_id' => ['required'],
            'tanggal' => ['required'],
            'nominal' => ['required'],
            'no_rek_belanja' => ['required'],
            'uraian' => ['required'],
        ]);

        Pengadaan::create([
            ...$data,
            'user_id' => auth()->user()->id,
            'nominal' => str_replace('.', '', $request->nominal)
        ]);
        return redirect('pengadaan')->with('sukses', 'Anda berhasil menambahkan data pengadaan');
    }
}
