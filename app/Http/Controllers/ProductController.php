<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function canDoAction(Product $product)
    {
        if (Auth::guard('seller')->user()->id !== $product->seller_id) {
            return false;
        }
        return true;
    }

    public function index(Request $request)
    {
        $sellerId = Auth::guard('seller')->id();
        $tab = $request->query('tab', 'live');
        
        $query = Product::with(['images', 'categories', 'warnings'])
            ->where('seller_id', $sellerId);
        
        // Get counts for each tab 
        $liveCount = Product::where('seller_id', $sellerId)
            ->where('stock', '>', 0)
            ->count();
            
        $outOfStockCount = Product::where('seller_id', $sellerId)
            ->where('stock', 0)
            ->count();
        
        $deletedCount = Product::onlyTrashed() 
            ->where('seller_id', $sellerId)
            ->count();
        
        // Filter products based on selected tab
        if ($tab === 'live') {
            $query->where('stock', '>', 0);
        } elseif ($tab === 'outofstock') {
            $query->where('stock', 0);
        } elseif ($tab === 'deleted') {
            $query->onlyTrashed(); 
        }

        // Filter by search if provided
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $products = $query->latest()->paginate(6);
        
        return view('seller.product.index', compact(
            'products', 'tab', 'liveCount', 'outOfStockCount', 'deletedCount'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view("seller.product.create", compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' =>  'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|integer|min:0',
            'description' => 'required|string',
            'image_cover' => 'required|mimes:jpeg,jpg,png|max:5120',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'images' => 'sometimes|nullable|array',
            'images.*' => 'sometimes|nullable|mimes:jpeg,jpg,png|max:5120',
        ]);

        $validated['seller_id'] = Auth::guard('seller')->user()->id;

        if ($request->hasFile('image_cover')) {
            $imagePath = $request->file('image_cover')->store('product_images', 'public');
            $validated['image_cover'] = $imagePath;
        }

        $product = Product::create($validated);
        $product->categories()->attach($validated['categories']);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                $product->images()->create(['filepath' => $path]);
            }
        }

        return redirect()->route('seller.products.index')->with('success', 'Product added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // Check if product belongs to current seller
        if ($product->seller_id !== Auth::guard('seller')->id()) {
            abort(403);
        }
        
        return view('seller.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        if (!$this->canDoAction($product)) abort(403);

        $categories = Category::orderBy('name')->get();

        return view('seller.product.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if (!$this->canDoAction($product)) abort(403);

        $validated = $request->validate([
            'name' =>  'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|integer|min:0',
            'description' => 'required|string',
            'image_cover' => 'sometimes|nullable|mimes:jpeg,jpg,png|max:5120',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'images' => 'array',
            'images.*' => 'mimes:jpeg,jpg,png|max:5120',
            'delete_images' => 'array',
            'delete_images.*' => 'exists:product_images,id',
        ]);

        if ($request->hasFile('image_cover')) {
            Storage::disk('public')->delete($product->image_cover);
            $imagePath = $request->file('image_cover')->store('product_images', 'public');
            $validated['image_cover'] = $imagePath;
        }

        if ($request->filled('delete_images')) {
            $imagesToDelete = ProductImage::whereIn('id', $request->delete_images)->get();
            foreach ($imagesToDelete as $image) {
                Storage::disk('public')->delete($image->filepath);
                $image->delete();
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                $product->images()->create(['filepath' => $path]);
            }
        }

        $product->update($validated);
        $product->categories()->sync($validated['categories']);

        return redirect()->route('seller.products.index')->with('success', 'Product ' . $product->name . ' edit successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (!$this->canDoAction($product)) abort(403);

        $product->delete();

        return redirect()->route('seller.products.index')->with('success', 'Product deleted successfully!');
    }
}
