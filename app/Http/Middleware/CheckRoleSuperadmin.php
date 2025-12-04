<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRoleSuperadmin
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (Auth::user()->role !== 'Superadmin') {
            abort(403, 'Hanya Superadmin yang boleh mengakses halaman ini.');
        }

        return $next($request);
    }
}
