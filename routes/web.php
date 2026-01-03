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
use App\Http\Controllers\CronCrontroller;
use App\Http\Controllers\Dashboard\FiturController;
use App\Http\Controllers\Dashboard\GaleriController;
use App\Http\Controllers\Dashboard\HewanController;
use App\Http\Controllers\Dashboard\PengaturanController;
use App\Http\Controllers\Dashboard\TestimoniController;

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

Route::get('/run-course-checker', function (Request $request) {
    $token = $request->query('token');
    if ($token !== env('CRON_JOB_TOKEN')) {
        abort(403, 'Unauthorized');
    }
    // Redirect ke controller jika token valid
    return app(CronCrontroller::class)->cek_kursus_progres();
});

#region Home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');
Route::get('/albumgaleri', [HomeController::class, 'galeri'])->name('lihatgaleri');

Route::prefix('toko')->group(function () {
    Route::get('/', [TokoController::class, 'index'])->name('shop');
    Route::get('/detail/{slug}', [TokoController::class, 'detail'])->name('shop.detail');
    Route::post('/user/loaddata', [TokoController::class, 'loaddata'])->name('shop.loaddata');
    Route::get('/user/{slug_user?}', [TokoController::class, 'toko'])->name('shop.user');
    // komentar
    Route::middleware(['auth', 'verified'])->post('/komentar/{produk}', [TokoController::class, 'komentar_store'])->name('shop.komentar.store');
    Route::middleware(['auth', 'verified'])->get('/komentar/{komentar}', [TokoController::class, 'komentar_destroy'])->name('shop.komentar.destroy');
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
    Route::get('/reset/{slug}', [KursusController::class, 'reset'])->name('pelatihan.reset');
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

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('hewan')->group(function () {
    Route::get('/', [HewanController::class, 'index'])->name('hewan');
    Route::post('/loaddata', [HewanController::class, 'loaddata'])->name('hewan.loaddata');
    Route::get('/edit/{hewan}', [HewanController::class, 'edit'])->name('hewan.edit');
    Route::put('/{hewan}', [HewanController::class, 'update'])->name('hewan.update');
    Route::get('/create', [HewanController::class, 'create'])->name('hewan.create');
    Route::post('/', [HewanController::class, 'store'])->name('hewan.store');
    Route::delete('/{hewan}', [HewanController::class, 'destroy'])->name('hewan.destroy');
});

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('galeri')->group(function () {
    Route::get('/', [GaleriController::class, 'index'])->name('galeri');
    Route::post('/loaddata', [GaleriController::class, 'loaddata'])->name('galeri.loaddata');
    Route::get('/edit/{galeri}', [GaleriController::class, 'edit'])->name('galeri.edit');
    Route::put('/{galeri}', [GaleriController::class, 'update'])->name('galeri.update');
    Route::get('/create', [GaleriController::class, 'create'])->name('galeri.create');
    Route::post('/', [GaleriController::class, 'store'])->name('galeri.store');
    Route::delete('/{galeri}', [GaleriController::class, 'destroy'])->name('galeri.destroy');
});

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('pengaturan')->group(function () {
    Route::get('/{pengaturan}', [PengaturanController::class, 'edit'])->name('pengaturan.edit');
    Route::put('/{pengaturan}', [PengaturanController::class, 'update'])->name('pengaturan.update');
});

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('pengaturan-kontak')->group(function () {
    Route::get('/{pengaturan}', [PengaturanController::class, 'kontak_edit'])->name('pengaturan.kontak_edit');
    Route::put('/{pengaturan}', [PengaturanController::class, 'kontak_update'])->name('pengaturan.kontak_update');
});

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('testimoni')->group(function () {
    Route::get('/', [TestimoniController::class, 'index'])->name('testimoni');
    Route::post('/loaddata', [TestimoniController::class, 'loaddata'])->name('testimoni.loaddata');
    Route::get('/edit/{testimoni}', [TestimoniController::class, 'edit'])->name('testimoni.edit');
    Route::put('/{testimoni}', [TestimoniController::class, 'update'])->name('testimoni.update');
    Route::get('/create', [TestimoniController::class, 'create'])->name('testimoni.create');
    Route::post('/', [TestimoniController::class, 'store'])->name('testimoni.store');
    Route::delete('/{testimoni}', [TestimoniController::class, 'destroy'])->name('testimoni.destroy');
});

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('fitur')->group(function () {
    Route::get('/', [FiturController::class, 'index'])->name('fitur');
    Route::post('/loaddata', [FiturController::class, 'loaddata'])->name('fitur.loaddata');
    Route::get('/edit/{fitur}', [FiturController::class, 'edit'])->name('fitur.edit');
    Route::put('/{fitur}', [FiturController::class, 'update'])->name('fitur.update');
    Route::get('/create', [FiturController::class, 'create'])->name('fitur.create');
    Route::post('/', [FiturController::class, 'store'])->name('fitur.store');
    Route::delete('/{fitur}', [FiturController::class, 'destroy'])->name('fitur.destroy');
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
    // komuditas
    // Route::get('/komuditas/{user}', [UserController::class, 'komuditas'])->name('user.komuditas');
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
