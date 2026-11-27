<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kurir', function (Blueprint $tabel) {
            $tabel->id();
            $tabel->string('kode_kurir', 20)->unique();
            $tabel->string('nama_kurir', 100);
            $tabel->string('telepon', 25);
            $tabel->boolean('status_aktif')->default(true);
            $tabel->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kurir');
    }
};