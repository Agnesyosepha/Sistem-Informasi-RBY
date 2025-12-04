<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSuperadminDivision
{
    public function handle($request, Closure $next, string $allowedDivision)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // Jika username superadmin → full akses
        if ($user->username === 'superadmin') {
            return $next($request);
        }

        // Hanya superadmin yang boleh masuk
        if ($user->role !== 'Superadmin') {
            abort(403, 'Hanya Superadmin yang dapat mengakses halaman ini.');
        }

        // Mapping username → divisi yang boleh diakses
        $accessMap = [
            'administrator'   => 'Admin',
            'adminedp'        => 'EDP',
            'adminreviewer'   => 'Reviewer',
            'adminfinance'    => 'Finance',
        ];

        // Cek apakah username ada di daftar
        if (!array_key_exists($user->username, $accessMap)) {
            abort(403, 'Akses Superadmin tidak terdaftar.');
        }

        // Cek apakah divisi yang diminta sesuai akses
        if ($accessMap[$user->username] !== $allowedDivision) {
            abort(403, 'Anda tidak memiliki hak akses ke divisi ini.');
        }

        return $next($request);
    }
}
