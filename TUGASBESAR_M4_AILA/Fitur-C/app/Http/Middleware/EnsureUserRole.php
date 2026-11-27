<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{
    /**
     * Before Middleware: cek role sebelum request sampai ke Controller.
     * Dipakai di route: ->middleware('role:admin') atau ->middleware('role:admin,user')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        // 1. Jika belum login sama sekali, lempar ke halaman login
        if (! $user) {
            return redirect()->route('login');
        }

        // 2. Jika role user tidak ada dalam daftar yang diizinkan
        if ($roles === [] || ! in_array($user->role, $roles, true)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Akses ditolak. Akun kamu tidak punya izin.',
                ], Response::HTTP_FORBIDDEN);
            }

            // Batalkan akses dengan HTTP status 403 Forbidden
            abort(Response::HTTP_FORBIDDEN, 'Akses ditolak.');
        }

        // 3. Lolos pemeriksaan, lanjut ke Controller
        return $next($request);
    }
}
