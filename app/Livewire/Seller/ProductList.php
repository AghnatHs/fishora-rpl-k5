<?php

namespace App\Livewire\Seller;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProductList extends Component
{
    public $search = '';
    public $tab = 'live'; // Default tab
    
    // Mendefinisikan query string untuk menyimpan state di URL
    protected $queryString = ['tab', 'search'];
    
    // Menangkap tab dari URL saat component dimuat
    public function mount()
    {
        $this->tab = request()->query('tab', 'live');
    }
    
    public function render()
    {
        $sellerId = Auth::guard('seller')->id();
        $query = Product::with(['categories', 'images'])
            ->where('seller_id', $sellerId);
        
        // Filter berdasarkan tab yang dipilih
        if ($this->tab === 'live') {
            $query->where('stock', '>', 0)
                  ->whereNull('deleted_at');
        } elseif ($this->tab === 'outofstock') {
            $query->where('stock', 0)
                  ->whereNull('deleted_at');
        } elseif ($this->tab === 'deleted') {
            $query->onlyTrashed(); 
        }
        
        // Terapkan filter pencarian
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }
        
        $products = $query->latest()->get();
        
        return view('livewire.seller.product-list', compact('products'));
    }
    
    public function updatedTab()
    {
        // Metode kosong yang memastikan komponen di-render ulang saat tab berubah
    }
}
