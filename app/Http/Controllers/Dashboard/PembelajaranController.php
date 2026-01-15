<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Kategori_kursus;
use App\Models\Kategori_produk;
use App\Models\Kursus;
use App\Models\KursusBagian;
use App\Models\KursusMateri;
use App\Models\Pengajar;
use App\Models\User;
use App\Models\UserKursusProgres;
use App\Models\User_postest;
use App\Traits\LogsActivity;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PembelajaranController extends Controller
{
    use LogsActivity;
    #region kursus
    public function loaddata()
    {
        $data = Kursus::with(['user', 'peserta', 'kategori'])->orderBy('id', 'desc')->get();
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
                return $data->peserta->count();
            })
            ->addColumn('jumlah_materi', function ($data) {
                return $data->semua_materi->count();
            })
            ->addColumn('publish', function ($data) {
                return $data->is_published == 0 ? 'Tidak' : 'Iya';
            })
            ->addColumn('kategori_kursus', function ($data) {
                return $data->kategori_kursus_id == 1 ? 'Online' : 'Offline';
            })
            ->addIndexColumn()
            ->rawColumns(['nama', 'aksi', 'jumlah_peserta', 'publish', 'pengajar', 'kategori_kursus'])
            ->make(true);
    }
    public function index()
    {
        return view('pages.dashboard.pembelajaran.index');
    }

    public function create()
    {
        $data['kategori_kursus'] = Kategori_kursus::get();
        $data['ketegori_produk'] = Kategori_produk::get();
        return view('pages.dashboard.pembelajaran.form', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'judul' => ['required'],
            'kategori_kursus_id' => ['required'],
            'kategori_produk_id' => ['required'],
            'level' => ['required'],
            'deskripsi' => ['required'],
            'youtube' => ['required'],
            'hari' => ['required'],
            'gambar' => 'required|mimes:jpg,jpeg,png|max:11000'
        ]);

        $data = [
            'kategori_kursus_id' => $request->kategori_kursus_id,
            'kategori_produk_id' => $request->kategori_produk_id,
            'user_id' => auth()->user()->id,
            'judul' => $request->judul,
            'slug' => $this->generateSlugWithRandom($request->judul),
            'deskripsi' => $request->deskripsi,
            'youtube' => $request->youtube,
            'level' => $request->level,
            'hari' => $request->hari,
            'is_published' => $request->is_published,
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
        $data['kategori_kursus'] = Kategori_kursus::get();
        $data['ketegori_produk'] = Kategori_produk::get();
        return view('pages.dashboard.pembelajaran.form', $data);
    }
    public function update(Request $request, Kursus $kursus)
    {
        $request->validate([
            'judul' => ['required'],
            'kategori_kursus_id' => ['required'],
            'kategori_produk_id' => ['required'],
            'level' => ['required'],
            'deskripsi' => ['required'],
            'youtube' => ['required'],
            'hari' => ['required'],
            'gambar' => 'mimes:jpg,jpeg,png|max:11000'
        ]);

        $data = [
            'kategori_kursus_id' => $request->kategori_kursus_id,
            'kategori_produk_id' => $request->kategori_produk_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'youtube' => $request->youtube,
            'level' => $request->level,
            'hari' => $request->hari,
            'is_published' => $request->is_published,
        ];
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('kursus', 'public');
        }
        Kursus::where('id', $kursus->id)->update($data);
        return redirect()->route('pembelajaran')->with('sukses', 'Anda berhasil mengubah data');
    }

    public function destroy(Kursus $kursus)
    {
        // Check for active participants before deletion
        $pesertaCount = UserKursusProgres::where('kursus_id', $kursus->id)->count();

        if ($pesertaCount > 0) {
            return redirect()->back()->with(
                'gagal',
                "Tidak dapat menghapus pelatihan \"{$kursus->judul}\" " .
                    "karena masih memiliki {$pesertaCount} peserta. " .
                    "Hapus semua peserta terlebih dahulu."
            );
        }

        // Log before delete
        $this->logActivity('delete_kursus', 'Kursus', $kursus->id, [
            'judul' => $kursus->judul,
        ]);

        $kursus->delete();
        return redirect()->route('pembelajaran')->with('sukses', 'Anda berhasil menghapus data');
    }
    #endregion

    #region peserta
    public function peserta_loaddata(Kursus $kursus)
    {
        $data = UserKursusProgres::with(['user', 'kursus'])->where('kursus_id', $kursus->id)->orderBy('id', 'desc')->get();
        return DataTables::of($data)
            ->addColumn('aksi', function ($data) {
                if ($data->kursus->kategori_kursus_id == 2) {
                    $deleteForm = '<form method="POST" action="' . route('peserta.destroy', ['kursus' => $data->kursus_id, 'user' => $data->user_id]) . '" class="delete-form" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="button" class="btn btn-danger delete-button mb-1">Reset</button>
                    </form>';
                    $lulus = route('peserta.lulus', ['kursus' => $data->kursus_id, 'user' => $data->user_id]);
                    $batal = route('peserta.batallulus', ['kursus' => $data->kursus_id, 'user' => $data->user_id]);
                    $do = route('peserta.do', ['kursus' => $data->kursus_id, 'user' => $data->user_id]);
                    if ($data->status == 'progres') {
                        return $deleteForm . ' <a href="' . $lulus . '" class="btn btn-sm btn-success lulus-button text-white mb-1 btn-icon">Lulus</a>'
                            . ' <a href="' . $do . '" class="btn btn-sm btn-secondary do-button text-white mb-1 btn-icon">Keluar</a>';
                    } elseif ($data->status == 'do') {
                        return $deleteForm . ' <a href="' . $lulus . '" class="btn btn-sm btn-success lulus-button text-white mb-1 btn-icon">Lulus</a>' .
                            ' <a href="' . $batal . '" class="btn btn-sm btn-warning batal-do-button text-white mb-1 btn-icon">Batal Keluar</a>';
                    } else {
                        return $deleteForm . ' <a href="' . $batal . '" class="btn btn-sm btn-warning batal-lulus-button text-white mb-1 btn-icon">Batalkan Lulus</a>' .
                            ' <a href="' . $do . '" class="btn btn-sm btn-secondary do-button text-white mb-1 btn-icon">Keluar</a>';
                    }
                } else {
                    $deleteForm = '<form method="POST" action="' . route('peserta.destroy', ['kursus' => $data->kursus_id, 'user' => $data->user_id]) . '" class="delete-form" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="button" class="btn btn-danger delete-button mb-1">Reset</button>
                        </form>';
                    return $deleteForm;
                }
            })
            ->addColumn('nama', function ($data) {
                return $data->user->name;
            })
            ->addColumn('status_now', function ($data) {
                if ($data->status == 'do') {
                    return "tidak lulus";
                } else {
                    return $data->status;
                }
            })
            ->addIndexColumn()
            ->rawColumns(['aksi', 'nama', 'status_now'])
            ->make(true);
    }
    public function peserta(Kursus $kursus)
    {
        return view('pages.dashboard.pembelajaran.peserta', compact('kursus'));
    }
    public function peserta_destroy(Kursus $kursus, User $user)
    {
        // Get user enrollment first for proper cleanup
        $userkursus = UserKursusProgres::where([
            'user_id' => $user->id,
            'kursus_id' => $kursus->id,
        ])->firstOrFail();

        // CLEANUP 1: Delete KursusProgres (per-material progress)
        $progressCount = \App\Models\KursusProgres::where('user_kursus_progres_id', $userkursus->id)->count();
        \App\Models\KursusProgres::where('user_kursus_progres_id', $userkursus->id)->delete();

        // CLEANUP 2: Delete postest data via FK (primary method - more reliable)
        $postestCount = User_postest::where('user_kursus_progres_id', $userkursus->id)->count();
        User_postest::where('user_kursus_progres_id', $userkursus->id)
            ->each(function ($attempt) {
                $attempt->jawabans()->delete();
                $attempt->delete();
            });

        // CLEANUP 2b: Fallback - Delete any orphaned postest via materi IDs (for legacy records without FK)
        $materiIds = $kursus->bagian()
            ->with('materi')
            ->get()
            ->pluck('materi')
            ->flatten()
            ->pluck('id')
            ->toArray();

        if (!empty($materiIds)) {
            User_postest::where('user_id', $user->id)
                ->whereIn('postest_id', $materiIds)
                ->each(function ($attempt) use (&$postestCount) {
                    $attempt->jawabans()->delete();
                    $attempt->delete();
                    $postestCount++;
                });
        }

        // CLEANUP 3: Delete enrollment
        $userkursus->delete();

        // Audit trail: log deletion activity with complete counts
        $this->logActivity('delete_peserta', 'UserKursusProgres', $userkursus->id, [
            'user_name' => $user->name,
            'user_email' => $user->email,
            'kursus_judul' => $kursus->judul,
            'progress_deleted_count' => $progressCount,
            'postest_deleted_count' => $postestCount,
        ]);

        return redirect()->back()->with('sukses', 'Anda berhasil menghapus data kepesertaan lengkap (progress, postest, dan jawaban)');
    }

    public function peserta_lulus(Kursus $kursus, User $user)
    {
        $progres = UserKursusProgres::where([
            'user_id' => $user->id,
            'kursus_id' => $kursus->id,
        ])->update([
            'status' => 'selesai'
        ]);
        return redirect()->back()->with('sukses', 'Anda berhasil mengubah data peserta');
    }

    public function peserta_batallulus(Kursus $kursus, User $user)
    {
        $progres = UserKursusProgres::where([
            'user_id' => $user->id,
            'kursus_id' => $kursus->id,
        ])->update([
            'status' => 'progres'
        ]);
        return redirect()->back()->with('sukses', 'Anda berhasil mengubah data peserta');
    }

    public function peserta_do(Kursus $kursus, User $user)
    {
        $progres = UserKursusProgres::where([
            'user_id' => $user->id,
            'kursus_id' => $kursus->id,
        ])->update([
            'status' => 'do'
        ]);
        return redirect()->back()->with('sukses', 'Anda berhasil mengubah data peserta');
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
                    . ' <a href="' . $materi . '" class="badge bg-success text-white mb-1 btn-icon">materi dan postest</a>';
            })
            ->addIndexColumn()
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function bagian(Kursus $kursus)
    {
        if ($kursus->kategori_kursus_id == 2) {
            return redirect()->route('peserta', $kursus->id);
        }
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
        // Check if any materi in this bagian has postest attempts
        $materiIds = $bagian->materi()->pluck('id')->toArray();
        $hasPostestData = User_postest::whereIn('postest_id', $materiIds)->exists();

        if ($hasPostestData) {
            return redirect()->back()->with(
                'gagal',
                "Tidak dapat menghapus bagian \"{$bagian->judul}\" " .
                    "karena ada data postest peserta. " .
                    "Hapus peserta terlebih dahulu."
            );
        }

        // Log before delete
        $this->logActivity('delete_bagian', 'KursusBagian', $bagian->id, [
            'judul' => $bagian->judul,
            'kursus' => $bagian->kursus->judul ?? 'Unknown',
        ]);

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

                return $deleteForm . ' <a href="' . $editUrl . '" class="btn btn-sm btn-success text-white mb-1 btn-icon"><i class="fa fa-eye"></i></a>';
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
            'durasi_postest' => $request->durasi_postest,
            'nilai_lulus_postest' => $request->nilai_lulus_postest,
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
        $materi->durasi_postest = $request->durasi_postest;
        $materi->nilai_lulus_postest = $request->nilai_lulus_postest;
        $materi->save();
        return redirect()->route('materi', $materi->bagian->id)->with('sukses', 'Anda berhasil mengubah data');
    }

    public function materi_destroy(KursusMateri $materi)
    {
        // Check if this materi has postest attempts
        $hasPostestData = User_postest::where('postest_id', $materi->id)->exists();

        if ($hasPostestData) {
            return redirect()->back()->with(
                'gagal',
                "Tidak dapat menghapus materi \"{$materi->judul}\" " .
                    "karena ada data postest peserta."
            );
        }

        // Capture data before deletion
        $materiId = $materi->id;
        $materiJudul = $materi->judul;
        $bagianJudul = $materi->bagian->judul ?? 'Unknown';

        $materi->delete();

        // Log activity
        $this->logActivity('delete_materi', 'KursusMateri', $materiId, [
            'materi_judul' => $materiJudul,
            'bagian_judul' => $bagianJudul,
        ]);

        return redirect()->back()->with('sukses', 'Anda berhasil menghapus data');
    }
    #endregion
}
