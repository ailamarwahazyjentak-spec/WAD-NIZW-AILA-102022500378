<?php

use App\Http\Middleware\EnsureUserRole;
use App\Http\Middleware\LogRequestMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // 1. Daftarkan alias agar bisa dipanggil singkat di routes/web.php
        $middleware->alias([
            'role'        => EnsureUserRole::class,
            'log.request' => LogRequestMiddleware::class,
        ]);

        // 2. Global middleware untuk semua rute web
        $middleware->web(append: [
            LogRequestMiddleware::class,
        ]);

        // 3. Tujuan redirect otomatis
        //    - tamu yang membuka halaman 'auth'  -> ke halaman login
        //    - user login yang membuka halaman 'guest' (form login) -> ke daftar ekspedisi
        $middleware->redirectGuestsTo(fn (Request $request) => route('login'));
        $middleware->redirectUsersTo(fn (Request $request) => $request->user()?->isAdmin() ? route('admin.dashboard') : route('kurir.index'));
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
