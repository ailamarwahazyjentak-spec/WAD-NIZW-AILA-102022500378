<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zonasi extends Model
{
    use HasFactory;

    protected $table = 'zonasi';

    protected $fillable = [
        'layanan_id',
        'nama_provinsi',
        'nama_kota',
        'biaya_ongkir',
    ];

    // Relasi: Zonasi dimiliki oleh 1 Jenis Layanan
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id', 'id');
    }
}