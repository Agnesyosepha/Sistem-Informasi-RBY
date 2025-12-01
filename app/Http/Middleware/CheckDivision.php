<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckDivision
{
    public function handle($request, Closure $next, string $division)
    {
        if (!Auth::check() || Auth::user()->divisi !== $division) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
