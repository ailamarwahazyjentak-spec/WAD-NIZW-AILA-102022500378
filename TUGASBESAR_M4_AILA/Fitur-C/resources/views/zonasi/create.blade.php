@extends('layouts.app')

@section('judul', 'Tambah Zonasi & Tarif')

@section('konten')
{{-- Kartu formulir penambahan zonasi wilayah tujuan dan tarif ongkir baru --}}
<div class="card">
    {{-- Judul dan keterangan singkat formulir tambah zonasi --}}
    <div class="form-header">
        <h2>Tambah Zonasi Pengiriman</h2>
        <p class="subtitle">Tetapkan wilayah tujuan dan tarif ongkos kirim untuk layanan ekspedisi.</p>
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

    {{-- Formulir pengiriman data zonasi dan tarif baru ke rute admin.zonasi.store --}}
    <form action="{{ route('admin.zonasi.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="layanan_id">Pilih Layanan Ekspedisi <span class="req">*</span></label>
            <select class="form-control @error('layanan_id') input-error @enderror" id="layanan_id" name="layanan_id">
                <option value="">-- Pilih Layanan Kurir --</option>
                @foreach($daftar_layanan as $layanan)
                    <option value="{{ $layanan->id }}" {{ old('layanan_id') == $layanan->id ? 'selected' : '' }}>
                        {{ $layanan->kurir->kode_kurir }} - {{ $layanan->nama_layanan }} (Estimasi: {{ $layanan->estimasi_waktu }})
                    </option>
                @endforeach
            </select>
            @error('layanan_id')
                <span class="field-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="nama_provinsi">Provinsi Tujuan <span class="req">*</span></label>
            <input type="text" class="form-control @error('nama_provinsi') input-error @enderror" id="nama_provinsi" name="nama_provinsi" value="{{ old('nama_provinsi') }}" placeholder="Contoh: Jawa Barat">
            @error('nama_provinsi')
                <span class="field-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="nama_kota">Kota / Kabupaten Tujuan <span class="req">*</span></label>
            <input type="text" class="form-control @error('nama_kota') input-error @enderror" id="nama_kota" name="nama_kota" value="{{ old('nama_kota') }}" placeholder="Contoh: Kota Bandung">
            @error('nama_kota')
                <span class="field-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="biaya_ongkir">Biaya Ongkos Kirim (Rp) <span class="req">*</span></label>
            <input type="number" class="form-control @error('biaya_ongkir') input-error @enderror" id="biaya_ongkir" name="biaya_ongkir" value="{{ old('biaya_ongkir') }}" placeholder="Contoh: 15000" min="0">
            @error('biaya_ongkir')
                <span class="field-error">{{ $message }}</span>
            @enderror
        </div>

        {{-- Tombol simpan zonasi dan tautan kembali ke halaman zonasi & tarif --}}
        <div class="form-actions">
            <button type="submit" class="btn-submit">Simpan Zonasi</button>
            <a href="{{ route('zonasi.index') }}" class="link-kembali">&larr; Kembali ke Zonasi &amp; Tarif</a>
        </div>
    </form>
</div>
@endsection