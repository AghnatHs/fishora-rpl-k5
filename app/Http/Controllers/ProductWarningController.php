<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductWarning;
use App\Notifications\ProductWarningNotification;
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

        $product->seller->notify(new ProductWarningNotification("New warning for $product->name, please resolve quickly."));

        return redirect()->route('admin.dashboard.products-monitoring')->with('success', 'Product warning added successfully!');
    }

    public function update(Request $request, ProductWarning $productWarning)
    {
        $validated = $request->validate([
            'status' => 'required|in:RESOLVED,UNRESOLVED',
        ]);

        $productWarning->update($validated);

        return redirect()->back()->with('success', 'Product warning updated succesfully!');
    }
}
