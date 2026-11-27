@extends('layouts.app')

@section('judul', 'Masuk')

@section('konten')
{{-- Kartu formulir login terpusat untuk autentikasi pengguna --}}
<div class="card card-login">
    {{-- Judul dan subjudul halaman masuk --}}
    <div class="form-header">
        <h2>Masuk</h2>
        <p class="subtitle">Silakan masuk untuk mengelola data ekspedisi pengiriman.</p>
    </div>

    {{-- Ringkasan pesan kesalahan validasi atau kredensial login --}}
    @if ($errors->any())
        <div class="alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulir pengiriman email, password, dan opsi ingat sesi --}}
    <form action="{{ route('login.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Email <span class="req">*</span></label>
            <input type="email" class="form-control @error('email') input-error @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="nama@contoh.com" autofocus>
            @error('email')
                <span class="field-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password <span class="req">*</span></label>
            <input type="password" class="form-control @error('password') input-error @enderror" id="password" name="password" placeholder="Masukkan password">
            @error('password')
                <span class="field-error">{{ $message }}</span>
            @enderror
            {{-- Kontrol centang untuk menampilkan atau menyembunyikan karakter password --}}
            <label class="checkbox-label">
                <input type="checkbox" onclick="document.getElementById('password').type = this.checked ? 'text' : 'password'">
                <span>Tampilkan password</span>
            </label>
        </div>

        <div class="form-group">
            <label class="checkbox-label">
                <input type="checkbox" name="ingat_saya" value="1">
                <span>Ingat saya</span>
            </label>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">Masuk</button>
        </div>
    </form>
</div>
@endsection