@extends('layouts.app')

@section('judul', 'Tambah Jenis Layanan')

@section('konten')
{{-- Kartu formulir penambahan jenis layanan pengiriman baru --}}
<div class="card">
    {{-- Judul dan keterangan singkat formulir tambah layanan --}}
    <div class="form-header">
        <h2>Tambah Jenis Layanan</h2>
        <p class="subtitle">Tentukan paket pengiriman beserta estimasi waktu tempuhnya.</p>
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

    {{-- Formulir pengiriman data jenis layanan baru ke rute admin.layanan.store --}}
    <form action="{{ route('admin.layanan.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="kurir_id">Pilih Ekspedisi <span class="req">*</span></label>
            <select class="form-control @error('kurir_id') input-error @enderror" id="kurir_id" name="kurir_id">
                <option value="">-- Pilih Ekspedisi --</option>
                @foreach($daftar_kurir as $kurir)
                    <option value="{{ $kurir->id }}" {{ old('kurir_id') == $kurir->id ? 'selected' : '' }}>
                        [{{ $kurir->kode_kurir }}] {{ $kurir->nama_kurir }}
                    </option>
                @endforeach
            </select>
            @error('kurir_id')
                <span class="field-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="nama_layanan">Nama Layanan <span class="req">*</span></label>
            <input type="text" class="form-control @error('nama_layanan') input-error @enderror" id="nama_layanan" name="nama_layanan" value="{{ old('nama_layanan') }}" placeholder="Contoh: Reguler, YES (Yakin Esok Sampai), Cargo">
            @error('nama_layanan')
                <span class="field-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="estimasi_waktu">Estimasi Waktu Pengiriman <span class="req">*</span></label>
            <input type="text" class="form-control @error('estimasi_waktu') input-error @enderror" id="estimasi_waktu" name="estimasi_waktu" value="{{ old('estimasi_waktu') }}" placeholder="Contoh: 1-2 Hari, 3-5 Hari">
            @error('estimasi_waktu')
                <span class="field-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="deskripsi">Keterangan / Deskripsi</label>
            <textarea class="form-control @error('deskripsi') input-error @enderror" id="deskripsi" name="deskripsi" rows="3" placeholder="Contoh: Layanan kilat sampai esok hari untuk kota besar">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <span class="field-error">{{ $message }}</span>
            @enderror
        </div>

        {{-- Tombol simpan layanan dan tautan kembali ke daftar jenis layanan --}}
        <div class="form-actions">
            <button type="submit" class="btn-submit">Simpan Layanan</button>
            <a href="{{ route('layanan.index') }}" class="link-kembali">&larr; Kembali ke Jenis Layanan</a>
        </div>
    </form>
</div>
@endsection