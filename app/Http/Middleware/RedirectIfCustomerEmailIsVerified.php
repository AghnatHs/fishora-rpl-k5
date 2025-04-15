<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfCustomerEmailIsVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth('customer')->user();

        if (!$user || !is_null($user->email_verified_at)) {
            return redirect()->route('customer.dashboard');
        }

        return $next($request);
    }
}
