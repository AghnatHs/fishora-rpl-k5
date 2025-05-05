<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductWarningController extends Controller
{
    public function create(Request $request, Product $product)
    {
        $coverImage = [
            'url' => Storage::url($product->image_cover),
        ];
        $galleryImages = $product->images->map(function ($img) {
            return ['url' => Storage::url($img->filepath)];
        });
        $productImages = collect([$coverImage])->merge($galleryImages);
        
        return view("admin.dashboard.monitoring-create", compact('product', 'productImages'));
    }

    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'description' => 'required|string',
        ]);
        $validated['status'] = "UNRESOLVED";

        $product->warnings()->create($validated);
        return redirect()->route('admin.dashboard.products-monitoring')->with('success', 'Product warning added successfully!');
    }
}
