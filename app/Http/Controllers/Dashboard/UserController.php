<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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
                    return '<a href="' . route('user.level', $user->id) . '"><u>'. $user->level.'</u></a>';
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
        return view('pages.dashboard.user.user_form');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nik' => $request->nik,
            'password' => Hash::make($request->password),
            'status' => '1',
        ]);
        $admin->assignRole('user');

        return redirect()->route('user')->with('sukses', 'Anda berhasil menambahkan data user');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user')->with('sukses', 'Anda berhasil menghapus data');
    }

    public function edit(User $user)
    {
        $adminbasic = $user;
        return view('pages.dashboard.user.user_form', compact('adminbasic'));
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nik' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'password' => ['confirmed'],
        ]);
        $data = [
            'name' => $request->name,
            'nik' => $request->nik,
        ];
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        User::where('id', $user->id)->update($data);
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
