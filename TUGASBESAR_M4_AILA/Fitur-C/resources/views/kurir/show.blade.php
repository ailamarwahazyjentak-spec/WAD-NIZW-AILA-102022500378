@extends('layouts.app')

@section('judul', 'Detail Ekspedisi')

@section('konten')
{{-- Kontainer halaman rincian profil kurir, layanan, dan tarif zonasi --}}
<div class="container">
    {{-- Kepala halaman detail yang menampilkan nama, kode, telepon, status, dan tombol ubah --}}
    <div class="header-flex">
        <div>
            <h2>{{ $kurir->nama_kurir }}</h2>
            <div class="meta-inline">
                <span>Kode <span class="badge mono">{{ $kurir->kode_kurir }}</span></span>
                <span class="meta-sep">&middot;</span>
                <span>Telp {{ $kurir->telepon }}</span>
                <span class="meta-sep">&middot;</span>
                @if($kurir->status_aktif)
                    <span class="badge badge-success">Aktif</span>
                @else
                    <span class="badge badge-danger">Nonaktif</span>
                @endif
            </div>
        </div>

        <div class="header-actions">
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.kurir.edit', $kurir->id) }}" class="btn-edit">Ubah Data</a>
            @endif
        </div>
    </div>

    {{-- Tabel rincian jenis layanan beserta daftar tujuan kota dan ongkos kirim --}}
    <div class="table-wrap">
        <table class="tabel-kurir">
            <thead>
                <tr>
                    <th>Jenis Layanan</th>
                    <th class="text-center">Estimasi</th>
                    <th>Tujuan &amp; Tarif</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kurir->daftarLayanan as $layanan)
                <tr>
                    <td class="text-bold">{{ $layanan->nama_layanan }}</td>
                    <td class="text-center">{{ $layanan->estimasi_waktu }}</td>
                    <td>
                        {{-- Daftar terstruktur wilayah tujuan dan nominal ongkir per layanan --}}
                        @if($layanan->daftarZonasi->isNotEmpty())
                            <ul class="zonasi-list">
                                @foreach($layanan->daftarZonasi as $zonasi)
                                    <li class="zonasi-item">
                                        <span class="zonasi-tujuan">
                                            {{ $zonasi->nama_kota }}, <span class="zonasi-provinsi">{{ $zonasi->nama_provinsi }}</span>
                                        </span>
                                        <span class="zonasi-tarif">Rp {{ number_format($zonasi->biaya_ongkir, 0, ',', '.') }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-muted">Belum ada zonasi</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="empty-data">Kurir ini belum memiliki jenis layanan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Tombol navigasi kembali ke halaman katalog daftar ekspedisi --}}
    <div class="card-footer-actions">
        <a href="{{ route('kurir.index') }}" class="btn-secondary">&larr; Kembali ke Daftar Ekspedisi</a>
    </div>
</div>
@endsection