@extends('layouts.app')

{{-- Menetapkan judul halaman pada tab browser --}}
@section('judul', 'Dashboard')

@section('konten')
{{-- Kontainer utama halaman dashboard untuk menampilkan ringkasan data modul ekspedisi --}}
<div class="container">
    {{-- Kepala halaman dashboard yang memuat judul utama dan keterangan modul --}}
    <div class="header-flex">
        <div>
            <h2>Dashboard</h2>
            <p class="subtitle">Pantau dan atur seluruh konfigurasi pengiriman</p>
        </div>
    </div>

    {{-- Grid 3 kolom untuk kartu ringkasan jumlah data kurir, layanan, dan zonasi --}}
    <div class="stats-grid">
        {{-- Kartu ringkasan total mitra ekspedisi dan jumlah kurir aktif --}}
        <div class="stat-card">
            <div class="stat-top">
                <span class="stat-label">Ekspedisi (Kurir)</span>
                <span class="badge badge-success">{{ $kurir_aktif }} Aktif</span>
            </div>
            <div class="stat-body">
                <span class="stat-value">{{ $total_kurir }}</span>
                <span class="stat-unit">Mitra Terdaftar</span>
            </div>
            <div class="stat-footer">
                <a href="{{ route('kurir.index') }}" class="btn-edit">Kelola</a>
                <a href="{{ route('admin.kurir.create') }}" class="stat-link">+ Tambah Kurir</a>
            </div>
        </div>

        {{-- Kartu ringkasan total jenis layanan pengiriman --}}
        <div class="stat-card">
            <div class="stat-top">
                <span class="stat-label">Jenis Layanan</span>
                <span class="badge badge-info">Paket Kirim</span>
            </div>
            <div class="stat-body">
                <span class="stat-value">{{ $total_layanan }}</span>
                <span class="stat-unit">Layanan Tersedia</span>
            </div>
            <div class="stat-footer">
                <a href="{{ route('layanan.index') }}" class="btn-edit">Kelola</a>
                <a href="{{ route('admin.layanan.create') }}" class="stat-link">+ Tambah Layanan</a>
            </div>
        </div>

        {{-- Kartu ringkasan total cakupan zonasi dan tarif pengiriman --}}
        <div class="stat-card">
            <div class="stat-top">
                <span class="stat-label">Zonasi &amp; Tarif</span>
                <span class="badge badge-info">Cakupan Wilayah</span>
            </div>
            <div class="stat-body">
                <span class="stat-value">{{ $total_zonasi }}</span>
                <span class="stat-unit">Titik Kota Tujuan</span>
            </div>
            <div class="stat-footer">
                <a href="{{ route('zonasi.index') }}" class="btn-edit">Kelola</a>
                <a href="{{ route('admin.zonasi.create') }}" class="stat-link">+ Tambah Zonasi</a>
            </div>
        </div>
    </div>
</div>
@endsection