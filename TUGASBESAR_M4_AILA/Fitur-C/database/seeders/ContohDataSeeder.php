<?php

namespace Database\Seeders;

use App\Models\Kurir;
use App\Models\Layanan;
use App\Models\Zonasi;
use Illuminate\Database\Seeder;

/*
 |--------------------------------------------------------------------------
 | Data contoh ekspedisi, layanan, dan tarif zonasi
 |--------------------------------------------------------------------------
 | Jalankan : php artisan db:seed --class=ContohDataSeeder
 | Aman dijalankan berulang kali (updateOrCreate): data yang sudah ada
 | diperbarui, bukan diduplikasi.
 |
 | Dasar penentuan angka
 |  - Kota asal pengiriman : Jakarta (gudang toko).
 |  - Tarif                : estimasi tarif per kg pertama (Rp), dibulatkan
 |                           ke Rp 500, makin jauh jarak makin mahal.
 |  - Skala layanan        : YES kira-kira 1,7 - 2 kali tarif Reguler (JNE).
 |                           J&T EZ kira-kira 85% dari JNE Reguler dan
 |                           biasanya 1 hari lebih lambat.
 |  - Acuan                : kisaran tarif publik JNE (REG/YES) dan J&T (EZ)
 |                           rute Jakarta - kota tujuan. Tarif resmi bisa
 |                           berbeda per kecamatan dan berubah berkala, jadi
 |                           angka di sini adalah ESTIMASI, bukan tarif resmi.
 |
 | Pembagian zona jarak dari Jakarta (jalur darat / udara)
 |  Zona 1  Jabodetabek              +- 0 - 40 km
 |  Zona 2  Jawa Barat               +- 150 km
 |  Zona 3  Jawa Tengah dan DIY      +- 450 - 560 km
 |  Zona 4  Jawa Timur               +- 780 km
 |  Zona 5  Sumatera Selatan dan Bali (seberang laut)
 |  Zona 6  Sumatera Utara           +- 1.400 km (via udara)
 */
class ContohDataSeeder extends Seeder
{
    public function run(): void
    {
        // ---------- Ekspedisi ----------
        $jne = Kurir::updateOrCreate(['kode_kurir' => 'JNE'], [
            'nama_kurir' => 'Jalur Nugraha Ekakurir', 'telepon' => '021-2927-8888', 'status_aktif' => 1,
        ]);
        $jnt = Kurir::updateOrCreate(['kode_kurir' => 'JNT'], [
            'nama_kurir' => 'J&T Express', 'telepon' => '021-8066-1888', 'status_aktif' => 1,
        ]);
        Kurir::updateOrCreate(['kode_kurir' => 'POS'], [
            'nama_kurir' => 'Pos Indonesia', 'telepon' => '1500161', 'status_aktif' => 0,
        ]);

        // ---------- Jenis layanan ----------
        $reg = Layanan::updateOrCreate(['kurir_id' => $jne->id, 'nama_layanan' => 'Reguler'], [
            'estimasi_waktu' => '1-5 Hari',
            'deskripsi'      => 'Layanan standar. Jabodetabek 1 hari, Jawa 2-3 hari, Sumatera dan Bali 3-5 hari',
        ]);
        $yes = Layanan::updateOrCreate(['kurir_id' => $jne->id, 'nama_layanan' => 'YES'], [
            'estimasi_waktu' => '1 Hari',
            'deskripsi'      => 'Yakin Esok Sampai, khusus kota besar tertentu',
        ]);
        $ez = Layanan::updateOrCreate(['kurir_id' => $jnt->id, 'nama_layanan' => 'EZ'], [
            'estimasi_waktu' => '2-6 Hari',
            'deskripsi'      => 'Layanan ekonomis. Jabodetabek 1-2 hari, Jawa 2-4 hari, Sumatera dan Bali 4-6 hari',
        ]);

        // ---------- Zonasi & tarif per kg (asal: Jakarta) ----------
        // [layanan, provinsi, kota, tarif]
        $zonasi = [
            // JNE Reguler
            [$reg, 'DKI Jakarta',      'Jakarta Selatan',  9000],   // zona 1
            [$reg, 'Jawa Barat',       'Kota Bekasi',      9000],   // zona 1
            [$reg, 'Jawa Barat',       'Kota Bandung',    11000],   // zona 2
            [$reg, 'Jawa Tengah',      'Kota Semarang',   15000],   // zona 3
            [$reg, 'DI Yogyakarta',    'Kota Yogyakarta', 17000],   // zona 3
            [$reg, 'Jawa Timur',       'Kota Surabaya',   19000],   // zona 4
            [$reg, 'Sumatera Selatan', 'Kota Palembang',  23000],   // zona 5
            [$reg, 'Bali',             'Kota Denpasar',   28000],   // zona 5
            [$reg, 'Sumatera Utara',   'Kota Medan',      40000],   // zona 6

            // JNE YES (kota besar saja, +- 1,7 - 2 kali tarif Reguler)
            [$yes, 'DKI Jakarta',      'Jakarta Pusat',   18000],   // zona 1
            [$yes, 'Jawa Barat',       'Kota Bandung',    20000],   // zona 2
            [$yes, 'Jawa Tengah',      'Kota Semarang',   28000],   // zona 3
            [$yes, 'DI Yogyakarta',    'Kota Yogyakarta', 32000],   // zona 3
            [$yes, 'Jawa Timur',       'Kota Surabaya',   35000],   // zona 4

            // J&T EZ (+- 85% dari JNE Reguler)
            [$ez,  'DKI Jakarta',      'Jakarta Selatan',  8000],   // zona 1
            [$ez,  'Jawa Barat',       'Kota Bekasi',      8000],   // zona 1
            [$ez,  'Jawa Barat',       'Kota Bandung',     9500],   // zona 2
            [$ez,  'Jawa Tengah',      'Kota Semarang',   13000],   // zona 3
            [$ez,  'DI Yogyakarta',    'Kota Yogyakarta', 14500],   // zona 3
            [$ez,  'Jawa Timur',       'Kota Surabaya',   16000],   // zona 4
            [$ez,  'Sumatera Selatan', 'Kota Palembang',  20000],   // zona 5
            [$ez,  'Bali',             'Kota Denpasar',   24000],   // zona 5
            [$ez,  'Sumatera Utara',   'Kota Medan',      34000],   // zona 6
        ];

        foreach ($zonasi as [$layanan, $provinsi, $kota, $biaya]) {
            Zonasi::updateOrCreate(
                ['layanan_id' => $layanan->id, 'nama_kota' => $kota],
                ['nama_provinsi' => $provinsi, 'biaya_ongkir' => $biaya]
            );
        }
    }
}
