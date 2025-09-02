<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // file login.blade.php kamu
    }

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
}
