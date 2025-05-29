<x-app-layout>
    
    <!-- Mobile Layout (unchanged) -->
    <div class="lg:hidden">
        <!-- Main container -->
        <div class="mx-auto max-w-md w-full min-h-screen bg-white lg:shadow-lg lg:my-0 overflow-hidden">
            <!-- Fixed Top Navigation -->
            <div class="fixed top-0 left-0 right-0 bg-white z-20">
                <div class="max-w-md mx-auto px-4 py-4 flex items-center justify-between">
                    <div class="flex items-center">
                        <a href="{{ route('homepage.index') }}" class="text-[#4871AD]">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                            </svg>
                        </a>
                        <h1 class="text-2xl text-[#4871AD] font-medium ml-3" style="font-family: 'DM Serif Text', serif;">Keranjang Saya</h1>
                    </div>
                    
                    <a href="{{ route('customer.inbox') }}" class="text-[#4871AD] hover:text-[#365a8c] transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#4871AD" class="w-6 h-6">
                            <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/>
                        </svg>
                    </a>
                </div>
            </div>
            
            <!-- Cart Items Container -->
            <div class="pt-20 px-0 -mt-8 pb-24">
                @include('components.modals.status')
                @include('components.modals.errors')
                
                @forelse ($cartOrders as $order)
                    @php
                        // Group order lines by seller
                        $orderLinesBySeller = $order->orderLines->groupBy(function ($orderLine) {
                            return $orderLine->product->seller->id;
                        });
                    @endphp
                    
                    @foreach ($orderLinesBySeller as $sellerId => $sellerOrderLines)
                        @php
                            $seller = $sellerOrderLines->first()->product->seller;
                        @endphp
                        
                        <!-- One card per shop -->
                        <div class="bg-[#4871AD] rounded-lg overflow-hidden shadow-md mb-4 lg:max-w-sm lg:mx-auto transition-all duration-300 ease-in-out hover:-translate-y-1 hover:shadow-2xl">
                            <!-- Shop Name -->
                            <div class="px-4 pt-3 pb-1">
                                <p class="font-medium text-white text-sm" style="font-family: 'DM Serif Text', serif;">{{ $seller->shop_name }}</p>
                            </div>
                            
                            <!-- White divider line-->
                            <div class="border-t border-white/20 mx-4"></div>
                            
                            <!-- Loop through products from this shop -->
                            @foreach ($sellerOrderLines as $index => $orderLine)
                                <div class="px-4 py-3 flex items-center">
                                    <!-- Product Image -->
                                    <div class="w-16 h-16 bg-white/20 rounded flex items-center justify-center overflow-hidden transition-all duration-300 ease-in-out hover:scale-105 hover:shadow-lg">
                                        @if($orderLine->product->image_cover)
                                            <img src="{{ Storage::url($orderLine->product->image_cover) }}" alt="{{ $orderLine->product->name }}" class="w-full h-full object-cover">
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="currentColor" class="w-8 h-8 text-white/50">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        @endif
                                    </div>
                                    
                                    <!-- Product Details -->
                                    <div class="ml-3 flex-1 flex flex-col justify-between text-white">
                                        <div>
                                            <p class="font-medium text-sm transition-colors duration-200 hover:text-white/80" style="font-family: 'DM Serif Text', serif;">{{ $orderLine->product->name }}</p>
                                            <p class="text-white/90 text-sm" style="font-family: 'DM Serif Text', serif;">Rp{{ number_format($orderLine->product->price, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Quantity Controls -->
                                    <div class="flex items-center ml-3">
                                        <!-- Decrement Button -->
                                        <form method="POST" action="{{ route('customer.remove-from-cart', ['order' => $order->id, 'product' => $orderLine->product->id]) }}" class="quantity-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-7 h-7 bg-white text-[#4871AD] font-bold rounded flex items-center justify-center relative transition-all duration-200 ease-in-out active:scale-95 hover:scale-110 hover:shadow-lg overflow-hidden" 
                                                data-content="{{ $orderLine->quantity > 1 ? '-' : '-' }}" style="font-family: 'DM Serif Text', serif;">
                                                -
                                            </button>
                                        </form>

                                        <!-- Quantity Display -->
                                        <span class="mx-2 w-6 text-center text-white" style="font-family: 'DM Serif Text', serif;">{{ $orderLine->quantity }}</span>
                                        
                                        <!-- Increment Button -->
                                        <form method="POST" action="{{ route('customer.add-to-cart', ['product' => $orderLine->product->id]) }}" class="quantity-form">
                                            @csrf
                                            <button type="submit" class="w-7 h-7 bg-white text-[#4871AD] font-bold rounded flex items-center justify-center relative transition-all duration-200 ease-in-out active:scale-95 hover:scale-110 hover:shadow-lg overflow-hidden"
                                                data-content="+" style="font-family: 'DM Serif Text', serif;">
                                                +
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                
                                <!-- White divider line (except after last item) -->
                                @if(!$loop->last)
                                    <div class="border-t border-white/20 mx-4"></div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                @empty
                    <!-- Empty cart display -->
                    <div class="text-center py-8">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto text-gray-300 mb-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                        <p class="text-gray-500 font-medium" style="font-family: 'DM Serif Text', serif;">Keranjang Anda kosong</p>
                    </div>
                @endforelse
            </div>
            
            <!-- Fixed Checkout Footer -->
            @if(isset($cartOrders) && $cartOrders->isNotEmpty() && $cartOrders->first()->orderLines->isNotEmpty())
                <div class="fixed bottom-0 left-0 right-0 z-30">
                    <div class="max-w-md mx-auto bg-[#4871AD] py-4 px-6 flex items-center justify-between text-white">
                        <div>
                            <p class="font-medium" style="font-family: 'DM Serif Text', serif;">Total Rp{{ number_format($orderTotalPrice, 0, ',', '.') }}</p>
                        </div>
                        
                        <a href="{{ route('customer.checkout.index') }}" class="bg-white text-[#4871AD] px-6 py-2 rounded-md font-medium hover:bg-gray-100 transition-colors" style="font-family: 'DM Serif Text', serif;">
                            Checkout ({{ $cartOrders->first()->orderLines->sum('quantity') }})
                        </a>
                    </div>
                </div>
            @endif

            <!-- Bottom Navigation -->
            @if(!isset($cartOrders) || $cartOrders->isEmpty() || $cartOrders->first()->orderLines->isEmpty())
                <div class="fixed bottom-0 left-0 right-0 bg-[#4871AD] text-white z-30">
                    <div class="w-full max-w-2xl md:max-w-4xl lg:max-w-6xl xl:max-w-7xl mx-auto grid grid-cols-4 text-center">
                        <!-- Home -->
                        <a href="{{ route('homepage.index') }}" class="py-2 flex flex-col items-center relative group">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 24V8L12 0L24 8V24H15V14.7H9V24H0Z" />
                            </svg>
                            <span class="text-xs font-serif mt-0.5" style="font-family: 'DM Serif Text', serif;">Home</span>
                        </a>
                        <!-- Transaction -->
                        @if(auth('customer')->check())
                        <a href="{{ route('customer.transactions') }}" class="py-2 flex flex-col items-center relative group">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 3H5C3.89 3 3 3.9 3 5V19C3 20.1 3.89 21 5 21H19C20.11 21 21 20.1 21 19V5C21 3.9 20.11 3 19 3ZM9 17H7V10H9V17ZM13 17H11V7H13V17ZM17 17H15V13H17V17Z" />
                            </svg>
                            <span class="text-xs font-serif mt-0.5" style="font-family: 'DM Serif Text', serif;">Transaksi</span>
                        </a>
                        <!-- Inbox -->
                        <a href="{{ route('customer.inbox') }}" class="py-2 flex flex-col items-center relative group">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 20.9999C2.45 20.9999 1.979 20.8042 1.587 20.4128C1.195 20.0214 0.999333 19.5507 1 18.9999V4.99994C1 4.44994 1.196 3.97894 1.588 3.58694C1.98 3.19494 2.451 2.99928 3 2.99994H21C21.55 2.99994 22.021 3.19594 22.413 3.58794C22.805 3.97994 23.0007 4.45061 23 4.99994V18.9999C23 19.5499 22.804 20.0209 22.412 20.4129C22.02 20.8049 21.5493 21.0006 21 20.9999H3ZM12 13.9999C12.283 13.9999 12.521 13.9039 12.713 13.7119C12.905 13.5199 13.0007 13.2826 13 12.9999H21V4.99994H3V12.9999H11C11 13.2839 11.096 13.5219 11.288 13.7139C11.48 13.9059 11.7173 14.0013 12 13.9999Z" />
                            </svg>
                            <span class="text-xs font-serif mt-0.5" style="font-family: 'DM Serif Text', serif;">Kotak Masuk</span>
                        </a>
                        @endif
                        <!-- Account -->
                        <a href="{{ 
                            auth('admin')->check() ? route('admin.dashboard') : 
                            (auth('seller')->check() ? route('seller.dashboard') : 
                            (auth('customer')->check() ? route('customer.dashboard') : 
                            route('pick-login'))) 
                        }}" class="py-2 flex flex-col items-center relative group">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 12C10.9 12 9.95833 11.6083 9.175 10.825C8.39167 10.0417 8 9.1 8 8C8 6.9 8.39167 5.95833 9.175 5.175C9.95833 4.39167 10.9 4 12 4C13.1 4 14.0417 4.39167 14.825 5.175C15.6083 5.95833 16 6.9 16 8C16 9.1 15.6083 10.0417 14.825 10.825C14.0417 11.6083 13.1 12 12 12ZM18 20H6C5.45 20 4.97933 19.8043 4.588 19.413C4.19667 19.0217 4.00067 18.5507 4 18V17.2C4 16.6333 4.146 16.1123 4.438 15.637C4.73 15.1617 5.11733 14.7993 5.6 14.55C6.63333 14.0333 7.68333 13.6457 8.75 13.387C9.81667 13.1283 10.9 12.9993 12 13C13.1 13 14.1833 13.1293 15.25 13.388C16.3167 13.6467 17.3667 14.034 18.4 14.55C18.8833 14.8 19.271 15.1627 19.563 15.638C19.855 16.1133 20.0007 16.634 20 17.2V18C20 18.55 19.8043 19.021 19.413 19.413C19.0217 19.805 18.5507 20.0003 18 20Z" />
                            </svg>
                            <span class="text-xs font-serif mt-0.5" style="font-family: 'DM Serif Text', serif;">Akun</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Desktop Top Navbar -->
    <div class="hidden lg:block fixed top-0 left-0 right-0 z-40 bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto flex items-center justify-between h-20 px-8">
            <div class="flex items-center gap-4">
                <a href="{{ route('homepage.index') }}" class="text-[#4871AD] hover:text-[#365a8c] transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <h1 class="text-3xl text-[#4871AD] font-medium font-serif">Keranjang Belanja</h1>
            </div>
            <a href="{{ route('customer.inbox') }}" class="text-[#4871AD] hover:text-[#365a8c] transition-colors hover:scale-110 transform duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                    <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/>
                </svg>
            </a>
        </div>
    </div>

    <!-- Desktop Layout -->
    <div class="hidden lg:block min-h-screen bg-gray-50 pt-24">
        <div class="max-w-7xl mx-auto pt-8">
            @include('components.modals.status')
            @include('components.modals.errors')
            
            @forelse ($cartOrders as $order)
                @php
                    // Group order lines by seller
                    $orderLinesBySeller = $order->orderLines->groupBy(function ($orderLine) {
                        return $orderLine->product->seller->id;
                    });
                @endphp
                
                @foreach ($orderLinesBySeller as $sellerId => $sellerOrderLines)
                    @php
                        $seller = $sellerOrderLines->first()->product->seller;
                        $sellerTotal = $sellerOrderLines->sum(function($line) { 
                            return $line->quantity * $line->product->price; 
                        });
                    @endphp
                    
                    <!-- Desktop Table per Shop -->
                    <div class="cart-table mb-8">
                        <!-- Shop Header -->
                        <div class="bg-[#4871AD] text-white px-6 py-4">
                            <div class="flex items-center justify-between">
                                <h2 class="text-xl font-medium" style="font-family: 'DM Serif Text', serif;">
                                    🏪 {{ $seller->shop_name }}
                                </h2>
                                <span class="text-lg font-medium" style="font-family: 'DM Serif Text', serif;">
                                    Total: Rp{{ number_format($sellerTotal, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Table Header -->
                        <div class="bg-gray-50 px-6 py-3 border-b border-gray-200">
                            <div class="grid grid-cols-12 gap-4 items-center text-sm font-medium text-gray-700" style="font-family: 'DM Serif Text', serif;">
                                <div class="col-span-1">Gambar</div>
                                <div class="col-span-4">Produk</div>
                                <div class="col-span-2">Harga Satuan</div>
                                <div class="col-span-2">Jumlah</div>
                                <div class="col-span-2">Subtotal</div>
                                <div class="col-span-1">Aksi</div>
                            </div>
                        </div>
                        
                        <!-- Product Rows -->
                        <div class="divide-y divide-gray-200">
                            @foreach ($sellerOrderLines as $orderLine)
                                <div class="cart-row px-6 py-4 transition-all duration-200">
                                    <div class="grid grid-cols-12 gap-4 items-center">
                                        <!-- Product Image -->
                                        <div class="col-span-1">
                                            <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden hover:shadow-md transition-shadow duration-200">
                                                @if($orderLine->product->image_cover)
                                                    <img src="{{ Storage::url($orderLine->product->image_cover) }}" 
                                                         alt="{{ $orderLine->product->name }}" 
                                                         class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-400">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                                         <!-- Product Name -->
                        <div class="col-span-4">
                            <h3 class="text-lg font-semibold text-gray-900 hover:text-[#4871AD] transition-colors cursor-pointer" style="font-family: 'DM Serif Text', serif;">
                                {{ $orderLine->product->name }}
                            </h3>
                        </div>
                                        
                                        <!-- Unit Price -->
                                        <div class="col-span-2">
                                            <span class="text-lg font-medium text-gray-900" style="font-family: 'DM Serif Text', serif;">
                                                Rp{{ number_format($orderLine->product->price, 0, ',', '.') }}
                                            </span>
                                        </div>
                                        
                                        <!-- Quantity Controls -->
                                        <div class="col-span-2">
                                            <div class="flex items-center space-x-3">
                                                <!-- Decrement Button -->
                                                <form method="POST" action="{{ route('customer.remove-from-cart', ['order' => $order->id, 'product' => $orderLine->product->id]) }}" class="quantity-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="quantity-btn w-8 h-8 bg-[#4871AD] text-white font-bold rounded-full flex items-center justify-center hover:bg-[#365a8c] transition-all duration-200" 
                                                        data-content="-" style="font-family: 'DM Serif Text', serif;">
                                                        −
                                                    </button>
                                                </form>

                                                <!-- Quantity Display -->
                                                <span class="w-12 text-center text-lg font-medium text-gray-900" style="font-family: 'DM Serif Text', serif;">
                                                    {{ $orderLine->quantity }}
                                                </span>
                                                
                                                <!-- Increment Button -->
                                                <form method="POST" action="{{ route('customer.add-to-cart', ['product' => $orderLine->product->id]) }}" class="quantity-form">
                                                    @csrf
                                                    <button type="submit" class="quantity-btn w-8 h-8 bg-[#4871AD] text-white font-bold rounded-full flex items-center justify-center hover:bg-[#365a8c] transition-all duration-200"
                                                        data-content="+" style="font-family: 'DM Serif Text', serif;">
                                                        +
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        
                                        <!-- Subtotal -->
                                        <div class="col-span-2">
                                            <span class="text-lg font-bold text-[#4871AD]" style="font-family: 'DM Serif Text', serif;">
                                                Rp{{ number_format($orderLine->quantity * $orderLine->product->price, 0, ',', '.') }}
                                            </span>
                                        </div>
                                        
                                        <!-- Remove Button -->
                                        <div class="col-span-1">
                                            <form method="POST" action="{{ route('customer.remove-from-cart', ['order' => $order->id, 'product' => $orderLine->product->id]) }}" class="quantity-form">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="remove_all" value="1">
                                                <button type="submit" class="text-red-500 hover:text-red-700 hover:scale-110 transition-all duration-200" title="Hapus semua">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @empty
                <!-- Empty cart display for desktop -->
                <div class="text-center py-16">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-24 h-24 mx-auto text-gray-300 mb-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                    <h2 class="text-2xl font-medium text-gray-500 mb-4" style="font-family: 'DM Serif Text', serif;">Keranjang Anda kosong</h2>
                    <p class="text-gray-400 mb-8">Mulai berbelanja ikan hias favorit Anda!</p>
                    <a href="{{ route('homepage.index') }}" class="inline-flex items-center px-6 py-3 bg-[#4871AD] text-white font-medium rounded-lg hover:bg-[#365a8c] transition-colors duration-200" style="font-family: 'DM Serif Text', serif;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                        Mulai Belanja
                    </a>
                </div>
            @endforelse

            <!-- Desktop Checkout Section -->
            @if(isset($cartOrders) && $cartOrders->isNotEmpty() && $cartOrders->first()->orderLines->isNotEmpty())
                <div class="bg-white rounded-lg shadow-lg p-8 sticky bottom-8">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-6">
                            <div class="text-center">
                                <p class="text-sm text-gray-500 mb-1" style="font-family: 'DM Serif Text', serif;">Total Item</p>
                                <p class="text-2xl font-bold text-[#4871AD]" style="font-family: 'DM Serif Text', serif;">
                                    {{ $cartOrders->first()->orderLines->sum('quantity') }} produk
                                </p>
                            </div>
                            <div class="h-12 w-px bg-gray-300"></div>
                            <div class="text-center">
                                <p class="text-sm text-gray-500 mb-1" style="font-family: 'DM Serif Text', serif;">Total Harga</p>
                                <p class="text-3xl font-bold text-[#4871AD]" style="font-family: 'DM Serif Text', serif;">
                                    Rp{{ number_format($orderTotalPrice, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                        
                        <a href="{{ route('customer.checkout.index') }}" 
                           class="inline-flex items-center px-8 py-4 bg-[#4871AD] text-white font-medium rounded-lg hover:bg-[#365a8c] hover:scale-105 transition-all duration-200 shadow-lg" 
                           style="font-family: 'DM Serif Text', serif;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                            </svg>
                            Checkout Sekarang
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Enhanced hover effects for desktop cart rows
            document.querySelectorAll('.cart-row').forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.boxShadow = '0 4px 12px rgba(72, 113, 173, 0.15)';
                    this.style.transform = 'translateY(-2px)';
                });
                
                row.addEventListener('mouseleave', function() {
                    this.style.boxShadow = 'none';
                    this.style.transform = 'translateY(0)';
                });
            });

            // Enhanced mobile card animations
            document.querySelectorAll('.mobile-cart-card').forEach(card => {
                card.addEventListener('touchstart', function() {
                    this.style.transform = 'scale(0.98)';
                });
                
                card.addEventListener('touchend', function() {
                    this.style.transform = 'scale(1)';
                });
            });

            // Add ripple effect to mobile quantity buttons
            document.querySelectorAll('.mobile-quantity-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.classList.add('ripple');
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // Enhanced quantity button animations
            document.querySelectorAll('.quantity-btn, .mobile-quantity-btn').forEach(btn => {
                btn.addEventListener('mousedown', function() {
                    this.style.transform = 'scale(0.9)';
                });
                
                btn.addEventListener('mouseup', function() {
                    this.style.transform = 'scale(1.05)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 150);
                });
                
                btn.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            });

            // Smooth transitions for product images
            document.querySelectorAll('.mobile-product-image img, .cart-row img').forEach(img => {
                img.addEventListener('load', function() {
                    this.style.opacity = '0';
                    this.style.transition = 'opacity 0.3s ease';
                    setTimeout(() => {
                        this.style.opacity = '1';
                    }, 100);
                });
            });

            // Add pulse animation to checkout button
            const checkoutBtn = document.querySelector('a[href*="checkout"]');
            if (checkoutBtn) {
                checkoutBtn.addEventListener('mouseenter', function() {
                    this.classList.add('btn-pulse');
                });
                
                checkoutBtn.addEventListener('mouseleave', function() {
                    this.classList.remove('btn-pulse');
                });
            }
        });
    </script>

    <style>
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    </style>
</x-app-layout>