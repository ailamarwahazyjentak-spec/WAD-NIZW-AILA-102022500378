<?php

namespace App\Http\Controllers;

use App\Models\Kurir;
use App\Models\Layanan;
use App\Models\Zonasi;

class DashboardController extends Controller
{
    // Dashboard khusus admin (dilindungi middleware 'role:admin')
    public function index()
    {
        $total_kurir   = Kurir::count();
        $kurir_aktif   = Kurir::where('status_aktif', true)->count();
        $total_layanan = Layanan::count();
        $total_zonasi  = Zonasi::count();

        return view('admin.dashboard', compact('total_kurir', 'kurir_aktif', 'total_layanan', 'total_zonasi'));
    }
}
