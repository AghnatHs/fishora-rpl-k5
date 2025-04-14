<?php

namespace App\Http\Controllers\CustomerAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

        if (Auth::guard('customer')->attempt($credentials, $request->remember)) {
            return redirect()->intended(route('customer.dashboard'));
        }

        return redirect()->back()->withErrors(['email' => 'No credentials record found']);
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        return redirect('/');
    }
}
