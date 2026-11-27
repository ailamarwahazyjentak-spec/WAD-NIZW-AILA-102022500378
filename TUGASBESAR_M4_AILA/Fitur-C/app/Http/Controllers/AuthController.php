<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan form login (dilindungi middleware 'guest')
    public function create()
    {
        return view('auth.login');
    }

    // Proses login (dilindungi 'guest' + 'throttle:20,1')
    public function store(Request $permintaan)
    {
        $kredensial = $permintaan->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if (! Auth::attempt($kredensial, $permintaan->boolean('ingat_saya'))) {
            return back()
                ->withErrors(['email' => 'Email atau password salah.'])
                ->onlyInput('email');
        }

        $permintaan->session()->regenerate();

        return redirect()->intended($permintaan->user()->isAdmin() ? route('admin.dashboard') : route('kurir.index'));
    }

    // Proses logout (dilindungi middleware 'auth')
    public function destroy(Request $permintaan)
    {
        Auth::logout();

        $permintaan->session()->invalidate();
        $permintaan->session()->regenerateToken();

        return redirect()->route('login');
    }
}
