<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $isAdmin = (bool) (Auth::user()->is_admin ?? false);

        if (! $isAdmin) {
            return redirect()->route('home')->with('error', 'Akses admin hanya untuk pengguna dengan role administrator.');
        }

        return $next($request);
    }
}

