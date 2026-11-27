<?php

namespace App\Http\Controllers;

use App\Models\Kurir;
use Illuminate\Http\Request;

class KurirController extends Controller
{
    public function index()
    {
        $daftar_kurir = Kurir::withCount('daftarLayanan')->latest()->get();
        return view('kurir.index', compact('daftar_kurir'));
    }

    public function show($id)
    {
        $kurir = Kurir::with('daftarLayanan.daftarZonasi')->findOrFail($id);
        return view('kurir.show', compact('kurir'));
    }

    public function create()
    {
        return view('kurir.create');
    }

    public function store(Request $permintaan)
    {
        $permintaan->validate([
            'kode_kurir'   => 'required|max:20|unique:kurir,kode_kurir',
            'nama_kurir'   => 'required|max:100',
            'telepon'      => 'required|max:25',
            'status_aktif' => 'required|boolean',
        ], [
            'kode_kurir.required' => 'Kode kurir wajib diisi.',
            'kode_kurir.unique'   => 'Kode kurir ini sudah terdaftar.',
            'nama_kurir.required' => 'Nama kurir wajib diisi.',
            'telepon.required'    => 'Nomor telepon wajib diisi.',
            'status_aktif.required' => 'Status aktif wajib dipilih.',
        ]);

        Kurir::create([
            'kode_kurir'   => strtoupper($permintaan->kode_kurir),
            'nama_kurir'   => $permintaan->nama_kurir,
            'telepon'      => $permintaan->telepon,
            'status_aktif' => $permintaan->status_aktif,
        ]);

        return redirect()->route('kurir.index')->with('sukses', 'Data kurir berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kurir = Kurir::findOrFail($id);
        return view('kurir.edit', compact('kurir'));
    }

    public function update(Request $permintaan, $id)
    {
        $kurir = Kurir::findOrFail($id);

        $permintaan->validate([
            'kode_kurir'   => 'required|max:20|unique:kurir,kode_kurir,' . $kurir->id,
            'nama_kurir'   => 'required|max:100',
            'telepon'      => 'required|max:25',
            'status_aktif' => 'required|boolean',
        ], [
            'kode_kurir.required' => 'Kode kurir wajib diisi.',
            'kode_kurir.unique'   => 'Kode kurir sudah digunakan oleh kurir lain.',
            'nama_kurir.required' => 'Nama kurir wajib diisi.',
            'telepon.required'    => 'Nomor telepon wajib diisi.',
            'status_aktif.required' => 'Status aktif wajib dipilih.',
        ]);

        $kurir->update([
            'kode_kurir'   => strtoupper($permintaan->kode_kurir),
            'nama_kurir'   => $permintaan->nama_kurir,
            'telepon'      => $permintaan->telepon,
            'status_aktif' => $permintaan->status_aktif,
        ]);

        return redirect()->route('kurir.index')->with('sukses', 'Data kurir berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kurir = Kurir::findOrFail($id);
        $kurir->delete();

        return redirect()->route('kurir.index')->with('sukses', 'Data kurir dan seluruh layanannya berhasil dihapus!');
    }
}
