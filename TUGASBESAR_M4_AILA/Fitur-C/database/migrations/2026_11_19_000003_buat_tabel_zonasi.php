<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('zonasi', function (Blueprint $tabel) {
            $tabel->id();
            $tabel->foreignId('layanan_id')->constrained('layanan')->onDelete('cascade');
            $tabel->string('nama_provinsi', 100);
            $tabel->string('nama_kota', 100);
            $tabel->decimal('biaya_ongkir', 12, 2);
            $tabel->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('zonasi');
    }
};