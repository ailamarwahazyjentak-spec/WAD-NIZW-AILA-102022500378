@extends('layouts.app')

@section('judul', 'Daftar Jenis Layanan')

@section('konten')
{{-- Kontainer utama katalog daftar jenis layanan pengiriman --}}
<div class="container">
    {{-- Kepala halaman jenis layanan dan tombol tambah khusus admin --}}
    <div class="header-flex">
        <div>
            <h2>Jenis Layanan Pengiriman</h2>
            <p class="subtitle">Kelola paket pengiriman (Reguler, Express, Kargo, dan lainnya)</p>
        </div>
        @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.layanan.create') }}" class="btn-tambah">+ Tambah Layanan Baru</a>
        @endif
    </div>

    {{-- Tabel daftar jenis layanan beserta kurir pemilik, estimasi, dan jumlah zonasi --}}
    <div class="table-wrap">
        <table class="tabel-kurir">
            <thead>
                <tr>
                    <th class="col-no text-center">No</th>
                    <th class="text-center">Ekspedisi</th>
                    <th>Nama Layanan</th>
                    <th>Estimasi Waktu</th>
                    <th>Deskripsi</th>
                    <th class="text-center">Jumlah Zonasi</th>
                    @if(auth()->user()->isAdmin())
                        <th class="col-aksi text-right"><span class="sr-only">Aksi</span></th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($daftar_layanan as $indeks => $layanan)
                <tr>
                    <td class="text-center">{{ $indeks + 1 }}</td>
                    <td class="text-center">
                        <span class="badge mono" title="{{ $layanan->kurir->nama_kurir }}">{{ $layanan->kurir->kode_kurir }}</span>
                    </td>
                    <td class="text-bold">{{ $layanan->nama_layanan }}</td>
                    <td>{{ $layanan->estimasi_waktu }}</td>
                    <td>{{ $layanan->deskripsi ?? '-' }}</td>
                    <td class="text-center">
                        <span class="badge badge-info">{{ $layanan->daftar_zonasi_count }} Titik Kota</span>
                    </td>
                    @if(auth()->user()->isAdmin())
                    <td class="text-right">
                        {{-- Tombol ubah dan formulir hapus jenis layanan khusus admin --}}
                        <div class="aksi">
                            <a href="{{ route('admin.layanan.edit', $layanan->id) }}" class="btn-edit" title="Ubah Layanan">Ubah</a>
                            <form action="{{ route('admin.layanan.destroy', $layanan->id) }}" method="POST" onsubmit="return confirm('Hapus jenis layanan ini beserta tarif zonasinya?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" title="Hapus Layanan">Hapus</button>
                            </form>
                        </div>
                    </td>
                    @endif
                </tr>
                @empty
                {{-- Baris pesan kosong dengan lebar kolom menyesuaikan role pengguna --}}
                <tr>
                    <td colspan="{{ auth()->user()->isAdmin() ? 7 : 6 }}" class="empty-data">
                        @if(auth()->user()->isAdmin())
                            Belum ada layanan yang ditambahkan. Silakan klik "Tambah Layanan Baru".
                        @else
                            Belum ada jenis layanan yang tersedia saat ini.
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection