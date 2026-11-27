<!DOCTYPE html>
<html lang="id">
<head>
    {{-- Metadata halaman dan pemuatan stylesheet utama aplikasi --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('judul', 'Sistem Ekspedisi E-Commerce')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    {{-- Bilah navigasi atas untuk tautan merek, menu modul, dan kontrol keluar akun --}}
    <nav class="topnav">
        <a class="brand" href="{{ auth()->check() ? route('kurir.index') : route('login') }}">E-Commerce</a>

        @auth
        <div class="menu">
            @if(auth()->user()->isAdmin())
                <a class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
            @endif
            <a class="{{ request()->routeIs('kurir.*', 'admin.kurir.*') ? 'active' : '' }}" href="{{ route('kurir.index') }}">Ekspedisi</a>
            <a class="{{ request()->routeIs('layanan.*', 'admin.layanan.*') ? 'active' : '' }}" href="{{ route('layanan.index') }}">Jenis Layanan</a>
            <a class="{{ request()->routeIs('zonasi.*', 'admin.zonasi.*') ? 'active' : '' }}" href="{{ route('zonasi.index') }}">Zonasi &amp; Tarif</a>

            {{-- Penanda role pengguna yang sedang login dan tombol keluar sesi --}}
            <div class="user-box">
                <span class="badge badge-role {{ auth()->user()->isAdmin() ? 'badge-success' : 'badge-info' }}">{{ auth()->user()->role }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">Keluar</button>
                </form>
            </div>
        </div>
        @endauth
    </nav>

    {{-- Area konten utama untuk menampilkan alert keberhasilan dan isi halaman anak --}}
    <main class="main">
        @if(session('sukses'))
            <div class="alert-success" role="status">
                <span>{{ session('sukses') }}</span>
                <button type="button" class="alert-close" onclick="this.parentElement.remove()" aria-label="Tutup notifikasi">&times;</button>
            </div>
        @endif

        @yield('konten')
    </main>

    {{-- Bagian kaki halaman sebagai informasi identitas proyek --}}
    <footer class="footer">
        &copy; 2026 Tugas Besar Pemrograman Web - E-Commerce Ekspedisi Kirim
    </footer>

</body>
</html>