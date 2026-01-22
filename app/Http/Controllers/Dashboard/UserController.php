<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Kategori_produk;
use App\Models\User;
use App\Models\UserTernak;
use App\Models\WilayahKomuditas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function loaddata()
    {
        $user = User::role('user')->with('roles')->orderBy('id', 'desc')->get();
        return DataTables::of($user)
            ->addColumn('aksi', function ($user) {
                $editUrl = route('user.edit', $user->id);
                $deleteForm = '<form method="POST" action="' . route('user.destroy', $user->id) . '" class="delete-form" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="button" class="btn btn-danger delete-button mb-1"><i class="fa fa-trash"></i></button>
                        </form>';
                $changeUrl = route('user.change', $user->id);

                return $deleteForm . ' <a href="' . $editUrl . '" class="btn btn-sm btn-warning mb-1 btn-icon">Edit</a>'
                    . ' <a href="' . $changeUrl . '" class="badge bg-info text-white mb-1 btn-icon">change status</a>';
            })
            ->addColumn('status_sekarang', function ($user) {
                return $user->status == 1 ? '<span class="text-success">Aktif</span>' : '<span class="text-danger">Tidak Aktif</span>';
            })
            ->addColumn('level_sekarang', function ($user) {
                if ($user->level) {
                    return '<a href="' . route('user.level', $user->id) . '"><u>' . $user->level . '</u></a>';
                }
                return '<a href="' . route('user.level', $user->id) . '" class="btn btn-info mb-1">Pilih Level</a>';
            })
            ->addIndexColumn()
            ->rawColumns(['name', 'email', 'no_telp', 'aksi', 'status_sekarang', 'level_sekarang'])
            ->make(true);
    }
    public function index()
    {
        return view('pages.dashboard.user.user');
    }

    public function create()
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
        $kategori_produk = Kategori_produk::get();
        return view('pages.dashboard.user.user_form', compact(
            'kategori_produk',
            'kabupaten',
            'kecamatan',
            'desa',
        ));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nik' => [
                'required',
                'digits:16',          // harus tepat 16 karakter dan angka semua
                'regex:/^[0-9]{16}$/', // memastikan benar-benar hanya angka
                function ($attribute, $value, $fail) {
                    if (substr($value, 0, 2) !== '35') {
                        $fail('NIK yang Anda masukkan tidak terdaftar sebagai wilayah Jawa Timur.');
                    }
                },
                Rule::unique('users', 'nik'),
            ],
            'kabupaten' => ['required'],
            'kecamatan' => ['required'],
            'desa' => ['required'],
            'tgl_lahir' => ['required', 'date'],
            'nama_ternak' => ['required'],
            'jumlah' => ['required'],
            'img_ktp' => 'required|mimes:jpg,jpeg,png|max:11000'
        ]);
        $umur = \Carbon\Carbon::parse($request->tgl_lahir)->age;
        if ($umur < 19 || $umur > 39) {
            return redirect()->back()->with('gagal', 'Umur harus antara 19 sampai 39 tahun.');
        }

        $data_user = [
            'name' => $request->name,
            'slug' => $this->generateSlugWithRandom($request->name, 4),
            'nik' => $request->nik,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'status' => '1',
            'kabupaten' => $request->kabupaten,
            'kecamatan' => $request->kecamatan,
            'desa' => $request->desa,
            'tgl_lahir' => $request->tgl_lahir,
            'password' => Hash::make($request->password),
        ];
        if ($request->hasFile('img_ktp')) {
            $data_user['img_ktp'] = $request->file('img_ktp')->store('ktp', 'public');
        }
        $admin = User::create($data_user);
        $admin->assignRole('user');

        $kategori_produk = Kategori_produk::where('nama_kategori', $request->nama_ternak)->first();
        UserTernak::create([
            'user_id' => $admin->id,
            'kategori_produk_id' => $kategori_produk->id,
            'nama_ternak' => $request->nama_ternak,
            'jumlah' => str_replace('.', '', $request->jumlah),
        ]);
        $this->hitungLevelUser($admin);

        $wilayah_komuditas = WilayahKomuditas::where('kabupaten', $request->kabupaten)->first();
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

        return redirect()->route('user')->with('sukses', 'Anda berhasil menambahkan data user');
    }

    public function destroy(User $user)
    {
        DB::transaction(function () use ($user) {
            // Ambil wilayah sesuai kabupaten user
            $wilayah = WilayahKomuditas::where(
                'kabupaten',
                $user->kabupaten
            )->first();
            if ($wilayah) {
                // Mapping kategori ke kolom wilayah
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
                // Ambil SEMUA ternak milik user
                $userTernaks = UserTernak::where('user_id', $user->id)->get();
                foreach ($userTernaks as $ternak) {
                    if (isset($mapKolom[$ternak->kategori_produk_id])) {
                        $kolom = $mapKolom[$ternak->kategori_produk_id];
                        $wilayah->$kolom -= (int) $ternak->jumlah;
                        // optional safety
                        if ($wilayah->$kolom < 0) {
                            $wilayah->$kolom = 0;
                        }
                    }
                }
                $wilayah->save();
            }
            // Hapus user (user_ternaks ikut terhapus karena cascade)
            $user->delete();
        });

        return redirect()
            ->route('user')
            ->with('sukses', 'Anda berhasil menghapus data user');
    }

    public function edit(User $user)
    {
        $adminbasic = $user;
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
        return view('pages.dashboard.user.user_form', compact(
            'adminbasic',
            'kabupaten',
            'kecamatan',
            'desa',
        ));
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nik' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'password' => ['confirmed'],
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
                Rule::unique(User::class, 'nik')->ignore($user->id),
            ],
            'kabupaten' => ['required', 'string', 'max:255'],
            'kecamatan' => ['required', 'string', 'max:255'],
            'desa' => ['required', 'string', 'max:255'],
            'tgl_lahir' => ['required', 'date'],
            'img_ktp' => 'mimes:jpg,jpeg,png|max:11000',
        ]);

        $umur = \Carbon\Carbon::parse($request->tgl_lahir)->age;
        if ($umur < 19 || $umur > 39) {
            return redirect()->back()->with('gagal', 'Umur harus antara 19 sampai 39 tahun.');
        }

        DB::transaction(function () use ($request, $user) {
            $kabupatenLama = $user->kabupaten;
            $kabupatenBaru = $request->kabupaten;

            $data = [
                'name' => $request->name,
                'nik' => $request->nik,
                'no_telp' => $request->no_telp,
                'kabupaten' => $request->kabupaten,
                'kecamatan' => $request->kecamatan,
                'desa' => $request->desa,
                'tgl_lahir' => $request->tgl_lahir,
            ];
            if ($request->hasFile('img_ktp')) {
                $data['img_ktp'] = $request->file('img_ktp')->store('ktp', 'public');
            }
            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            }
            User::where('id', $user->id)->update($data);

            // =========================
            // Jika kabupaten berubah
            // =========================
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
        });

        return redirect()->route('user')->with('sukses', 'Anda berhasil memperbarui data');
    }

    public function change(User $user)
    {
        if ($user->status == '1') {
            User::where('id', $user->id)->update(['status' => 0]);
        } else {
            User::where('id', $user->id)->update(['status' => 1]);
        }
        return redirect()->route('user')->with('sukses', 'Anda berhasil memperbarui data');
    }

    public function level(User $user)
    {
        return view('pages.dashboard.user.level_form', compact('user'));
    }
    public function levelstore(Request $request, User $user)
    {
        $request->validate([
            'level' => ['required'],
        ]);
        $user->level = $request->level;
        $user->save();
        return redirect()->route('user')->with('sukses', 'Anda berhasil memperbarui data');
    }
}
