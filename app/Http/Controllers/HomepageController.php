<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        $seed = session('random_seed');
        if (!$seed) {
            $seed = rand();
            session(['random_seed' => $seed]);
        }

        $products = $query
            ->orderByRaw("RAND($seed)")
            ->paginate(8)
            ->withQueryString();
        $categories = Category::orderBy('name')->get();

        if (Auth::guard('customer')->check()) {
            $user = Auth::guard('customer')->user();
            $notifications = auth('customer')->user()->notifications;
            return view('homepage.index', compact('products', 'categories', 'notifications'));
        }

        return view('homepage.index', compact('products', 'categories'));
    }

    public function showProduct(Product $product)
    {
        $coverImage = [
            'url' => Storage::url($product->image_cover),
        ];

        $galleryImages = $product->images->map(function ($img) {
            return ['url' => Storage::url($img->filepath)];
        });

        $productImages = collect([$coverImage])->merge($galleryImages);

        $product::with(['categories', 'seller']);
        return view('homepage.show-product', compact('product', 'productImages'));
    }
}
