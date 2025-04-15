<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// guest.custom
class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = $guards ?: array_keys(config('auth.guards')); // check all guards if none specified

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                switch ($guard) {
                    case 'admin':
                        return redirect()->route('admin.dashboard');
                    case 'customer':
                        return redirect()->route('customer.dashboard');
                    case 'seller':
                        return redirect()->route('seller.dashboard');
                    default:
                        return redirect('/'); // fallback
                }
            }
        }

        return $next($request);
    }
}
