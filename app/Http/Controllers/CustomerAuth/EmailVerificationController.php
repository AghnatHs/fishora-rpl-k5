<?php

namespace App\Http\Controllers\CustomerAuth;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Mail\CustomerVerifyEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

class EmailVerificationController extends Controller
{
    public function verify(Request $request)
    {
        $request->validate([
            'id' => 'required|string',
            'email' => 'required|email',
            'signature' => 'required'
        ]);

        if (! $request->hasValidSignature()) {
            abort(403, 'Invalid or expired link.');
        }

        $customer = Customer::findOrFail($request->id);

        if ($customer->email !== $request->email) {
            abort(403, 'Email mismatch.');
        }

        $customer->email_verified_at = now();
        $customer->save();

        return redirect('/customer/login')->with('success', 'Email verified! You may now log in.');
    }

    public function notice()
    {
        return view('customer.auth.verify-email-notice');
    }

    public function resend(Request $request)
    {
        $customer = auth('customer')->user();
        $key = 'resend-verification:' . $customer->id;

        if (RateLimiter::tooManyAttempts($key, 3)) {
            return back()->with(
                'error',
                'Too many requests. Please wait before trying again.'
            );
        }

        RateLimiter::hit($key, 60);

        $link = $customer->generateVerificationUrl();
        Mail::to($customer->email)->send(new CustomerVerifyEmail($link));
        return back()->with('status', 'verification-link-sent');
    }
}
