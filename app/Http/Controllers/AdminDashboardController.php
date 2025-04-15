<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard.index');
    }

    public function overview()
    {
        $counts = Seller::selectRaw("
        CASE 
            WHEN admin_verified_at IS NULL THEN 'unverified'
            ELSE 'verified'
        END as verification_status,
        COUNT(*) as count
        ")
            ->groupBy('verification_status')
            ->pluck('count', 'verification_status');

        $sellerTotal = $counts->sum();
        $sellerVerifiedTotal = $counts['verified'] ?? 0;
        $sellerUnverifiedTotal = $counts['unverified'] ?? 0;

        return view('admin.dashboard.overview', compact(
            'sellerTotal',
            'sellerVerifiedTotal',
            'sellerUnverifiedTotal'
        ));
    }

    public function sellerVerification()
    {
        $sellers = Seller::all();
        return view('admin.dashboard.seller-verification', compact('sellers'));
    }

    public function verifySeller(Request $request, Seller $seller)
    {
        $validated = $request->validate([
            'action' => 'required|in:approve,reject',
        ]);

        if ($validated['action'] === 'approve') {
            $seller->admin_verified_accepted = 'approve';
        } elseif ($validated['action'] === 'reject') {
            $seller->admin_verified_accepted = 'reject';
        }
        
        $seller->admin_verified_at = now();
        $seller->save();

        return back()->with('success', 'Seller verification updated.');
    }
}
