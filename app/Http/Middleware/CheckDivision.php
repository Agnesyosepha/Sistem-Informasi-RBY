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

        if ($user->role === 'Atasan') {
            return $next($request);
        }
        
        if (!in_array(Auth::user()->divisi, $divisions)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
