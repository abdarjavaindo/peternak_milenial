<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        // $kabupaten = DB::table('wilayah')
        //     ->whereRaw("LENGTH(kode) = 5")
        //     ->orderBy('nama')
        //     ->get();

        // $kecamatan = DB::table('wilayah')
        //     // ->where('kode', 'like', $request->kabupaten . '.%')
        //     ->whereRaw("LENGTH(kode) = 8")
        //     ->orderBy('nama')
        //     ->get();

        // $desa = DB::table('wilayah')
        //     // ->where('kode', 'like', $request->kecamatan . '.%')
        //     ->whereRaw("LENGTH(kode) = 13")
        //     ->orderBy('nama')
        //     ->get();
        // return view('auth.register', compact('kabupaten', 'kecamatan', 'desa'));
        return view('auth.register');
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

        $user = User::create([
            'name' => $request->name,
            'slug' => $this->generateSlugWithRandom($request->name, 4),
            'nik' => $request->nik,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'kabupaten' => $kabupaten->nama,
            'kecamatan' => $kecamatan->nama,
            'desa' => $desa->nama,
            'tgl_lahir' => $request->tgl_lahir,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('user');

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('ternak');
    }
}
