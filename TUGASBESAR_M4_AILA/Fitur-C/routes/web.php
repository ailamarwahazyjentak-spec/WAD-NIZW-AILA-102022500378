<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KurirController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\ZonasiController;

// 1. Guest Middleware & Throttle (rate limiting pada form login)
Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])
        ->middleware('throttle:20,1') // maks 20 percobaan per 1 menit
        ->name('login.store');
});

// 2. Proteksi wajib login (auth)
Route::middleware('auth')->group(function (): void {
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

    // Halaman beranda: langsung diarahkan ke katalog ekspedisi
    Route::get('/', function () {
        return redirect()->route('kurir.index');
    });

    // 3. Akses untuk kedua role (role:admin,user): hanya MELIHAT katalog & detail
    Route::middleware('role:admin,user')->group(function (): void {
        Route::resource('kurir', KurirController::class)->only(['index', 'show']);
        Route::resource('layanan', LayananController::class)->only(['index']);
        Route::resource('zonasi', ZonasiController::class)->only(['index']);
    });

    // 4. Akses khusus kurator/admin (role:admin) dengan prefix /admin:
    //    dashboard, tambah, ubah, dan hapus
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function (): void {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('kurir', KurirController::class)->except(['index', 'show']);
        Route::resource('layanan', LayananController::class)->except(['index', 'show']);
        Route::resource('zonasi', ZonasiController::class)->except(['index', 'show']);
    });
});
