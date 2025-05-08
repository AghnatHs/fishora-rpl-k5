<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerDashboardController extends Controller
{
    public function dashboard()
    {
        $products = Product::where('seller_id', Auth::guard('seller')->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
        $notifications = Auth::guard('seller')->user()->unreadNotifications;
        return view('seller.dashboard.index', compact('products'));
    }

    public function inbox()
    {
        return view('seller.dashboard.inbox');
    }
}
