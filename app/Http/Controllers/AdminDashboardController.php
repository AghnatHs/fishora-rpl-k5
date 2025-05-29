<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SellerVerificationAcceptedMail;
use App\Mail\SellerVerificationRejectedMail;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard.index');
    }

    public function monitoringView(Request $request)
    {
        $tab = $request->input('tab', 'default');

        if (!in_array($tab, ['default', 'dihapus'])) {
            abort(403, 'Invalid Query');
        }

        $query = Product::with(['categories', 'seller', 'warnings'])
            ->whereHas('seller')
            ->join('sellers', 'products.seller_id', '=', 'sellers.id')
            ->orderBy('sellers.shop_name', 'asc')
            ->select('products.*');

        $search = $request->input('search');
        $category = $request->input('category');

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if (!empty($category)) {
            $category = $request->category;
            $query->whereHas('categories', function ($catQuery) use ($category) {
                $catQuery->where('categories.name', $category);
            });
        }

        if ($tab === 'default') {
            // $query->where('status', 'invalid');
        } elseif ($tab === 'dihapus') {
            $query->onlyTrashed()->where('deleted_by_admin', true);
        }

        $products = $query
            ->paginate(8)
            ->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('admin.dashboard.monitoring-index', compact('products', 'categories'));
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
        $productTotal = Product::count();

        return view('admin.dashboard.overview', compact(
            'sellerTotal',
            'sellerVerifiedTotal',
            'sellerUnverifiedTotal',
            'productTotal'
        ));
    }

    public function sellerVerification()
    {
        $sellers = Seller::orderByRaw('admin_verified_at IS NOT NULL')
            ->orderBy('admin_verified_at', 'desc')
            ->paginate(4);


        return view('admin.dashboard.seller-verification', compact('sellers'));
    }

    public function verifySeller(Request $request, Seller $seller)
    {
        $validated = $request->validate([
            'action' => 'required|in:approve,reject',
        ]);

        if ($validated['action'] === 'approve') {
            $seller->admin_verified_accepted = 'approve';
            Mail::to($seller->email)->queue(new SellerVerificationAcceptedMail($seller));
        } elseif ($validated['action'] === 'reject') {
            $seller->admin_verified_accepted = 'reject';
            Mail::to($seller->email)->queue(new SellerVerificationRejectedMail($seller));
        }

        $seller->admin_verified_at = now();
        $seller->save();

        return back()->with('success', 'Seller verification updated.');
    }
}
