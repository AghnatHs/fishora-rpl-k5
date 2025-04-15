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
            'ktp' => 'required|mimes:jpeg,jpg,png|max:5120',
            'proof_of_business' => 'required|mimes:jpeg,jpg,png|max:5120',
        ]);
        $validated['password'] = Hash::make($validated['password']);

        if ($request->hasFile('ktp')) {
            $file = $request->file('ktp');
            $validated['ktp'] = file_get_contents($file->getRealPath());
            $validated['ktp_mime'] = $file->getMimeType();
        }

        if ($request->hasFile('proof_of_business')) {
            $file = $request->file('proof_of_business');
            $validated['proof_of_business'] = file_get_contents($file->getRealPath());
            $validated['proof_of_business_mime'] = $file->getMimeType();
        }

        $seller = Seller::create($validated);

        return redirect()->route('seller.login')->with('success', 'Account succesfully registered, please wait for admin to verify your account');
    }
}
