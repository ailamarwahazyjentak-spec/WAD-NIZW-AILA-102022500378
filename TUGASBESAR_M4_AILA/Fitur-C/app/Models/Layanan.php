<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanan';

    protected $fillable = [
        'kurir_id',
        'nama_layanan',
        'estimasi_waktu',
        'deskripsi',
    ];

    // Relasi: Layanan dimiliki oleh 1 Kurir
    public function kurir()
    {
        return $this->belongsTo(Kurir::class, 'kurir_id', 'id');
    }

    // Relasi: 1 Layanan memiliki banyak Zonasi Pengiriman
    public function daftarZonasi()
    {
        return $this->hasMany(Zonasi::class, 'layanan_id', 'id');
    }
}