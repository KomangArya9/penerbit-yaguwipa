<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        // Jika user sudah login, langsung arahkan ke dashboard
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    // Memproses login
    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // 2. Cek ke database
        // Auth::attempt akan otomatis mengecek password yang sudah di-hash
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // 3. Jika berhasil, arahkan ke route admin.dashboard
            return redirect()->intended(route('admin.dashboard'));
        }

        // 4. Jika gagal, kembali ke halaman sebelumnya dengan pesan error
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Arahkan kembali ke halaman login
        return redirect()->route('login');
    }
}