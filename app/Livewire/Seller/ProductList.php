<?php

namespace App\Livewire\Seller;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProductList extends Component
{

    public $search = '';

    public function render()
    {
        $products = Product::with(['categories', 'images'])
            ->where('seller_id', Auth::guard('seller')->id())
            ->where('name', 'like', '%' . $this->search . '%')
            ->latest()
            ->get();

        return view('livewire.seller.product-list', compact('products'));
    }
}
