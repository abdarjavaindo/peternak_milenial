<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Kategori_produk;
use App\Models\Produk;
use App\Models\Produk_komentar;
use App\Models\User;
use App\Models\UserTernak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class TokoController extends Controller
{
    public function index(Request $request)
    {
        $kategori_produk = Kategori_produk::orderBy('id', 'asc')->get();
        $search = $request->s; // keyword pencarian
        $slug = $request->slug; // kategori slug
        $sort = $request->sort;

        $query = DB::table('produks')
            ->leftJoin('kategori_produks', 'produks.kategori_produk_id', '=', 'kategori_produks.id')
            ->leftJoin('users', 'produks.user_id', '=', 'users.id')
            ->leftJoin('produk_gambars', function ($join) {
                $join->on('produks.id', '=', 'produk_gambars.produk_id')
                    ->whereRaw('produk_gambars.id = (
                            SELECT id FROM produk_gambars
                            WHERE produk_id = produks.id
                            ORDER BY id ASC LIMIT 1
                            )');
            });

        // --- Jika slug ada → filter kategori ---
        $current_kategori = null;
        if ($slug) {
            $current_kategori = DB::table('kategori_produks')
                ->where('slug_kategori', $slug)
                ->first();
            if (!$current_kategori) {
                abort(404, 'Kategori tidak ditemukan.');
            }
            $query->where('produks.kategori_produk_id', $current_kategori->id);
        }

        // --- Jika ada keyword pencarian ---
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('produks.nama_produk', 'like', "%$search%")
                    ->orWhere('produks.harga', 'like', "%$search%");
            });
        }

        // SORTING
        if ($sort == 'terbaru') {
            $query->orderBy('produks.created_at', 'DESC');
        } elseif ($sort == 'harga_desc') {
            $query->orderBy('produks.harga', 'DESC');
        } elseif ($sort == 'harga_asc') {
            $query->orderBy('produks.harga', 'ASC');
        }

        // --- Eksekusi query ---
        $produks = $query->select(
            'produks.*',
            'kategori_produks.*',
            'users.name',
            'produk_gambars.nama_file as thumbnail'
        )
            ->paginate(12) // <= pagination 12 produk per halaman
            ->withQueryString(); // supaya search & slug tidak hilang ketika pindah halaman

        return view('pages.home.toko.produk', [
            'kategori_produk' => $kategori_produk,
            'produks' => $produks,
            'current_kategori' => $current_kategori
        ]);
    }

    public function detail(Request $request, $slug)
    {
        $v = $request->v;
        $produk = Produk::with([
            'kategori',
            'user',
            'gambar',
            'komentar',
        ])->where('slug', $slug)->firstOrFail();

        if (auth()->user()) {
            $data['jumlahternak'] = UserTernak::where('user_id', auth()->user()->id)->count();
        }

        return view('pages.home.toko.detail_produk', [
            'produk' => $produk,
            'slug' => $slug,
            'v' => $v,
            'jumlahternak' => $data['jumlahternak'],
        ]);
    }
    public function komentar_store(Request $request, Produk $produk)
    {
        $request->validate([
            'komentar' => ['required']
        ]);
        Produk_komentar::create([
            'user_id' => auth()->user()->id,
            'produk_id' => $produk->id,
            'komentar' => $request->komentar,
        ]);
        return redirect()->back()->with('sukses', 'Anda berhasil memberi komentar');
    }
    public function komentar_destroy(Produk_komentar $komentar)
    {
        if (auth()->user()->hasRole('admin')) {
            $komentar->delete();
            return redirect()->back()->with('sukses', 'Anda berhasil menghapus data');
        }

        if ($komentar->user_id !== auth()->user()->id) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus komentar ini');
        }
        $komentar->delete();
        return redirect()->back()->with('sukses', 'Komentar berhasil dihapus');
    }

    public function loaddata()
    {
        $data = User::role('user')->where('status', '1')
            ->orderByRaw("
                CASE level
                    WHEN 'ahli' THEN 1
                    WHEN 'menengah' THEN 2
                    WHEN 'pemula' THEN 3
                    ELSE 4
                END
            ")
            ->orderBy('id', 'desc')->get();
        return DataTables::of($data)
            ->addColumn('aksi', function ($data) {
                $detail = route('shop.user', $data->slug);

                return '<a href="' . $detail . '" class="btn btn-sm btn-info">Kunjungi</a>';
            })
            ->addIndexColumn()
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function toko(Request $request, $slug_user = null)
    {
        if ($slug_user) {
            $user = User::where('slug', $slug_user)->firstOrFail();
        } else {
            $data['cari'] = $request->query('cari', '');
            return view('pages.home.toko.user', $data);
        }
        $userId = $user->id;

        // Ambil kategori berdasarkan produk milik user
        $kategori_produk  = DB::table('kategori_produks')
            ->join('produks', 'kategori_produks.id', '=', 'produks.kategori_produk_id')
            ->where('produks.user_id', $userId)
            ->select('kategori_produks.*')
            ->distinct()
            ->get();

        $search = $request->s; // keyword pencarian
        $slug = $request->slug; // kategori slug

        $query = DB::table('produks')
            ->leftJoin('kategori_produks', 'produks.kategori_produk_id', '=', 'kategori_produks.id')
            ->leftJoin('users', 'produks.user_id', '=', 'users.id')
            ->leftJoin('produk_gambars', function ($join) {
                $join->on('produks.id', '=', 'produk_gambars.produk_id')
                    ->whereRaw('produk_gambars.id = (
                            SELECT id FROM produk_gambars
                            WHERE produk_id = produks.id
                            ORDER BY id ASC LIMIT 1
                            )');
            })
            ->where('produks.user_id', $userId);

        // --- Jika slug ada → filter kategori ---
        $current_kategori = null;
        if ($slug) {
            $current_kategori = DB::table('kategori_produks')
                ->where('slug_kategori', $slug)
                ->first();
            if (!$current_kategori) {
                abort(404, 'Kategori tidak ditemukan.');
            }
            $query->where('produks.kategori_produk_id', $current_kategori->id);
        }

        // --- Jika ada keyword pencarian ---
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('produks.nama_produk', 'like', "%$search%")
                    ->orWhere('produks.harga', 'like', "%$search%");
            });
        }

        // --- Eksekusi query ---
        $produks = $query->select(
            'produks.*',
            'kategori_produks.*',
            'users.name',
            'produk_gambars.nama_file as thumbnail'
        )
            ->paginate(12) // <= pagination 12 produk per halaman
            ->withQueryString(); // supaya search & slug tidak hilang ketika pindah halaman

        return view('pages.home.toko.tokoku', [
            'kategori_produk' => $kategori_produk,
            'produks' => $produks,
            'current_kategori' => $current_kategori,
            'slug_user' => $slug_user,
        ]);
    }
}
