<?php

namespace App\Http\Controllers\CustomerAuth;

use App\Constants\Messages;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{
    public function show()
    {
        return view('customer.auth.login');
    }

    public function login(Request $request)
    {
        $credentials =  $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $throttleKey = Str::lower($request->input('email')) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withInput()->withErrors([
                'email' => Messages::TOO_MANY_ATTEMPTS
            ]);
        }

        if (Auth::guard('customer')->attempt($credentials, $request->remember)) {
            RateLimiter::clear($throttleKey);
            return redirect()->intended(route('customer.dashboard'));
        }

        RateLimiter::hit($throttleKey, 60);
        return redirect()->back()->withInput()->withErrors(['email' => Messages::WRONG_CREDENTIALS]);
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        return redirect('/');
    }
}
