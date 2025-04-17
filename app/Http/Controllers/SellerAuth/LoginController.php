<?php

namespace App\Http\Controllers\SellerAuth;

use App\Models\Seller;
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
        return view('seller.auth.login');
    }

    public function login(Request $request)
    {
        $credentials =  $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $throttleKey = Str::lower($request->input('email')) . '|' . $request->ip();

        $seller = Seller::where('email', $request->input('email'))->first();
        if ($seller) {
            if (!$seller->admin_verified_at) {
                RateLimiter::hit($throttleKey, 60);
                return redirect()->back()->withErrors(['email' => 'Seller is not verified by Administrator yet. please check your email']);
            } else {
                if ($seller->admin_verified_accepted === 'reject') {
                    RateLimiter::hit($throttleKey, 60);
                    return redirect()->back()->withErrors(['email' => 'Seller verification is not accepted by Administrator.']);
                }
            }
        }

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withInput()->withErrors([
                'email' => Messages::TOO_MANY_ATTEMPTS
            ]);
        }

        if (Auth::guard('seller')->attempt($credentials, $request->remember)) {
            RateLimiter::clear($throttleKey);
            return redirect()->intended(route('seller.dashboard'));
        }

        RateLimiter::hit($throttleKey, 60);
        return redirect()->back()->withInput()->withErrors(['email' => Messages::WRONG_CREDENTIALS]);
    }

    public function logout(Request $request)
    {
        Auth::guard('seller')->logout();
        return redirect('/');
    }
}
