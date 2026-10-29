
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;


Route::resource('pelanggan', PelangganController::class);
Route::get('/', [PelangganController::class, 'index']);
    
