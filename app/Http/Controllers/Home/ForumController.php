<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use App\Models\ForumKomentar;
use App\Models\UserTernak;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        // Ambil kata pencarian dari input GET
        $search = $request->get('s');

        $forums = Forum::with(['user', 'komentar'])
            ->when($search, function ($query) use ($search) {
                $query->where('judul', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20)
            ->withQueryString(); // supaya pagination tetap membawa parameter pencarian

        return view('pages.home.forum.index', compact('forums', 'search'));
    }

    public function create()
    {
        if (UserTernak::where('user_id', auth()->user()->id)->count() < 1) {
            return redirect()->route('ternak');
        }
        return view('pages.home.forum.form');
    }
    public function store(Request $request) {
        $request->validate([
            'judul' => ['required']
        ]);
        Forum::create([
            'user_id' => auth()->user()->id,
            'judul' => $request->judul,
            'slug' => strtoupper(Str::random(12)),
            'konten' => $request->konten,
        ]);
        return redirect()->route('forum')->with('sukses', 'Anda berhasil menambahkan data');
    }

    public function destroy(Forum $forum)
    {
        if (auth()->user()->hasRole('admin')) {
            $forum->delete();
            return redirect()->route('forum')->with('sukses', 'Anda berhasil menghapus data');
        }

        if ($forum->user_id !== auth()->user()->id) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus komentar ini');
        }
        $forum->delete();
        return redirect()->route('forum')->with('sukses', 'Thread berhasil dihapus');
    }

    public function detail($slug)
    {
        $forum = Forum::with(['user', 'komentar'])
            ->where('slug', $slug)
            ->firstOrFail();

        $jumlahternak = UserTernak::where('user_id', auth()->user()->id)->count();

        return view('pages.home.forum.detail', compact('forum', 'jumlahternak'));
    }
    public function komentar_store(Request $request, Forum $forum)
    {
        $request->validate([
            'komentar' => ['required']
        ]);
        ForumKomentar::create([
            'user_id' => auth()->user()->id,
            'forum_id' => $forum->id,
            'komentar' => $request->komentar,
        ]);
        return redirect()->route('forum')->with('sukses', 'Anda berhasil menambahkan memberi komentar');
    }
    public function komentar_destroy(ForumKomentar $komentar)
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
}
