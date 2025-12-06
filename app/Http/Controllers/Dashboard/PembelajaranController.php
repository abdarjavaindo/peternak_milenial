<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Kategori_kursus;
use App\Models\Kursus;
use App\Models\KursusBagian;
use App\Models\KursusMateri;
use App\Models\Pengajar;
use App\Models\User;
use App\Models\UserKursusProgres;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PembelajaranController extends Controller
{
    #region kursus
    public function loaddata()
    {
        $data = Kursus::with(['user', 'pengajar'])->orderBy('id', 'desc')->get();
        return DataTables::of($data)
            ->addColumn('aksi', function ($data) {
                $editUrl = route('pembelajaran.edit', $data->id);
                $bagian = route('bagian', $data->id);
                $deleteForm = '<form method="POST" action="' . route('pembelajaran.destroy', $data->id) . '" class="delete-form" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="button" class="btn btn-danger delete-button mb-1"><i class="fa fa-trash"></i></button>
                    </form>';

                return $deleteForm . ' <a href="' . $editUrl . '" class="btn btn-sm btn-warning mb-1 btn-icon"><i class="fa fa-edit"></i></a>'
                . ' <a href="' . $bagian . '" class="btn btn-sm btn-success text-white mb-1 btn-icon"><i class="fa fa-eye"></i></a>';
            })
            ->addColumn('nama', function ($data) {
                return $data->user->name;
            })
            ->addColumn('jumlah_peserta', function ($data) {
                return '0';
            })
            ->addColumn('publish', function ($data) {
                return $data->is_published == 0 ? 'tidak' : 'IYA';
            })
            ->addColumn('pengajar', function ($data) {
                return $data->pengajar->nama;
            })
            ->addIndexColumn()
            ->rawColumns(['nama', 'aksi', 'jumlah_peserta', 'publish', 'pengajar'])
            ->make(true);
    }
    public function index()
    {
        return view('pages.dashboard.pembelajaran.index');
    }

    public function create()
    {
        $data['kategori_kursus'] = Kategori_kursus::get();
        $data['pengajar'] = Pengajar::get();
        return view('pages.dashboard.pembelajaran.form', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'judul' => ['required'],
            'kategori_kursus_id' => ['required'],
            'level' => ['required'],
            'deskripsi' => ['required'],
            'youtube' => ['required'],
            'hari' => ['required'],
            'pengajar_id' => ['required'],
            'gambar' => 'required|mimes:jpg,jpeg,png|max:11000'
        ]);

        $data = [
            'kategori_kursus_id' => $request->kategori_kursus_id,
            'user_id' => auth()->user()->id,
            'judul' => $request->judul,
            'slug' => $this->generateSlugWithRandom($request->judul),
            'deskripsi' => $request->deskripsi,
            'youtube' => $request->youtube,
            'level' => $request->level,
            'harga' => str_replace('.', '', $request->harga),
            'hari' => $request->hari,
            'is_published' => $request->is_published,
            'pengajar_id' => $request->pengajar_id,
        ];
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('kursus', 'public');
        }
        Kursus::create($data);
        return redirect()->route('pembelajaran')->with('sukses', 'Anda berhasil menambahkan data');
    }

    public function edit(Kursus $kursus)
    {
        $data['kursus'] = $kursus;
        $data['pengajar'] = Pengajar::get();
        $data['kategori_kursus'] = Kategori_kursus::get();
        return view('pages.dashboard.pembelajaran.form', $data);
    }
    public function update(Request $request, Kursus $kursus)
    {
        $request->validate([
            'judul' => ['required'],
            'kategori_kursus_id' => ['required'],
            'level' => ['required'],
            'deskripsi' => ['required'],
            'youtube' => ['required'],
            'hari' => ['required'],
            'pengajar_id' => ['required'],
            'gambar' => 'mimes:jpg,jpeg,png|max:11000'
        ]);

        $data = [
            'kategori_kursus_id' => $request->kategori_kursus_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'youtube' => $request->youtube,
            'level' => $request->level,
            'harga' => str_replace('.', '', $request->harga),
            'hari' => $request->hari,
            'is_published' => $request->is_published,
            'pengajar_id' => $request->pengajar_id,
        ];
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('kursus', 'public');
        }
        Kursus::where('id', $kursus->id)->update($data);
        return redirect()->route('pembelajaran')->with('sukses', 'Anda berhasil mengubah data');
    }

    public function destroy(Kursus $kursus)
    {
        $kursus->delete();
        return redirect()->route('pembelajaran')->with('sukses', 'Anda berhasil menghapus data');
    }
    #endregion

    #region peserta
    public function peserta_loaddata(Kursus $kursus)
    {
        $data = UserKursusProgres::with('user')->where('kursus_id', $kursus->id)->orderBy('id', 'desc')->get();
        return DataTables::of($data)
            ->addColumn('aksi', function ($data) {
                $deleteForm = '<form method="POST" action="' . route('peserta.destroy', ['kursus' => $data->kursus_id, 'user' => $data->user_id]) . '" class="delete-form" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="button" class="btn btn-danger delete-button mb-1"><i class="fa fa-trash"></i></button>
                    </form>';

                return $deleteForm;
            })
            ->addColumn('nama', function ($data) {
                return $data->user->name;
            })
            ->addIndexColumn()
            ->rawColumns(['aksi', 'nama'])
            ->make(true);
    }
    public function peserta(Kursus $kursus)
    {
        return view('pages.dashboard.pembelajaran.peserta', compact('kursus'));
    }
    public function peserta_destroy(Kursus $kursus, User $user)
    {
        $userkursus = UserKursusProgres::where([
            'user_id' => $user->id,
            'kursus_id' => $kursus->id,
        ])->firstOrFail();
        $userkursus->delete();
        return redirect()->back()->with('sukses', 'Anda berhasil menghapus data');
    }
    #endregion

    #region bagian
    public function bagian_loaddata(Kursus $kursus)
    {
        $data = KursusBagian::where('kursus_id', $kursus->id)->orderBy('urutan', 'asc')->get();
        return DataTables::of($data)
            ->addColumn('aksi', function ($data) {
                $editUrl = route('bagian.edit', $data->id);
                $materi = route('materi', $data->id);
                $deleteForm = '<form method="POST" action="' . route('bagian.destroy', $data->id) . '" class="delete-form" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="button" class="btn btn-danger delete-button mb-1"><i class="fa fa-trash"></i></button>
                    </form>';

                return $deleteForm . ' <a href="' . $editUrl . '" class="btn btn-sm btn-warning mb-1 btn-icon"><i class="fa fa-edit"></i></a>'
                . ' <a href="' . $materi . '" class="badge bg-success text-white mb-1 btn-icon">materi</a>';
            })
            ->addIndexColumn()
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function bagian(Kursus $kursus)
    {
        return view('pages.dashboard.pembelajaran.bagian', compact('kursus'));
    }

    public function bagian_create(Kursus $kursus)
    {
        return view('pages.dashboard.pembelajaran.bagian_form', compact('kursus'));
    }
    public function bagian_store(Request $request, Kursus $kursus)
    {
        $request->validate([
            'judul' => ['required'],
            'urutan' => ['required'],
        ]);
        KursusBagian::create([
            'kursus_id' => $kursus->id,
            'judul' => $request->judul,
            'urutan' => $request->urutan,
        ]);
        return redirect()->route('bagian', $kursus->id)->with('sukses', 'Anda berhasil menambahkan data');
    }

    public function bagian_edit(KursusBagian $bagian)
    {
        return view('pages.dashboard.pembelajaran.bagian_form', compact('bagian'));
    }
    public function bagian_update(Request $request, KursusBagian $bagian)
    {
        $request->validate([
            'judul' => ['required'],
            'urutan' => ['required'],
        ]);
        $bagian->judul = $request->judul;
        $bagian->urutan = $request->urutan;
        $bagian->save();
        return redirect()->route('bagian', $bagian->kursus->id)->with('sukses', 'Anda berhasil mengubah data');
    }

    public function bagian_destroy(KursusBagian $bagian)
    {
        $bagian->delete();
        return redirect()->back()->with('sukses', 'Anda berhasil menghapus data');
    }
    #endregion

    #region materi
    public function materi_loaddata(KursusBagian $bagian)
    {
        $data = KursusMateri::where('kursus_bagian_id', $bagian->id)->orderBy('id', 'asc')->get();
        return DataTables::of($data)
            ->addColumn('aksi', function ($data) {
                $editUrl = route('materi.edit', $data->id);
                $deleteForm = '<form method="POST" action="' . route('materi.destroy', $data->id) . '" class="delete-form" style="display:inline;">
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
    public function materi(KursusBagian $bagian)
    {
        return view('pages.dashboard.pembelajaran.materi', compact('bagian'));
    }

    public function materi_create(KursusBagian $bagian)
    {
        return view('pages.dashboard.pembelajaran.materi_form', compact('bagian'));
    }
    public function materi_store(Request $request, KursusBagian $bagian)
    {
        $request->validate([
            'judul' => ['required'],
            'jenis' => ['required'],
        ]);
        KursusMateri::create([
            'kursus_bagian_id' => $bagian->id,
            'judul' => $request->judul,
            'konten' => $request->konten,
            'jenis' => $request->jenis,
        ]);
        return redirect()->route('materi', $bagian->id)->with('sukses', 'Anda berhasil menambahkan data');
    }

    public function materi_edit(KursusMateri $materi)
    {
        return view('pages.dashboard.pembelajaran.materi_form', compact('materi'));
    }
    public function materi_update(Request $request, KursusMateri $materi)
    {
        $request->validate([
            'judul' => ['required'],
            'jenis' => ['required'],
        ]);
        $materi->judul = $request->judul;
        $materi->jenis = $request->jenis;
        $materi->konten = $request->konten;
        $materi->save();
        return redirect()->route('materi', $materi->bagian->id)->with('sukses', 'Anda berhasil mengubah data');
    }

    public function materi_destroy(KursusMateri $materi)
    {
        $materi->delete();
        return redirect()->back()->with('sukses', 'Anda berhasil menghapus data');
    }
    #endregion
}
