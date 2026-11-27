<?php

namespace App\Http\Controllers;

use App\Models\Kurir;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $daftar_layanan = Layanan::with('kurir')->withCount('daftarZonasi')->latest()->get();
        return view('layanan.index', compact('daftar_layanan'));
    }

    public function create()
    {
        $daftar_kurir = Kurir::where('status_aktif', true)->get();
        return view('layanan.create', compact('daftar_kurir'));
    }

    public function store(Request $permintaan)
    {
        $permintaan->validate([
            'kurir_id'       => 'required|exists:kurir,id',
            'nama_layanan'   => 'required|max:100',
            'estimasi_waktu' => 'required|max:50',
            'deskripsi'      => 'nullable|max:255',
        ], [
            'kurir_id.required'       => 'Pilihan kurir ekspedisi wajib dipilih.',
            'kurir_id.exists'         => 'Kurir yang dipilih tidak valid.',
            'nama_layanan.required'   => 'Nama jenis layanan wajib diisi.',
            'estimasi_waktu.required' => 'Estimasi waktu pengiriman wajib diisi.',
        ]);

        Layanan::create([
            'kurir_id'       => $permintaan->kurir_id,
            'nama_layanan'   => $permintaan->nama_layanan,
            'estimasi_waktu' => $permintaan->estimasi_waktu,
            'deskripsi'      => $permintaan->deskripsi,
        ]);

        return redirect()->route('layanan.index')->with('sukses', 'Jenis layanan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);
        $daftar_kurir = Kurir::where('status_aktif', true)->get();
        return view('layanan.edit', compact('layanan', 'daftar_kurir'));
    }

    public function update(Request $permintaan, $id)
    {
        $layanan = Layanan::findOrFail($id);

        $permintaan->validate([
            'kurir_id'       => 'required|exists:kurir,id',
            'nama_layanan'   => 'required|max:100',
            'estimasi_waktu' => 'required|max:50',
            'deskripsi'      => 'nullable|max:255',
        ], [
            'kurir_id.required'       => 'Pilihan kurir ekspedisi wajib dipilih.',
            'kurir_id.exists'         => 'Kurir yang dipilih tidak valid.',
            'nama_layanan.required'   => 'Nama jenis layanan wajib diisi.',
            'estimasi_waktu.required' => 'Estimasi waktu pengiriman wajib diisi.',
        ]);

        $layanan->update([
            'kurir_id'       => $permintaan->kurir_id,
            'nama_layanan'   => $permintaan->nama_layanan,
            'estimasi_waktu' => $permintaan->estimasi_waktu,
            'deskripsi'      => $permintaan->deskripsi,
        ]);

        return redirect()->route('layanan.index')->with('sukses', 'Jenis layanan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();

        return redirect()->route('layanan.index')->with('sukses', 'Jenis layanan berhasil dihapus!');
    }
}
