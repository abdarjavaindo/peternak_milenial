<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\KategoriKursusController;
use App\Http\Controllers\Dashboard\KategoriProdukController;
use App\Http\Controllers\Home\UserProfileController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\KursusController;
use App\Http\Controllers\Home\TokoController;
use App\Http\Controllers\Dashboard\PembelajaranController;
use App\Http\Controllers\Dashboard\PengajarController;
use App\Http\Controllers\Dashboard\ProdukController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Home\DaftarTernakController;
use App\Http\Controllers\Home\ForumController;
use App\Http\Controllers\Home\TokokuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthenticatedSessionController::class, 'create']);
Route::get('/wilayah/kabupaten', [RegisteredUserController::class, 'kabupaten']);
Route::get('/wilayah/kecamatan', [RegisteredUserController::class, 'kecamatan']);
Route::get('/wilayah/desa', [RegisteredUserController::class, 'desa']);
Route::get('/wilayah/info/{namakabupaten}', [RegisteredUserController::class, 'info']);
Route::middleware(['auth', 'verified'])->post('/upload-image', function (Request $request) {
    if ($request->hasFile('file')) {
        $image = $request->file('file');
        $path = $image->store('uploads', 'public'); // Simpan ke `storage/app/public/uploads`
        return response()->json(['location' => asset('storage/' . $path)]);
    }
    return response()->json(['error' => 'Gagal mengunggah gambar'], 400);
})->name('upload.image');

#region Home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');
Route::get('/galeri', [HomeController::class, 'galeri'])->name('galeri');

Route::prefix('toko')->group(function () {
    Route::get('/', [TokoController::class, 'index'])->name('shop');
    Route::get('/detail/{slug}', [TokoController::class, 'detail'])->name('shop.detail');
    Route::post('/user/loaddata', [TokoController::class, 'loaddata'])->name('shop.loaddata');
    Route::get('/user/{slug_user?}', [TokoController::class, 'toko'])->name('shop.user');
});

Route::middleware(['auth', 'verified'])->prefix('tokoku')->group(function () {
    Route::get('/', [TokokuController::class, 'index'])->name('tokoku');
    Route::get('/create', [TokokuController::class, 'create'])->name('tokoku.create');
    Route::post('/create', [TokokuController::class, 'store'])->name('tokoku.store');
    Route::get('/edit/{produk}', [TokokuController::class, 'edit'])->name('tokoku.edit');
    Route::put('/update/{produk}', [TokokuController::class, 'update'])->name('tokoku.update');
    Route::get('/gambar/{produk_gambar}', [TokokuController::class, 'destroy_gambar'])->name('tokoku.destroy_gambar');
    Route::get('/delete/{produk}', [TokokuController::class, 'destroy'])->name('tokoku.destroy');
});

Route::prefix('kursus')->group(function () {
    Route::get('/', [KursusController::class, 'index'])->name('pelatihan');
    Route::get('/detail/{slug}', [KursusController::class, 'detail'])->name('pelatihan.detail');
    Route::get('/daftar/{slug}', [KursusController::class, 'daftar'])->name('pelatihan.daftar');
    Route::get('/materi/{kursus_materi}', [KursusController::class, 'materi'])->name('pelatihan.materi');
    Route::get('/next/{kursus_materi}', [KursusController::class, 'next'])->name('pelatihan.next');
    Route::post('/selesai/{slug}/{kursus_materi}', [KursusController::class, 'selesai'])->name('pelatihan.selesai');
});

Route::prefix('forum')->group(function () {
    Route::get('/', [ForumController::class, 'index'])->name('forum');
    Route::middleware(['auth', 'verified'])->get('/create', [ForumController::class, 'create'])->name('forum.create');
    Route::middleware(['auth', 'verified'])->post('/store', [ForumController::class, 'store'])->name('forum.store');
    Route::get('/detail/{slug}', [ForumController::class, 'detail'])->name('forum.detail');
    Route::middleware(['auth', 'verified'])->get('/delete/{forum}', [ForumController::class, 'destroy'])->name('forum.destroy');
    // komentar
    Route::middleware(['auth', 'verified'])->post('/komentar/{forum}', [ForumController::class, 'komentar_store'])->name('komentar.store');
    Route::middleware(['auth', 'verified'])->get('/komentar/{komentar}', [ForumController::class, 'komentar_destroy'])->name('komentar.destroy');
});

Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::get('/userprofile', [UserProfileController::class, 'edit'])->name('userprofile.edit');
    Route::patch('/userprofile', [UserProfileController::class, 'update'])->name('userprofile.update');
});

