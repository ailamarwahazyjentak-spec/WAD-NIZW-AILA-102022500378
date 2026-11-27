@extends('layouts.app')

@section('judul', 'Daftar Zonasi Pengiriman')

@section('konten')
{{-- Kontainer utama katalog daftar zonasi wilayah dan tarif ongkos kirim --}}
<div class="container">
    {{-- Kepala halaman zonasi & tarif dan tombol tambah khusus admin --}}
    <div class="header-flex">
        <div>
            <h2>Zonasi &amp; Tarif Pengiriman</h2>
            <p class="subtitle">Atur ongkos kirim berdasarkan cakupan wilayah provinsi dan kota</p>
        </div>
        @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.zonasi.create') }}" class="btn-tambah">+ Tambah Zonasi Baru</a>
        @endif
    </div>

    {{-- Tabel daftar cakupan provinsi, kota tujuan, dan nominal tarif ongkir --}}
    <div class="table-wrap">
        <table class="tabel-kurir">
            <thead>
                <tr>
                    <th class="col-no text-center">No</th>
                    <th>Ekspedisi &amp; Layanan</th>
                    <th>Provinsi Tujuan</th>
                    <th>Kota Tujuan</th>
                    <th class="text-right">Tarif Biaya Ongkir</th>
                    @if(auth()->user()->isAdmin())
                        <th class="col-aksi text-right"><span class="sr-only">Aksi</span></th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($daftar_zonasi as $indeks => $zonasi)
                <tr>
                    <td class="text-center">{{ $indeks + 1 }}</td>
                    <td>
                        <span class="badge mono">{{ $zonasi->layanan->kurir->kode_kurir }}</span>
                        <span class="text-bold">{{ $zonasi->layanan->nama_layanan }}</span>
                        <small class="text-muted">({{ $zonasi->layanan->estimasi_waktu }})</small>
                    </td>
                    <td>{{ $zonasi->nama_provinsi }}</td>
                    <td class="text-bold">{{ $zonasi->nama_kota }}</td>
                    <td class="text-right harga">Rp {{ number_format($zonasi->biaya_ongkir, 0, ',', '.') }}</td>
                    @if(auth()->user()->isAdmin())
                    <td class="text-right">
                        {{-- Tombol ubah dan formulir hapus data zonasi tarif khusus admin --}}
                        <div class="aksi">
                            <a href="{{ route('admin.zonasi.edit', $zonasi->id) }}" class="btn-edit" title="Ubah Tarif">Ubah</a>
                            <form action="{{ route('admin.zonasi.destroy', $zonasi->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data zonasi tarif ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" title="Hapus Tarif">Hapus</button>
                            </form>
                        </div>
                    </td>
                    @endif
                </tr>
                @empty
                {{-- Baris pesan kosong dengan lebar kolom menyesuaikan role pengguna --}}
                <tr>
                    <td colspan="{{ auth()->user()->isAdmin() ? 6 : 5 }}" class="empty-data">
                        @if(auth()->user()->isAdmin())
                            Belum ada zonasi wilayah pengiriman. Silakan klik "Tambah Zonasi Baru".
                        @else
                            Belum ada data zonasi dan tarif pengiriman saat ini.
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection