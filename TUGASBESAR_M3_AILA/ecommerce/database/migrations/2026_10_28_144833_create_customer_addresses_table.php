<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Menghubungkan ke tabel users
            $table->string('recipient_name'); // Nama penerima
            $table->string('phone_number');   // No HP penerima
            $table->text('full_address');    // Alamat lengkap
            $table->timestamps();
        });
    }
   
    public function down(): void
    {
        Schema::dropIfExists('customer_addresses');
    }
};
