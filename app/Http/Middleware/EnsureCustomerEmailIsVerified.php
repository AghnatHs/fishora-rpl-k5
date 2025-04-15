<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCustomerEmailIsVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth('customer')->user();

        /*         if (!$user) {
            return redirect()->route('customer.login')->with('error', 'Unauthorized, please login first');
        }
        */

        if (!$user || is_null($user->email_verified_at)) {
            return redirect()->route('customer.verify.notice');
        }

        return $next($request);
    }
}
