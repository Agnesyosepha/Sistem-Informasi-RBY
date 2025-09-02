<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // 🟢 Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login'); // file: resources/views/auth/login.blade.php
    }

    // 🟢 Proses login
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // biar aman
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput();
    }

    // 🟢 Tampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register'); // file: resources/views/auth/register.blade.php
    }

    // 🟢 Proses register
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'divisi' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        // Simpan user baru
        User::create([
            'email' => $request->email,
            'username' => $request->username,
            'divisi' => $request->divisi,
            'password' => Hash::make($request->password),
        ]);

        // Setelah daftar → langsung ke login
        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
    }

    // 🟢 Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
