@extends('layouts.app')

@section('judul', 'Akses Dibatasi')

@section('konten')
{{-- Kartu pemberitahuan penolakan akses (HTTP 403) dan tombol kembali --}}
<div class="card card-error">
    <span class="badge badge-danger badge-lg">Error 403</span>
    <h2>Akses Dibatasi</h2>
    <p class="error-message">
        Akun Anda tidak memiliki izin untuk membuka halaman atau melakukan tindakan ini.
    </p>
    <a href="{{ auth()->check() ? route('kurir.index') : route('login') }}" class="btn-tambah">Kembali ke Daftar Ekspedisi</a>
</div>
@endsection