<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureCorrectGuard
{
    public function handle($request, Closure $next, $guard)
    {
        if (!Auth::guard($guard)->check()) {
            return redirect()->route(
                $guard === 'cms' ? 'login' : 'site.auth.login'
            );
        }

        // əlavə qoruma (opsional, amma çox yaxşı)
        if (session('auth_guard') !== $guard) {
            Auth::guard($guard)->logout();
            request()->session()->invalidate();

            return redirect()->route(
                $guard === 'cms' ? 'login' : 'site.auth.login'
            );
        }

        return $next($request);
    }
}
