<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
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

Route::get('/', [AuthenticatedSessionController::class, 'create']);
Route::get('/license', function () {
    return "Designed by PT Abdar Java Indo";
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user');
    Route::post('/loaddata', [UserController::class, 'loaddata'])->name('user.loaddata');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('user.update');
    Route::get('/change/{user}', [UserController::class, 'change'])->name('user.change');
    Route::get('/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/', [UserController::class, 'store'])->name('user.store');
});

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('vendor')->group(function () {
    Route::get('/', [VendorController::class, 'index'])->name('vendor');
    Route::post('/loaddata', [VendorController::class, 'loaddata'])->name('vendor.loaddata');
    Route::get('/edit/{vendor}', [VendorController::class, 'edit'])->name('vendor.edit');
    Route::put('/{vendor}', [VendorController::class, 'update'])->name('vendor.update');
    Route::get('/change/{vendor}', [VendorController::class, 'change'])->name('vendor.change');
    Route::get('/create', [VendorController::class, 'create'])->name('vendor.create');
    Route::post('/', [VendorController::class, 'store'])->name('vendor.store');
    Route::delete('/{vendor}', [VendorController::class, 'destroy'])->name('vendor.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/pengadaan', [PengadaanController::class, 'index'])->name('pengadaan');
    Route::post('/pengadaan/loaddata', [PengadaanController::class, 'loaddata'])->name('pengadaan.loaddata');
    Route::post('/pengadaan', [PengadaanController::class, 'store'])->name('pengadaan.store');
});
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::get('/pengadaan/create', [PengadaanController::class, 'create'])->name('pengadaan.create');
    Route::post('/', [PengadaanController::class, 'store'])->name('pengadaan.store');
});

Route::middleware(['auth', 'verified'])->prefix('kpa')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('kpa');
});
Route::middleware(['auth', 'verified'])->prefix('kegiatan')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('kegiatan');
});

require __DIR__ . '/auth.php';
