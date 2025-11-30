<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\KategoriProdukController;
use App\Http\Controllers\Home\UserProfileController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\KursusController;
use App\Http\Controllers\Home\TokoController;
use App\Http\Controllers\Dashboard\PembelajaranController;
use App\Http\Controllers\Dashboard\ProdukController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Home\TokokuController;
use Illuminate\Support\Facades\Route;

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

#region Home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');

Route::prefix('toko')->group(function () {
    Route::get('/', [TokoController::class, 'index'])->name('shop');
    Route::get('/detail/{slug}', [TokoController::class, 'detail'])->name('shop.detail');
    Route::get('/user/{user_id}', [TokoController::class, 'toko'])->name('shop.user');
});

Route::middleware(['auth', 'verified'])->prefix('tokoku')->group(function () {
    Route::get('/', [TokokuController::class, 'index'])->name('tokoku');
    Route::get('/create', [TokokuController::class, 'create'])->name('tokoku.create');
    Route::post('/create', [TokokuController::class, 'store'])->name('tokoku.store');
});

Route::prefix('kursus')->group(function () {
    Route::get('/', [KursusController::class, 'index'])->name('pelatihan');
    Route::get('/detail', [KursusController::class, 'detail'])->name('pelatihan.detail');
});

Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::get('/userprofile', [UserProfileController::class, 'edit'])->name('userprofile.edit');
    Route::patch('/userprofile', [UserProfileController::class, 'update'])->name('userprofile.update');
});
#endregion

#region Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
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
    Route::get('/', [ProdukController::class, 'index'])->name('vendor');
    Route::post('/loaddata', [ProdukController::class, 'loaddata'])->name('vendor.loaddata');
    Route::get('/edit/{vendor}', [ProdukController::class, 'edit'])->name('vendor.edit');
    Route::put('/{vendor}', [ProdukController::class, 'update'])->name('vendor.update');
    Route::get('/change/{vendor}', [ProdukController::class, 'change'])->name('vendor.change');
    Route::get('/create', [ProdukController::class, 'create'])->name('vendor.create');
    Route::post('/', [ProdukController::class, 'store'])->name('vendor.store');
    Route::delete('/{vendor}', [ProdukController::class, 'destroy'])->name('vendor.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/pembelajaran', [PembelajaranController::class, 'index'])->name('pengadaan');
    Route::post('/pembelajaran/loaddata', [PembelajaranController::class, 'loaddata'])->name('pengadaan.loaddata');
    Route::post('/pembelajaran', [PembelajaranController::class, 'store'])->name('pengadaan.store');
});
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::get('/pengadaan/create', [PembelajaranController::class, 'create'])->name('pengadaan.create');
    Route::post('/', [PembelajaranController::class, 'store'])->name('pengadaan.store');
});
#endregion

require __DIR__ . '/auth.php';
