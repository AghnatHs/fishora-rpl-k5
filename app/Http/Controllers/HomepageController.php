<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['categories', 'seller']);

        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where('name', 'like', '%' . $search . '%');
        }

        $products = $query
            ->inRandomOrder()
            ->get();

        return view('homepage.index', compact('products'));
    }
}
