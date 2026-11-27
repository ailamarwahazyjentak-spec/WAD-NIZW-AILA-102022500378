<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurir extends Model
{
    use HasFactory;

    protected $table = 'kurir';

    protected $fillable = [
        'kode_kurir',
        'nama_kurir',
        'telepon',
        'status_aktif',
    ];

    // Relasi: 1 Kurir memiliki banyak Jenis Layanan
    public function daftarLayanan()
    {
        return $this->hasMany(Layanan::class, 'kurir_id', 'id');
    }
}