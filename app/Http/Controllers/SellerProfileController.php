<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SellerProfileController extends Controller
{
    public function edit()
    {
        $seller = Auth::guard('seller')->user();
        return view('seller.profile.edit', compact('seller'));
    }

    public function update(Request $request)
    {
        $seller = Auth::guard('seller')->user();
        
        $request->validate([
            'shop_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('sellers')->ignore($seller->id)],
            'telephone' => ['required', 'string', 'max:15'],
            'address_street' => ['required', 'string', 'max:255'],
            'address_city' => ['required', 'string', 'max:100'],
            'address_province' => ['required', 'string', 'max:100'],
            'address_zipcode' => ['required', 'string', 'max:10'],
        ]);
        
        // Update seller profile
        $seller->update($request->only([
            'shop_name',
            'email',
            'telephone',
            'address_street',
            'address_city',
            'address_province',
            'address_zipcode',
        ]));
        
        return back()->with('status', 'Profil toko berhasil diperbarui!');
    }
}