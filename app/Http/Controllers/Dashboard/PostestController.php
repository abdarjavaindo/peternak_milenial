<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\KursusMateri;
use App\Models\Postest_pertanyaan;
use App\Models\Postest_pilihan_jawaban;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PostestController extends Controller
{
    public function pertanyaan_loaddata(KursusMateri $materi)
    {
        $data = Postest_pertanyaan::where('kursus_materi_id', $materi->id)->orderBy('id', 'asc')->get();
        return DataTables::of($data)
            ->addColumn('aksi', function ($data) {
                $editUrl = route('pertanyaan.edit', $data->id);
                $deleteForm = '<form method="POST" action="' . route('pertanyaan.destroy', $data->id) . '" class="delete-form" style="display:inline;">
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
    public function pertanyaan(KursusMateri $materi)
    {
        if ($materi->jenis == 'materi') {
            return redirect()->route('materi.edit', $materi->id)->with('gagal', 'Ini bukan postest, anda tidak bisa menambahkan pertanyaan');
        }
        return view('pages.dashboard.postest.pertanyaan', compact('materi'));
    }

    public function pertanyaan_create(KursusMateri $materi)
    {
        return view('pages.dashboard.postest.pertanyaan_form', compact('materi'));
    }
    public function pertanyaan_store(Request $request, KursusMateri $materi)
    {
        $request->validate([
            'pertanyaan' => ['required'],
        ]);
        Postest_pertanyaan::create([
            'kursus_materi_id' => $materi->id,
            'pertanyaan' => $request->pertanyaan,
        ]);
        return redirect()->route('pertanyaan', $materi->id)->with('sukses', 'Anda berhasil menambahkan data');
    }

    public function pertanyaan_edit(Postest_pertanyaan $pertanyaan)
    {
        return view('pages.dashboard.postest.pertanyaan_form', compact('pertanyaan'));
    }
    public function pertanyaan_update(Request $request, Postest_pertanyaan $pertanyaan)
    {
        $request->validate([
            'pertanyaan' => ['required'],
        ]);
        Postest_pertanyaan::where('id', $pertanyaan->id)->update([
            'pertanyaan' => $request->pertanyaan,
        ]);
        return redirect()->route('pertanyaan', $pertanyaan->materi->id)->with('sukses', 'Anda berhasil mengubah data');
    }

    public function pertanyaan_destroy(Postest_pertanyaan $pertanyaan)
    {
        $pertanyaan->delete();
        return redirect()->back()->with('sukses', 'Anda berhasil menghapus data');
    }

    public function jawaban_loaddata(Postest_pertanyaan $pertanyaan)
    {
        $data = Postest_pilihan_jawaban::where('postest_pertanyaan_id', $pertanyaan->id)->orderBy('id', 'asc')->get();
        return DataTables::of($data)
            ->addColumn('aksi', function ($data) {
                $editUrl = route('jawaban.edit', $data->id);
                $deleteForm = '<form method="POST" action="' . route('jawaban.destroy', $data->id) . '" class="delete-form" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="button" class="btn btn-danger delete-button mb-1"><i class="fa fa-trash"></i></button>
                    </form>';

                return $deleteForm . ' <a href="' . $editUrl . '" class="btn btn-sm btn-warning mb-1 btn-icon"><i class="fa fa-edit"></i></a>';
            })
            ->addColumn('benarkah', function ($data) {
                if ($data->is_correct == 0) {
                    return "Salah";
                } else {
                    return '<span class="text-success">Benar</span>';
                }
            })
            ->addIndexColumn()
            ->rawColumns(['aksi', 'benarkah'])
            ->make(true);
    }
    public function jawaban(Postest_pertanyaan $pertanyaan)
    {
        return view('pages.dashboard.postest.jawaban', compact('pertanyaan'));
    }

    public function jawaban_create(Postest_pertanyaan $pertanyaan)
    {
        return view('pages.dashboard.postest.jawaban_form', compact('pertanyaan'));
    }
    public function jawaban_store(Request $request, Postest_pertanyaan $pertanyaan)
    {
        $request->validate([
            'opsi' => ['required'],
            'is_correct' => ['required'],
        ]);
        Postest_pilihan_jawaban::create([
            'postest_pertanyaan_id' => $pertanyaan->id,
            'opsi' => $request->opsi,
            'is_correct' => $request->is_correct,
        ]);
        return redirect()->route('jawaban', $pertanyaan->id)->with('sukses', 'Anda berhasil menambahkan data');
    }

    public function jawaban_edit(Postest_pilihan_jawaban $jawaban)
    {
        return view('pages.dashboard.postest.jawaban_form', compact('jawaban'));
    }
    public function jawaban_update(Request $request, Postest_pilihan_jawaban $jawaban)
    {
        $request->validate([
            'opsi' => ['required'],
            'is_correct' => ['required'],
        ]);
        Postest_pilihan_jawaban::where('id', $jawaban->id)->update([
            'opsi' => $request->opsi,
            'is_correct' => $request->is_correct,
        ]);
        return redirect()->route('jawaban', $jawaban->pertanyaan->id)->with('sukses', 'Anda berhasil mengubah data');
    }

    public function jawaban_destroy(Postest_pilihan_jawaban $jawaban)
    {
        $jawaban->delete();
        return redirect()->back()->with('sukses', 'Anda berhasil menghapus data');
    }
}
