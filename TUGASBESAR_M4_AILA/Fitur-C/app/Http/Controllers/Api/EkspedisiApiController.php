<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kurir;
use App\Models\Zonasi;
use Illuminate\Http\Request;

class EkspedisiApiController extends Controller
{
    // API 1: Mendapatkan semua daftar kurir beserta layanannya
    public function ambilSemuaKurir()
    {
        $kurir = Kurir::with('daftarLayanan.daftarZonasi')
                      ->where('status_aktif', true)
                      ->get();

        return response()->json([
            'status'  => 'sukses',
            'pesan'   => 'Daftar kurir dan layanan berhasil diambil',
            'data'    => $kurir
        ], 200);
    }

    // API 2: Mendapatkan detail kurir spesifik berdasarkan ID
    public function ambilKurirBerdasarkanId($id)
    {
        $kurir = Kurir::with('daftarLayanan.daftarZonasi')->find($id);

        if (!$kurir) {
            return response()->json([
                'status'  => 'gagal',
                'pesan'   => 'Kurir tidak ditemukan',
                'data'    => null
            ], 404);
        }

        return response()->json([
            'status'  => 'sukses',
            'pesan'   => 'Detail kurir berhasil ditemukan',
            'data'    => $kurir
        ], 200);
    }

    // API 3: Fitur Cek Ongkos Kirim (Sangat berguna untuk integrasi dengan anggota kelompok lain!)
    public function cekOngkir(Request $permintaan)
    {
        $kota_tujuan = $permintaan->query('kota');

        if (!$kota_tujuan) {
            return response()->json([
                'status' => 'gagal',
                'pesan'  => 'Parameter kota tujuan wajib disertakan, contoh: ?kota=Bandung',
                'data'   => null
            ], 400);
        }

        $daftar_ongkir = Zonasi::with('layanan.kurir')
            ->where('nama_kota', 'LIKE', '%' . $kota_tujuan . '%')
            ->get();

        return response()->json([
            'status' => 'sukses',
            'pesan'  => 'Hasil pengecekan tarif ongkos kirim ke ' . $kota_tujuan,
            'total'  => $daftar_ongkir->count(),
            'data'   => $daftar_ongkir
        ], 200);
    }
}
