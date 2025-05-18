<?php

namespace App\Http\Controllers\CustomerAuth;

use App\Constants\Messages;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\Order;

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
            
            // Calculate and set cart count in session
            $user = Auth::guard('customer')->user();
            $cartCount = Order::where('customer_id', $user->id)
                ->where('status_delivery', \App\Constants\Orders::STATUS_DELIVERY_CART)
                ->where('status_payment', \App\Constants\Orders::STATUS_PAYMENT_CART)
                ->join('order_lines', 'orders.id', '=', 'order_lines.order_id')
                ->distinct('order_lines.product_id')
                ->count('order_lines.product_id');
            
            session(['cart_count' => $cartCount]);
            
            return redirect()->intended(route('customer.dashboard'));
        }

        RateLimiter::hit($throttleKey, 60);
        return redirect()->back()->withInput()->withErrors(['email' => Messages::WRONG_CREDENTIALS]);
    }

    public function logout(Request $request)
    {
        // Clear cart count from session before logout
        session()->forget('cart_count');
        
        Auth::guard('customer')->logout();
        return redirect('/');
    }
}
