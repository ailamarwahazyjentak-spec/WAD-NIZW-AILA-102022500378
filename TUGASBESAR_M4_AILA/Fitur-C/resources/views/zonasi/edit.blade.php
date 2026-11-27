@extends('layouts.app')

@section('judul', 'Ubah Zonasi & Tarif')

@section('konten')
{{-- Kartu formulir pembaruan data zonasi wilayah dan nominal ongkir --}}
<div class="card">
    {{-- Judul dan keterangan singkat formulir ubah zonasi --}}
    <div class="form-header">
        <h2>Ubah Zonasi Pengiriman</h2>
        <p class="subtitle">Perbarui wilayah tujuan maupun nominal ongkos kirim layanan.</p>
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

    {{-- Formulir pengiriman perubahan data zonasi ke rute admin.zonasi.update --}}
    <form action="{{ route('admin.zonasi.update', $zonasi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="layanan_id">Pilih Layanan Ekspedisi <span class="req">*</span></label>
            <select class="form-control @error('layanan_id') input-error @enderror" id="layanan_id" name="layanan_id">
                <option value="">-- Pilih Layanan Kurir --</option>
                @foreach($daftar_layanan as $layanan)
                    <option value="{{ $layanan->id }}" {{ old('layanan_id', $zonasi->layanan_id) == $layanan->id ? 'selected' : '' }}>
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
            <input type="text" class="form-control @error('nama_provinsi') input-error @enderror" id="nama_provinsi" name="nama_provinsi" value="{{ old('nama_provinsi', $zonasi->nama_provinsi) }}">
            @error('nama_provinsi')
                <span class="field-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="nama_kota">Kota / Kabupaten Tujuan <span class="req">*</span></label>
            <input type="text" class="form-control @error('nama_kota') input-error @enderror" id="nama_kota" name="nama_kota" value="{{ old('nama_kota', $zonasi->nama_kota) }}">
            @error('nama_kota')
                <span class="field-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="biaya_ongkir">Biaya Ongkos Kirim (Rp) <span class="req">*</span></label>
            <input type="number" class="form-control @error('biaya_ongkir') input-error @enderror" id="biaya_ongkir" name="biaya_ongkir" value="{{ old('biaya_ongkir', (int)$zonasi->biaya_ongkir) }}" min="0">
            @error('biaya_ongkir')
                <span class="field-error">{{ $message }}</span>
            @enderror
        </div>

        {{-- Tombol simpan perubahan data dan tautan batal --}}
        <div class="form-actions">
            <button type="submit" class="btn-submit">Perbarui Data</button>
            <a href="{{ route('zonasi.index') }}" class="link-kembali">Batal</a>
        </div>
    </form>
</div>
@endsection