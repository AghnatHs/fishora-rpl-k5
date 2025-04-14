<?php

namespace App\Http\Controllers\CustomerAuth;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return view('customer.auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'telephone' => ['required', 'regex:/^08[0-9]{8,11}$/'],
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $validated['password'] = Hash::make($validated['password']);

        $customer = Customer::create($validated);

        Auth::guard('customer')->login($customer);

        return redirect()->route('customer.dashboard');
    }
}
