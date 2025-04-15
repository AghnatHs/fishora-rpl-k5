<?php

namespace App\Http\Controllers\SellerAuth;

use App\Models\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return view('seller.auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'shop_name' => 'required|string|max:255',
            'telephone' => ['required', 'regex:/^08[0-9]{8,11}$/'],
            'email' => 'required|string|email|max:255|unique:sellers',
            'password' => 'required|string|min:8|confirmed',
            'address_street' => 'required|string|max:255',
            'address_city' => 'required|string|max:255',
            'address_province' => 'required|string|max:255',
            'address_zipcode' => 'required|integer',
        ]);
        $validated['password'] = Hash::make($validated['password']);

        $customer = Seller::create($validated);

        return redirect()->route('seller.dashboard');
    }
}
