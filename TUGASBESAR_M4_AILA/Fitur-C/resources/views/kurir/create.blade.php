@extends('layouts.app')

@section('judul', 'Tambah Kurir Baru')

@section('konten')
{{-- Kartu formulir penambahan data mitra ekspedisi baru --}}
<div class="card">
    {{-- Judul dan keterangan singkat formulir tambah kurir --}}
    <div class="form-header">
        <h2>Tambah Data Kurir</h2>
        <p class="subtitle">Lengkapi identitas mitra jasa ekspedisi baru di bawah ini.</p>
    </div>

    {{-- Ringkasan pesan kesalahan validasi input --}}
    @if ($errors->any())
        <div class="alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulir pengiriman data kurir baru ke rute admin.kurir.store --}}
    <form action="{{ route('admin.kurir.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="kode_kurir">Kode Kurir <span class="req">*</span></label>
            <input type="text" class="form-control @error('kode_kurir') input-error @enderror" id="kode_kurir" name="kode_kurir" value="{{ old('kode_kurir') }}" placeholder="Contoh: JNE, JNT, SICEPAT">
            @error('kode_kurir')
                <span class="field-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="nama_kurir">Nama Ekspedisi <span class="req">*</span></label>
            <input type="text" class="form-control @error('nama_kurir') input-error @enderror" id="nama_kurir" name="nama_kurir" value="{{ old('nama_kurir') }}" placeholder="Contoh: Jalur Nugraha Ekakurir">
            @error('nama_kurir')
                <span class="field-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="telepon">Nomor Telepon CS <span class="req">*</span></label>
            <input type="text" class="form-control @error('telepon') input-error @enderror" id="telepon" name="telepon" value="{{ old('telepon') }}" placeholder="Nomor telepon customer service">
            @error('telepon')
                <span class="field-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="status_aktif">Status Operasional <span class="req">*</span></label>
            <select class="form-control @error('status_aktif') input-error @enderror" id="status_aktif" name="status_aktif">
                <option value="1" {{ old('status_aktif', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ old('status_aktif', '1') == '0' ? 'selected' : '' }}>Nonaktif</option>
            </select>
            @error('status_aktif')
                <span class="field-error">{{ $message }}</span>
            @enderror
        </div>

        {{-- Tombol simpan data dan tautan kembali ke daftar ekspedisi --}}
        <div class="form-actions">
            <button type="submit" class="btn-submit">Simpan Kurir</button>
            <a href="{{ route('kurir.index') }}" class="link-kembali">&larr; Kembali ke Daftar Ekspedisi</a>
        </div>
    </form>
</div>
@endsection