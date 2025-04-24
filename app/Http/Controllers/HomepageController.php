<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['categories', 'seller']);

        $search = $request->input('search');
        $category = $request->input('category');

        if (!empty($search)) {
            $search = $request->search;
            $query->where('name', 'like', '%' . $search . '%');
        }

        if (!empty($category)) {
            $category = $request->category; // name
            $query->whereHas('categories', function ($catQuery) use ($category) {
                $catQuery->where('categories.name', $category);
            });
        }

        $products = $query
            ->inRandomOrder()
            ->paginate(12)
            ->withQueryString();
        $categories = Category::orderBy('name')->get();


        return view('homepage.index', compact('products', 'categories'));
    }
}
