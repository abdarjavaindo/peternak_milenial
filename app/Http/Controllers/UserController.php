<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function loaddata()
    {
        $user = User::role('user')->with('roles')->orderBy('id', 'desc')->get();
        return DataTables::of($user)
            ->addColumn('aksi', function ($user) {
                // $editUrl = route('user.edit', $user->id);
                // $changeUrl = route('user.change', $user->id);
                $editUrl = '#';
                $changeUrl = '#';

                return ' <a href="' . $editUrl . '" class="btn btn-sm btn-warning mb-1 btn-icon"><i class="fa fa-edit"></i></a>'
                    . ' <a href="' . $changeUrl . '" class="badge bg-info text-white mb-1">Ubah Status</a>'
                    . ' <a href="' . $changeUrl . '" class="badge bg-warning text-black mb-1">Beri Anggaran</a>';
            })
            ->addColumn('nominal', function ($user) {
                return "Rp " . number_format($user->nominal, 0, ',', '.');
            })
            ->addColumn('status_sekarang', function ($user) {
                return $user->status == 1 ? '<span class="text-success">Aktif</span>' : '<span class="text-danger">Tidak Aktif</span>';
            })
            ->addIndexColumn()
            ->rawColumns(['name', 'email', 'no_telp', 'aksi', 'status_sekarang'])
            ->make(true);
    }

    public function index()
    {
        return view('pages.user.user');
    }

    public function create()
    {
        return view('pages.user.user_form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => '1',
        ]);
        $admin->assignRole('user');

        return redirect('user')->with('sukses', 'Anda berhasil menambahkan data user');
    }
}
