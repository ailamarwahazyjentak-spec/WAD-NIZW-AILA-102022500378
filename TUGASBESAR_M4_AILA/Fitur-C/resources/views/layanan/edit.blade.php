@extends('layouts.app')

@section('judul', 'Ubah Jenis Layanan')

@section('konten')
{{-- Kartu formulir pembaruan jenis layanan pengiriman --}}
<div class="card">
    {{-- Judul dan keterangan singkat formulir ubah layanan --}}
    <div class="form-header">
        <h2>Ubah Jenis Layanan</h2>
        <p class="subtitle">Sesuaikan rincian layanan pengiriman atau estimasi waktu tiba.</p>
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

    {{-- Formulir pengiriman perubahan data jenis layanan ke rute admin.layanan.update --}}
    <form action="{{ route('admin.layanan.update', $layanan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="kurir_id">Pilih Ekspedisi <span class="req">*</span></label>
            <select class="form-control @error('kurir_id') input-error @enderror" id="kurir_id" name="kurir_id">
                <option value="">-- Pilih Ekspedisi --</option>
                @foreach($daftar_kurir as $kurir)
                    <option value="{{ $kurir->id }}" {{ old('kurir_id', $layanan->kurir_id) == $kurir->id ? 'selected' : '' }}>
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
            <input type="text" class="form-control @error('nama_layanan') input-error @enderror" id="nama_layanan" name="nama_layanan" value="{{ old('nama_layanan', $layanan->nama_layanan) }}">
            @error('nama_layanan')
                <span class="field-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="estimasi_waktu">Estimasi Waktu Pengiriman <span class="req">*</span></label>
            <input type="text" class="form-control @error('estimasi_waktu') input-error @enderror" id="estimasi_waktu" name="estimasi_waktu" value="{{ old('estimasi_waktu', $layanan->estimasi_waktu) }}">
            @error('estimasi_waktu')
                <span class="field-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="deskripsi">Keterangan / Deskripsi</label>
            <textarea class="form-control @error('deskripsi') input-error @enderror" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $layanan->deskripsi) }}</textarea>
            @error('deskripsi')
                <span class="field-error">{{ $message }}</span>
            @enderror
        </div>

        {{-- Tombol simpan perubahan layanan dan tautan batal --}}
        <div class="form-actions">
            <button type="submit" class="btn-submit">Perbarui Layanan</button>
            <a href="{{ route('layanan.index') }}" class="link-kembali">Batal</a>
        </div>
    </form>
</div>
@endsection