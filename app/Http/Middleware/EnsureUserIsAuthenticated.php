<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

            switch ($guard) {
                case 'customer':
                    $loginRoute = 'customer.login';
                    break;
                default:
                    $loginRoute = 'customer.login';
                    break;
            }

            return redirect()->route($loginRoute);
        }

        return abort(403);
    }
}
