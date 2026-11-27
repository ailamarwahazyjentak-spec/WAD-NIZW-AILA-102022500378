@extends('layouts.app')

@section('judul', 'Ubah Data Kurir')

@section('konten')
{{-- Kartu formulir pembaruan data mitra ekspedisi --}}
<div class="card">
    {{-- Judul dan keterangan singkat formulir ubah kurir --}}
    <div class="form-header">
        <h2>Ubah Data Kurir</h2>
        <p class="subtitle">Perbarui informasi kontak maupun status operasional mitra kurir.</p>
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

    {{-- Formulir pengiriman perubahan data kurir ke rute admin.kurir.update --}}
    <form action="{{ route('admin.kurir.update', $kurir->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="kode_kurir">Kode Kurir <span class="req">*</span></label>
            <input type="text" class="form-control @error('kode_kurir') input-error @enderror" id="kode_kurir" name="kode_kurir" value="{{ old('kode_kurir', $kurir->kode_kurir) }}">
            @error('kode_kurir')
                <span class="field-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="nama_kurir">Nama Ekspedisi <span class="req">*</span></label>
            <input type="text" class="form-control @error('nama_kurir') input-error @enderror" id="nama_kurir" name="nama_kurir" value="{{ old('nama_kurir', $kurir->nama_kurir) }}">
            @error('nama_kurir')
                <span class="field-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="telepon">Nomor Telepon CS <span class="req">*</span></label>
            <input type="text" class="form-control @error('telepon') input-error @enderror" id="telepon" name="telepon" value="{{ old('telepon', $kurir->telepon) }}">
            @error('telepon')
                <span class="field-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="status_aktif">Status Operasional <span class="req">*</span></label>
            <select class="form-control @error('status_aktif') input-error @enderror" id="status_aktif" name="status_aktif">
                <option value="1" {{ old('status_aktif', $kurir->status_aktif) == '1' ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ old('status_aktif', $kurir->status_aktif) == '0' ? 'selected' : '' }}>Nonaktif</option>
            </select>
            @error('status_aktif')
                <span class="field-error">{{ $message }}</span>
            @enderror
        </div>

        {{-- Tombol simpan perubahan dan tautan batal --}}
        <div class="form-actions">
            <button type="submit" class="btn-submit">Perbarui Data</button>
            <a href="{{ route('kurir.index') }}" class="link-kembali">Batal</a>
        </div>
    </form>
</div>
@endsection