<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Models\UserTernak;
use App\Models\WilayahKomuditas;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;

class UserProfileController extends Controller
{
    public function edit(Request $request): View
    {
        $kabupaten = DB::table('wilayah')
            ->whereRaw("LENGTH(kode) = 5")
            ->orderBy('nama')
            ->get();

        $kecamatan = DB::table('wilayah')
            // ->where('kode', 'like', $request->kabupaten . '.%')
            ->whereRaw("LENGTH(kode) = 8")
            ->orderBy('nama')
            ->get();

        $desa = DB::table('wilayah')
            // ->where('kode', 'like', $request->kecamatan . '.%')
            ->whereRaw("LENGTH(kode) = 13")
            ->orderBy('nama')
            ->get();

        return view('pages.home.userprofile', [
            'user' => $request->user(),
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'desa' => $desa,
        ]);
    }

    public function update(ProfileUpdateRequest $request, User $user): RedirectResponse
    {
        $request->validate([
            'no_telp' => 'required',
            'nik' => [
                'required',
                'digits:16',          // harus tepat 16 karakter dan angka semua
                'regex:/^[0-9]{16}$/', // memastikan benar-benar hanya angka
                function ($attribute, $value, $fail) {
                    if (substr($value, 0, 2) !== '35') {
                        $fail('NIK yang Anda masukkan tidak terdaftar sebagai wilayah Jawa Timur.');
                    }
                },
                Rule::unique(User::class, 'nik')->ignore(auth()->user()->id),
            ],
            'kabupaten' => ['required', 'string', 'max:255'],
            'kecamatan' => ['required', 'string', 'max:255'],
            'desa' => ['required', 'string', 'max:255'],
            'tgl_lahir' => ['required', 'date'],
            'img_ktp' => 'mimes:jpg,jpeg,png|max:11000',
            'gambar' => 'mimes:jpg,jpeg,png|max:11000',
        ]);
        $user = User::where('id', auth()->user()->id)->first();

        $kabupatenLama = $user->kabupaten;
        $kabupatenBaru = $request->kabupaten;
        if ($kabupatenLama !== $kabupatenBaru) {
            $mapKolom = [
                1 => 'jml_sapi_potong',
                2 => 'jml_sapi_perah',
                3 => 'jml_kerbau',
                4 => 'jml_dombakambing',
                5 => 'jml_babi',
                6 => 'jml_ayam_petelur',
                7 => 'jml_ayam_pedaging',
                8 => 'jml_burung_puyuh',
            ];
            $wilayahLama = WilayahKomuditas::where('kabupaten', $kabupatenLama)->first();
            $wilayahBaru = WilayahKomuditas::where('kabupaten', $kabupatenBaru)->first();
            $userTernaks = UserTernak::where('user_id', $user->id)->get();
            foreach ($userTernaks as $ternak) {
                if (!isset($mapKolom[$ternak->kategori_produk_id])) {
                    continue;
                }
                $kolom = $mapKolom[$ternak->kategori_produk_id];
                $jumlah = (int) $ternak->jumlah;
                // Kurangi wilayah lama
                if ($wilayahLama) {
                    $wilayahLama->$kolom -= $jumlah;
                    if ($wilayahLama->$kolom < 0) {
                        $wilayahLama->$kolom = 0;
                    }
                }
                // Tambah wilayah baru
                if ($wilayahBaru) {
                    $wilayahBaru->$kolom += $jumlah;
                }
            }
            if ($wilayahLama) $wilayahLama->save();
            if ($wilayahBaru) $wilayahBaru->save();
        }

        $user->email = $request->email;
        $user->no_telp = $request->no_telp;
        $user->name = $request->name;
        $user->nik = $request->nik;
        $user->kabupaten = $request->kabupaten;
        $user->kecamatan = $request->kecamatan;
        $user->desa = $request->desa;
        $user->tgl_lahir = $request->tgl_lahir;
        if ($request->hasFile('img_ktp')) {
            $user->img_ktp = $request->file('img_ktp')->store('ktp', 'public');
        }
        if ($request->hasFile('gambar')) {
            $user->gambar = $request->file('gambar')->store('foto-profil', 'public');
        }
        $user->save();

        return Redirect::route('userprofile.edit')->with('status', 'profile-updated');
    }

    /**
     * Display user's training history
     */
    public function riwayat(): View
    {
        $riwayat = \App\Models\UserKursusProgres::with(['kursus', 'progresMateri'])
            ->where('user_id', auth()->id())
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('pages.home.profile.riwayat', compact('riwayat'));
    }
}
