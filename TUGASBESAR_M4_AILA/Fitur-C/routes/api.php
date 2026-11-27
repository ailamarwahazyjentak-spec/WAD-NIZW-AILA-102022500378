<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EkspedisiApiController;

// Endpoint REST API Publik untuk Ekspedisi
// Tetap publik (untuk integrasi modul lain), tapi dibatasi 60 request per menit
Route::prefix('ekspedisi')->middleware('throttle:60,1')->group(function () {
    Route::get('/kurir', [EkspedisiApiController::class, 'ambilSemuaKurir']);
    Route::get('/kurir/{id}', [EkspedisiApiController::class, 'ambilKurirBerdasarkanId']);
    Route::get('/cek-ongkir', [EkspedisiApiController::class, 'cekOngkir']);
});
