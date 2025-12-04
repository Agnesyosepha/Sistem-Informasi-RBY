<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckDivision
{
    public function handle($request, Closure $next, ...$divisions)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // 1. Atasan selalu boleh akses semua
        if ($user->role === 'Atasan') {
            return $next($request);
        }

        // 2. Akun superadmin "administrator" bisa akses admin saja
        if ($user->role === 'Superadmin' && $user->username === 'administrator') {
            // dia hanya boleh masuk jika route-nya untuk divisi Admin
            if (in_array('Admin', $divisions)) {
                return $next($request);
            }
            abort(403, 'Hanya administrator yang boleh mengakses divisi Admin.');
        }

        // 3. Superadmin lain TIDAK BOLEH masuk divisi Admin
        if ($user->role === 'Superadmin' && $user->username !== 'administrator') {
            if (in_array('Admin', $divisions)) {
                abort(403, 'Anda tidak memiliki izin untuk mengakses divisi Admin.');
            }
        }

        // 4. Validasi user biasa berdasarkan divisi
        if (!in_array($user->divisi, $divisions)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
