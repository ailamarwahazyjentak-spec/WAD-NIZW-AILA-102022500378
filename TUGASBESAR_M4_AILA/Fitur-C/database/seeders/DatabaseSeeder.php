<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     * Akun dibuat lewat seeder (tidak ada halaman registrasi),
     * dan hanya berjalan di lingkungan local / testing.
     */
    public function run(): void
    {
        if (! app()->environment(['local', 'testing'])) {
            return;
        }

        $adminEmail    = env('SEED_ADMIN_EMAIL') ?: 'admin@ekspedisi.test';
        $adminPassword = env('SEED_ADMIN_PASSWORD') ?: 'ekspedisi-admin';
        $adminName     = env('SEED_ADMIN_NAME') ?: 'Admin Ekspedisi';

        $userEmail    = env('SEED_USER_EMAIL') ?: 'user@ekspedisi.test';
        $userPassword = env('SEED_USER_PASSWORD') ?: 'ekspedisi-user';
        $userName     = env('SEED_USER_NAME') ?: 'Pengguna Biasa';

        // Akun admin (role diisi terpisah karena tidak ada di $fillable)
        $admin = User::query()->firstOrNew(['email' => $adminEmail]);
        $admin->fill([
            'name'     => $adminName,
            'password' => Hash::make($adminPassword),
        ]);
        $admin->role = User::ROLE_ADMIN;
        $admin->email_verified_at ??= now();
        $admin->save();

        // Akun user biasa
        $visitor = User::query()->firstOrNew(['email' => $userEmail]);
        $visitor->fill([
            'name'     => $userName,
            'password' => Hash::make($userPassword),
        ]);
        $visitor->role = User::ROLE_USER;
        $visitor->email_verified_at ??= now();
        $visitor->save();

        // Data contoh ekspedisi (aman dijalankan berulang, memakai firstOrCreate / updateOrCreate)
        $this->call(ContohDataSeeder::class);
    }
}
