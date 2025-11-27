<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProdukController extends Controller
{
    public function loaddata()
    {
        $data = Produk::orderBy('id', 'desc')->get();
        return DataTables::of($data)
            ->addColumn('aksi', function ($data) {
                $editUrl = '#';
                $changeUrl = '#';
                $deleteForm = '<form method="POST" action="' . route('vendor.destroy', $data->id) . '" class="delete-form" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="button" class="btn btn-danger delete-button mb-1"><i class="fa fa-trash"></i></button>
                        </form>';

                return $deleteForm . ' <a href="' . $editUrl . '" class="btn btn-sm btn-warning mb-1 btn-icon"><i class="fa fa-edit"></i></a>';
            })
            ->addColumn('peternak', function ($data) {
                return 'Ramadhani';
            })
            ->addIndexColumn()
            ->rawColumns(['aksi', 'peternak'])
            ->make(true);
    }

    public function index()
    {
        return view('pages.vendor.vendor');
    }

    public function create()
    {
        return view('pages.vendor.vendor_form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => 'required',
            'nama_vendor' => 'required',
            'nama_direktur' => 'required',
            'npwp' => 'required',
            'no_rek_bank' => 'required',
            'bank' => 'required',
            'pemilik_no_rek' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
        ]);

        // $data = [
        //     'nama_fasilitas' => $request->nama_fasilitas,
        //     'kode_nomor' => $request->kode_nomor,
        //     'deskripsi' => $request->deskripsi,
        //     'alamat' => $request->alamat,
        //     'link_maps' => $request->link_maps,
        //     'kategori' => $request->kategori,
        //     'status' => $request->status,
        // ];

        Vendor::create($data);
        return redirect('vendor')->with('sukses', 'Anda berhasil menambahkan data vendor');
    }
}
