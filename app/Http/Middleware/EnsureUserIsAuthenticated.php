<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// auth.custom
class EnsureUserIsAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return $next($request);
            }

            foreach (array_diff(array_keys(config('auth.guards')), [$guard]) as $otherGuard) {
                if (Auth::guard($otherGuard)->check()) {
                    return abort(403, 'Unauthorized access.');
                }
            }

            switch ($guard) {
                case 'admin':
                    return redirect()->route('admin.login');
                case 'customer':
                    return redirect()->route('customer.login');
                case 'seller':
                    return redirect()->route('seller.login');
                default:
                    return redirect()->route('customer.login');
            }
        }

        return abort(403);
    }
}
