<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Kategori_produk;
use App\Models\User;
use App\Models\UserTernak;
use App\Models\WilayahKomuditas;
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

        $wilayah_komuditas = WilayahKomuditas::where('kabupaten', auth()->user()->kabupaten)->first();
        if ($kategori_produk->id == '1') {
            $wilayah_komuditas->jml_sapi_potong = $wilayah_komuditas->jml_sapi_potong + str_replace('.', '', $request->jumlah);
        }
        if ($kategori_produk->id == '2') {
            $wilayah_komuditas->jml_sapi_perah = $wilayah_komuditas->jml_sapi_perah + str_replace('.', '', $request->jumlah);
        }
        if ($kategori_produk->id == '3') {
            $wilayah_komuditas->jml_kerbau = $wilayah_komuditas->jml_kerbau + str_replace('.', '', $request->jumlah);
        }
        if ($kategori_produk->id == '4') {
            $wilayah_komuditas->jml_dombakambing = $wilayah_komuditas->jml_dombakambing + str_replace('.', '', $request->jumlah);
        }
        if ($kategori_produk->id == '5') {
            $wilayah_komuditas->jml_babi = $wilayah_komuditas->jml_babi + str_replace('.', '', $request->jumlah);
        }
        if ($kategori_produk->id == '6') {
            $wilayah_komuditas->jml_ayam_petelur = $wilayah_komuditas->jml_ayam_petelur + str_replace('.', '', $request->jumlah);
        }
        if ($kategori_produk->id == '7') {
            $wilayah_komuditas->jml_ayam_pedaging = $wilayah_komuditas->jml_ayam_pedaging + str_replace('.', '', $request->jumlah);
        }
        if ($kategori_produk->id == '8') {
            $wilayah_komuditas->jml_burung_puyuh = $wilayah_komuditas->jml_burung_puyuh + str_replace('.', '', $request->jumlah);
        }
        $wilayah_komuditas->save();

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
        $wilayah_komuditas = WilayahKomuditas::where('kabupaten', auth()->user()->kabupaten)->first();
        if ($wilayah_komuditas) {
            if ($ternak->kategori_produk_id == '1') {
                $wilayah_komuditas->jml_sapi_potong = $wilayah_komuditas->jml_sapi_potong - $ternak->jumlah;
                $wilayah_komuditas->jml_sapi_potong = $wilayah_komuditas->jml_sapi_potong + $request->jumlah;
            }
            if ($ternak->kategori_produk_id == '2') {
                $wilayah_komuditas->jml_sapi_perah = $wilayah_komuditas->jml_sapi_perah - $ternak->jumlah;
                $wilayah_komuditas->jml_sapi_perah = $wilayah_komuditas->jml_sapi_perah + $request->jumlah;
            }
            if ($ternak->kategori_produk_id == '3') {
                $wilayah_komuditas->jml_kerbau = $wilayah_komuditas->jml_kerbau - $ternak->jumlah;
                $wilayah_komuditas->jml_kerbau = $wilayah_komuditas->jml_kerbau + $request->jumlah;
            }
            if ($ternak->kategori_produk_id == '4') {
                $wilayah_komuditas->jml_dombakambing = $wilayah_komuditas->jml_dombakambing - $ternak->jumlah;
                $wilayah_komuditas->jml_dombakambing = $wilayah_komuditas->jml_dombakambing + $request->jumlah;
            }
            if ($ternak->kategori_produk_id == '5') {
                $wilayah_komuditas->jml_babi = $wilayah_komuditas->jml_babi - $ternak->jumlah;
                $wilayah_komuditas->jml_babi = $wilayah_komuditas->jml_babi + $request->jumlah;
            }
            if ($ternak->kategori_produk_id == '6') {
                $wilayah_komuditas->jml_ayam_petelur = $wilayah_komuditas->jml_ayam_petelur - $ternak->jumlah;
                $wilayah_komuditas->jml_ayam_petelur = $wilayah_komuditas->jml_ayam_petelur + $request->jumlah;
            }
            if ($ternak->kategori_produk_id == '7') {
                $wilayah_komuditas->jml_ayam_pedaging = $wilayah_komuditas->jml_ayam_pedaging - $ternak->jumlah;
                $wilayah_komuditas->jml_ayam_pedaging = $wilayah_komuditas->jml_ayam_pedaging + $request->jumlah;
            }
            if ($ternak->kategori_produk_id == '8') {
                $wilayah_komuditas->jml_burung_puyuh = $wilayah_komuditas->jml_burung_puyuh - $ternak->jumlah;
                $wilayah_komuditas->jml_burung_puyuh = $wilayah_komuditas->jml_burung_puyuh + $request->jumlah;
            }
            $wilayah_komuditas->save();
        }

        return redirect()->route('ternak')->with('sukses', 'Anda berhasil mengubah data');
    }

    public function destroy(UserTernak $ternak)
    {
        if ($ternak->user_id != auth()->user()->id) {
            return redirect()->route('ternak');
        }

        $wilayah_komuditas = WilayahKomuditas::where('kabupaten', auth()->user()->kabupaten)->first();
        if ($wilayah_komuditas) {
            if ($ternak->kategori_produk_id == '1') {
                $wilayah_komuditas->jml_sapi_potong = $wilayah_komuditas->jml_sapi_potong - $ternak->jumlah;
            }
            if ($ternak->kategori_produk_id == '2') {
                $wilayah_komuditas->jml_sapi_perah = $wilayah_komuditas->jml_sapi_perah - $ternak->jumlah;
            }
            if ($ternak->kategori_produk_id == '3') {
                $wilayah_komuditas->jml_kerbau = $wilayah_komuditas->jml_kerbau - $ternak->jumlah;
            }
            if ($ternak->kategori_produk_id == '4') {
                $wilayah_komuditas->jml_dombakambing = $wilayah_komuditas->jml_dombakambing - $ternak->jumlah;
            }
            if ($ternak->kategori_produk_id == '5') {
                $wilayah_komuditas->jml_babi = $wilayah_komuditas->jml_babi - $ternak->jumlah;
            }
            if ($ternak->kategori_produk_id == '6') {
                $wilayah_komuditas->jml_ayam_petelur = $wilayah_komuditas->jml_ayam_petelur - $ternak->jumlah;
            }
            if ($ternak->kategori_produk_id == '7') {
                $wilayah_komuditas->jml_ayam_pedaging = $wilayah_komuditas->jml_ayam_pedaging - $ternak->jumlah;
            }
            if ($ternak->kategori_produk_id == '8') {
                $wilayah_komuditas->jml_burung_puyuh = $wilayah_komuditas->jml_burung_puyuh - $ternak->jumlah;
            }
            $wilayah_komuditas->save();
        }

        $ternak->delete();
        $this->hitungLevelUser(auth()->user());
        return redirect()->route('ternak')->with('sukses', 'Anda menghapus data');
    }
}
