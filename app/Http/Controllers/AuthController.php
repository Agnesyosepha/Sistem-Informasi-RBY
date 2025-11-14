<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\RegisterSuccessMail; // ⬅️ tambahkan ini

class AuthController extends Controller
{
    // 🟢 Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();
            $user = Auth::user();

            // 1️⃣ SUPERADMIN
            if ($user->username === 'admin') {
                return redirect()->route('superadmin');
            }

            // 2️⃣ USER BIASA (divisi apa pun)
            return redirect()->route('dashboard');
        }

        // Jika gagal login
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput();
    }


    // 🟢 Tampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // 🟢 Proses register
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'divisi' => 'required',
            'password' => 'required|min:6',
        ]);

        // 1️⃣ Simpan user baru
        $user = User::create([
            'email' => $request->email,
            'username' => $request->username,
            'divisi' => $request->divisi,
            'password' => Hash::make($request->password),
        ]);

        // 2️⃣ Kirim email notifikasi register berhasil
        Mail::to($user->email)->send(new RegisterSuccessMail($user->username));

        // 3️⃣ Redirect ke login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan cek email Anda.');
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
