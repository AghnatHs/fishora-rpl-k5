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
        
        $validated = $request->validate([
            'shop_name' => 'required|string|max:255',
            'telephone' => ['required', 'regex:/^08[0-9]{8,11}$/'],
            'address_street' => 'required|string|max:255',
            'address_city' => 'required|string|max:255',
            'address_province' => 'required|string|max:255',
            'address_zipcode' => 'required|integer',
        ]);
        
        // Update seller profile
        $seller->update($validated);
        
        return back()->with('status', 'Profil toko berhasil diperbarui!');
    }
}