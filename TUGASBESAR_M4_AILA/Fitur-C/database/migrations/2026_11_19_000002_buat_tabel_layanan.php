<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('layanan', function (Blueprint $tabel) {
            $tabel->id();
            $tabel->foreignId('kurir_id')->constrained('kurir')->onDelete('cascade');
            $tabel->string('nama_layanan', 100);
            $tabel->string('estimasi_waktu', 50);
            $tabel->text('deskripsi')->nullable();
            $tabel->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('layanan');
    }
};