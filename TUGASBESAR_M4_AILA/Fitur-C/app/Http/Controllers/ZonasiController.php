<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Zonasi;
use Illuminate\Http\Request;

class ZonasiController extends Controller
{
    public function index()
    {
        $daftar_zonasi = Zonasi::with('layanan.kurir')->latest()->get();
        return view('zonasi.index', compact('daftar_zonasi'));
    }

    public function create()
    {
        $daftar_layanan = Layanan::with('kurir')->get();
        return view('zonasi.create', compact('daftar_layanan'));
    }

    public function store(Request $permintaan)
    {
        $permintaan->validate([
            'layanan_id'    => 'required|exists:layanan,id',
            'nama_provinsi' => 'required|max:100',
            'nama_kota'     => 'required|max:100',
            'biaya_ongkir'  => 'required|numeric|min:0',
        ], [
            'layanan_id.required'    => 'Jenis layanan kurir wajib dipilih.',
            'layanan_id.exists'      => 'Jenis layanan tidak valid.',
            'nama_provinsi.required' => 'Nama provinsi wajib diisi.',
            'nama_kota.required'     => 'Nama kota tujuan wajib diisi.',
            'biaya_ongkir.required'  => 'Biaya ongkos kirim wajib diisi.',
            'biaya_ongkir.numeric'   => 'Biaya ongkir harus berupa angka.',
            'biaya_ongkir.min'       => 'Biaya ongkir minimal Rp 0.',
        ]);

        Zonasi::create([
            'layanan_id'    => $permintaan->layanan_id,
            'nama_provinsi' => $permintaan->nama_provinsi,
            'nama_kota'     => $permintaan->nama_kota,
            'biaya_ongkir'  => $permintaan->biaya_ongkir,
        ]);

        return redirect()->route('zonasi.index')->with('sukses', 'Zonasi dan tarif pengiriman berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $zonasi = Zonasi::findOrFail($id);
        $daftar_layanan = Layanan::with('kurir')->get();
        return view('zonasi.edit', compact('zonasi', 'daftar_layanan'));
    }

    public function update(Request $permintaan, $id)
    {
        $zonasi = Zonasi::findOrFail($id);

        $permintaan->validate([
            'layanan_id'    => 'required|exists:layanan,id',
            'nama_provinsi' => 'required|max:100',
            'nama_kota'     => 'required|max:100',
            'biaya_ongkir'  => 'required|numeric|min:0',
        ], [
            'layanan_id.required'    => 'Jenis layanan kurir wajib dipilih.',
            'layanan_id.exists'      => 'Jenis layanan tidak valid.',
            'nama_provinsi.required' => 'Nama provinsi wajib diisi.',
            'nama_kota.required'     => 'Nama kota tujuan wajib diisi.',
            'biaya_ongkir.required'  => 'Biaya ongkos kirim wajib diisi.',
            'biaya_ongkir.numeric'   => 'Biaya ongkir harus berupa angka.',
            'biaya_ongkir.min'       => 'Biaya ongkir minimal Rp 0.',
        ]);

        $zonasi->update([
            'layanan_id'    => $permintaan->layanan_id,
            'nama_provinsi' => $permintaan->nama_provinsi,
            'nama_kota'     => $permintaan->nama_kota,
            'biaya_ongkir'  => $permintaan->biaya_ongkir,
        ]);

        return redirect()->route('zonasi.index')->with('sukses', 'Zonasi dan tarif pengiriman berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $zonasi = Zonasi::findOrFail($id);
        $zonasi->delete();

        return redirect()->route('zonasi.index')->with('sukses', 'Zonasi pengiriman berhasil dihapus!');
    }
}