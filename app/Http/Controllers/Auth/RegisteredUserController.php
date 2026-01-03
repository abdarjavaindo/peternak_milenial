<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Kategori_produk;
use App\Models\User;
use App\Models\UserTernak;
use App\Models\WilayahKomuditas;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $kategori_produk = Kategori_produk::get();
        return view('auth.register', compact('kategori_produk'));
    }

    public function info($namakabupaten)
    {
        $wilayah = WilayahKomuditas::where('kabupaten', $namakabupaten)->first();
        $jumlahPeternak = User::role('user')->where('kabupaten', $namakabupaten)->count();

        return response()->json(
            [
                'nama' => $wilayah->kabupaten,
                'jumlah_peternak' => $jumlahPeternak,
                'jml_sapi_potong' => $wilayah->jml_sapi_potong,
                'jml_sapi_perah' => $wilayah->jml_sapi_perah,
                'jml_kerbau' => $wilayah->jml_kerbau,
                'jml_dombakambing' => $wilayah->jml_dombakambing,
                'jml_babi' => $wilayah->jml_babi,
                'jml_ayam_petelur' => $wilayah->jml_ayam_petelur,
                'jml_ayam_pedaging' => $wilayah->jml_ayam_pedaging,
                'jml_burung_puyuh' => $wilayah->jml_burung_puyuh,
            ]
        );
    }

    public function kabupaten()
    {
        $kabupaten = DB::table('wilayah')
            ->whereRaw("LENGTH(kode) = 5")
            ->orderBy('nama')
            ->get();
        return response()->json($kabupaten);
    }

    public function kecamatan(Request $request)
    {
        $kecamatan = DB::table('wilayah')
            ->where('kode', 'like', $request->kabupaten . '.%')
            ->whereRaw("LENGTH(kode) = 8")
            ->orderBy('nama')
            ->get();
        return response()->json($kecamatan);
    }

    public function desa(Request $request)
    {
        $desa = DB::table('wilayah')
            ->where('kode', 'like', $request->kecamatan . '.%')
            ->whereRaw("LENGTH(kode) = 13")
            ->orderBy('nama')
            ->get();
        return response()->json($desa);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'max:255'],
            'no_telp' => ['required', 'string', 'max:255'],
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
            // 'kategori_produk_id' => ['required'],
            'nama_ternak' => ['required'],
            'jumlah' => ['required'],
            'img_ktp' => 'required|mimes:jpg,jpeg,png|max:11000'
        ]);

        $umur = \Carbon\Carbon::parse($request->tgl_lahir)->age;
        if ($umur < 19 || $umur > 39) {
            return redirect()->back()->with('gagal', 'Umur harus antara 19 sampai 39 tahun.');
        }

        $kabupaten = DB::table('wilayah')
            ->where('kode', $request->kabupaten)
            ->first();
        $kecamatan = DB::table('wilayah')
            ->where('kode', $request->kecamatan)
            ->first();
        $desa = DB::table('wilayah')
            ->where('kode', $request->desa)
            ->first();

        $data = [
            'name' => $request->name,
            'slug' => $this->generateSlugWithRandom($request->name, 4),
            'nik' => $request->nik,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'status' => '1',
            'kabupaten' => $kabupaten->nama,
            'kecamatan' => $kecamatan->nama,
            'desa' => $desa->nama,
            'tgl_lahir' => $request->tgl_lahir,
            'password' => Hash::make($request->password),
        ];
        if ($request->hasFile('img_ktp')) {
            $data['img_ktp'] = $request->file('img_ktp')->store('ktp', 'public');
        }
        $user = User::create($data);
        $user->assignRole('user');

        event(new Registered($user));

        Auth::login($user);

        $kategori_produk = Kategori_produk::where('nama_kategori', $request->nama_ternak)->first();
        UserTernak::create([
            'user_id' => $user->id,
            'kategori_produk_id' => $kategori_produk->id,
            'nama_ternak' => $request->nama_ternak,
            'jumlah' => str_replace('.', '', $request->jumlah),
        ]);
        $this->hitungLevelUser($user);

        return redirect()->route('tokoku');
    }
}