Route::middleware(['auth', 'verified', 'role:user'])->prefix('daftar-ternak')->group(function () {
    Route::get('/', [DaftarTernakController::class, 'index'])->name('ternak');
    Route::post('/loaddata', [DaftarTernakController::class, 'loaddata'])->name('ternak.loaddata');
    Route::get('/create', [DaftarTernakController::class, 'create'])->name('ternak.create');
    Route::post('/create', [DaftarTernakController::class, 'store'])->name('ternak.store');
    Route::get('/edit/{ternak}', [DaftarTernakController::class, 'edit'])->name('ternak.edit');
    Route::put('/update/{ternak}', [DaftarTernakController::class, 'update'])->name('ternak.update');
    Route::delete('/delete/{ternak}', [DaftarTernakController::class, 'destroy'])->name('ternak.destroy');
});
#endregion

#region Dashboard
Route::middleware(['auth', 'verified', 'role:admin'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/license', function () {
    return "Designed by PT Abdar Java Indo";
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('kategori-produk')->group(function () {
    Route::get('/', [KategoriProdukController::class, 'index'])->name('kategori-produk');
    Route::post('/loaddata', [KategoriProdukController::class, 'loaddata'])->name('kategori-produk.loaddata');
    Route::get('/edit/{kategori_produk}', [KategoriProdukController::class, 'edit'])->name('kategori-produk.edit');
    Route::put('/{kategori_produk}', [KategoriProdukController::class, 'update'])->name('kategori-produk.update');
    Route::get('/create', [KategoriProdukController::class, 'create'])->name('kategori-produk.create');
    Route::post('/', [KategoriProdukController::class, 'store'])->name('kategori-produk.store');
    Route::delete('/{kategori_produk}', [KategoriProdukController::class, 'destroy'])->name('kategori-produk.destroy');
});

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('kategori-kursus')->group(function () {
    Route::get('/', [KategoriKursusController::class, 'index'])->name('kategori-kursus');
    Route::post('/loaddata', [KategoriKursusController::class, 'loaddata'])->name('kategori-kursus.loaddata');
    Route::get('/edit/{kategori_kursus}', [KategoriKursusController::class, 'edit'])->name('kategori-kursus.edit');
    Route::put('/{kategori_kursus}', [KategoriKursusController::class, 'update'])->name('kategori-kursus.update');
    Route::get('/create', [KategoriKursusController::class, 'create'])->name('kategori-kursus.create');
    Route::post('/', [KategoriKursusController::class, 'store'])->name('kategori-kursus.store');
    Route::delete('/{kategori_kursus}', [KategoriKursusController::class, 'destroy'])->name('kategori-kursus.destroy');
});

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('pengajar')->group(function () {
    Route::get('/', [PengajarController::class, 'index'])->name('pengajar');
    Route::post('/loaddata', [PengajarController::class, 'loaddata'])->name('pengajar.loaddata');
    Route::get('/edit/{pengajar}', [PengajarController::class, 'edit'])->name('pengajar.edit');
    Route::put('/{pengajar}', [PengajarController::class, 'update'])->name('pengajar.update');
    Route::get('/create', [PengajarController::class, 'create'])->name('pengajar.create');
    Route::post('/', [PengajarController::class, 'store'])->name('pengajar.store');
    Route::delete('/{pengajar}', [PengajarController::class, 'destroy'])->name('pengajar.destroy');
});

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user');
    Route::post('/loaddata', [UserController::class, 'loaddata'])->name('user.loaddata');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('user.update');
    Route::get('/change/{user}', [UserController::class, 'change'])->name('user.change');
    Route::get('/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/', [UserController::class, 'store'])->name('user.store');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/level/{user}', [UserController::class, 'level'])->name('user.level');
    Route::post('/level/{user}', [UserController::class, 'levelstore'])->name('user.levelstore');
});

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('produk')->group(function () {
    Route::get('/', [ProdukController::class, 'index'])->name('produk');
    Route::post('/loaddata', [ProdukController::class, 'loaddata'])->name('produk.loaddata');
    Route::get('/edit/{produk}', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/{produk}', [ProdukController::class, 'update'])->name('produk.update');
    Route::get('/change/{produk}', [ProdukController::class, 'change'])->name('produk.change');
    // Route::get('/create', [ProdukController::class, 'create'])->name('vendor.create');
    // Route::post('/', [ProdukController::class, 'store'])->name('vendor.store');
    Route::delete('/{produk}', [ProdukController::class, 'destroy'])->name('produk.destroy');
    Route::get('/gambar/{produk_gambar}', [ProdukController::class, 'destroy_gambar'])->name('produk.destroy_gambar');
});

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('pembelajaran')->group(function () {
    Route::get('/', [PembelajaranController::class, 'index'])->name('pembelajaran');
    Route::post('/loaddata', [PembelajaranController::class, 'loaddata'])->name('pembelajaran.loaddata');
    Route::get('/create', [PembelajaranController::class, 'create'])->name('pembelajaran.create');
    Route::post('/', [PembelajaranController::class, 'store'])->name('pembelajaran.store');
    Route::get('/edit/{kursus}', [PembelajaranController::class, 'edit'])->name('pembelajaran.edit');
    Route::put('/{kursus}', [PembelajaranController::class, 'update'])->name('pembelajaran.update');
    Route::delete('/{kursus}', [PembelajaranController::class, 'destroy'])->name('pembelajaran.destroy');
    //bagian peserta
    Route::get('/peserta/{kursus}', [PembelajaranController::class, 'peserta'])->name('peserta');
    Route::post('/peserta-loaddata/{kursus}', [PembelajaranController::class, 'peserta_loaddata'])->name('peserta.loaddata');
    Route::delete('/peserta/{kursus}/{user}', [PembelajaranController::class, 'peserta_destroy'])->name('peserta.destroy');
    //bagian kursus
    Route::get('/bagian/{kursus}', [PembelajaranController::class, 'bagian'])->name('bagian');
    Route::post('/bagian-loaddata/{kursus}', [PembelajaranController::class, 'bagian_loaddata'])->name('bagian.loaddata');
    Route::get('/bagian-create/{kursus}', [PembelajaranController::class, 'bagian_create'])->name('bagian.create');
    Route::post('/bagian/{kursus}', [PembelajaranController::class, 'bagian_store'])->name('bagian.store');
    Route::get('/bagian-edit/{bagian}', [PembelajaranController::class, 'bagian_edit'])->name('bagian.edit');
    Route::put('/bagian/{bagian}', [PembelajaranController::class, 'bagian_update'])->name('bagian.update');
    Route::delete('/bagian/{bagian}', [PembelajaranController::class, 'bagian_destroy'])->name('bagian.destroy');
    //bagian materi
    Route::get('/materi/{bagian}', [PembelajaranController::class, 'materi'])->name('materi');
    Route::post('/materi-loaddata/{bagian}', [PembelajaranController::class, 'materi_loaddata'])->name('materi.loaddata');
    Route::get('/materi-create/{bagian}', [PembelajaranController::class, 'materi_create'])->name('materi.create');
    Route::post('/materi/{bagian}', [PembelajaranController::class, 'materi_store'])->name('materi.store');
    Route::get('/materi-edit/{materi}', [PembelajaranController::class, 'materi_edit'])->name('materi.edit');
    Route::put('/materi/{materi}', [PembelajaranController::class, 'materi_update'])->name('materi.update');
    Route::delete('/materi/{materi}', [PembelajaranController::class, 'materi_destroy'])->name('materi.destroy');
});
#endregion

require __DIR__ . '/auth.php';
