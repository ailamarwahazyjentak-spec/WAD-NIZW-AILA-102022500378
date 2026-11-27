@extends('layouts.app')

@section('judul', 'Daftar Ekspedisi')

@section('konten')
{{-- Kontainer utama katalog daftar mitra ekspedisi --}}
<div class="container">
    {{-- Kepala halaman daftar ekspedisi dan tombol tambah khusus admin --}}
    <div class="header-flex">
        <div>
            <h2>Ekspedisi</h2>
            <p class="subtitle">Daftar mitra ekspedisi dan status layanan pengiriman</p>
        </div>
        @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.kurir.create') }}" class="btn-tambah">+ Tambah Kurir Baru</a>
        @endif
    </div>

    {{-- Tabel daftar ekspedisi beserta jumlah layanan, status, dan aksi admin --}}
    <div class="table-wrap">
        <table class="tabel-kurir">
            <thead>
                <tr>
                    <th class="col-no text-center">No</th>
                    <th class="text-center">Kode</th>
                    <th>Nama</th>
                    <th>Nomor Telepon</th>
                    <th class="text-center">Jumlah Layanan</th>
                    <th class="text-center">Status</th>
                    @if(auth()->user()->isAdmin())
                        <th class="col-aksi text-right"><span class="sr-only">Aksi</span></th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($daftar_kurir as $indeks => $kurir)
                <tr>
                    <td class="text-center">{{ $indeks + 1 }}</td>
                    <td class="text-center"><span class="badge mono">{{ $kurir->kode_kurir }}</span></td>
                    <td class="text-bold"><a href="{{ route('kurir.show', $kurir->id) }}">{{ $kurir->nama_kurir }}</a></td>
                    <td>{{ $kurir->telepon }}</td>
                    <td class="text-center">
                        <span class="badge badge-info">{{ $kurir->daftar_layanan_count }} Layanan</span>
                    </td>
                    <td class="text-center">
                        @if($kurir->status_aktif)
                            <span class="badge badge-success">Aktif</span>
                        @else
                            <span class="badge badge-danger">Nonaktif</span>
                        @endif
                    </td>
                    @if(auth()->user()->isAdmin())
                    <td class="text-right">
                        {{-- Tombol ubah dan formulir hapus data kurir khusus admin --}}
                        <div class="aksi">
                            <a href="{{ route('admin.kurir.edit', $kurir->id) }}" class="btn-edit" title="Ubah Data">Ubah</a>
                            <form action="{{ route('admin.kurir.destroy', $kurir->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kurir ini? Semua layanan dan zonasinya akan ikut terhapus!');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" title="Hapus Data">Hapus</button>
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
                            Belum ada data kurir. Klik tombol "Tambah Kurir Baru" di atas.
                        @else
                            Belum ada data kurir yang tersedia saat ini.
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection