+<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;

Route::resource('pelanggan', PelangganController::class);
Route::get('/', [PelangganController::class, 'index']);

// Route middleware dinonaktifkan sementara untuk testing
// Route::middleware(['nama.alias'])->group(function () {
//     Route::get('/pelanggan/create', [PelangganController::class, 'create']);
// });