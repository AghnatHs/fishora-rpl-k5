<?php

namespace App\Http\Controllers\CustomerAuth;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
