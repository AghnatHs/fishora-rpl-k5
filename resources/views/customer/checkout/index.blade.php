<x-app-layout>
    <!-- Main container -->
    <div class="mx-auto w-full min-h-screen bg-white lg:shadow-lg lg:my-0 overflow-hidden max-w-[1400px] px-1 sm:px-2 md:px-6 lg:px-12 xl:px-20">
        <!-- Fixed Top Navigation (Mobile Only) -->
        <div class="fixed top-0 left-0 right-0 bg-white/95 backdrop-blur z-20 lg:hidden transition-all duration-300">
            <div class="max-w-md mx-auto px-2 py-2 flex items-center">
                <a href="{{ route('customer.cart') }}" class="transition-all duration-300 hover:text-blue-500 active:scale-95 text-[#4871AD]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <h1 class="text-xl sm:text-2xl md:text-3xl text-[#4871AD] font-medium ml-3 font-serif">Checkout</h1>
            </div>
        </div>
        <!-- Desktop Topbar -->
        <div class="hidden lg:flex items-center pt-10 pb-6 px-4 lg:px-12">
            <a href="{{ route('customer.cart') }}" class="transition-all duration-300 hover:text-blue-500 active:scale-95 text-[#4871AD] mr-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h1 class="text-2xl md:text-4xl font-normal text-[#4871AD] tracking-tight font-serif">Checkout</h1>
        </div>
        <!-- Checkout Content -->
       <div class="pt-16 lg:pt-0 px-0 pb-10 lg:px-0 lg:pb-6 grid grid-cols-1 lg:grid-cols-[2fr_1fr] gap-3 sm:gap-4 md:gap-6 lg:gap-10">
            <!-- Left Column - Main Content -->
            <div class="space-y-3 sm:space-y-4 md:space-y-6">
                @include('components.modals.status')
                @include('components.modals.errors')
                <!-- Address Section -->
                <div class="bg-white rounded-lg sm:rounded-2xl p-3 sm:p-5 lg:p-8 shadow transition-all">
                    <h2 class="text-lg sm:text-xl lg:text-2xl font-normal mb-3 sm:mb-5 text-[#4871AD] font-serif border-b border-blue-100 pb-2">Alamat Pengiriman</h2>
                    <div class="bg-gray-50 p-3 sm:p-5 rounded-md sm:rounded-xl">
                        <div class="flex items-start space-x-2 sm:space-x-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-white rounded-full flex items-center justify-center shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-[#4871AD]">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25s-7.5-4.108-7.5-11.25a7.5 7.5 0 1115 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-normal text-gray-800 text-base sm:text-lg font-serif">{{ auth('customer')->user()->name }}</p>
                                <p class="text-gray-600 text-xs sm:text-sm mt-1 font-serif">{{ auth('customer')->user()->email }}</p>
                                <p class="text-gray-700 mt-2 text-xs sm:text-base font-serif">
                                    @if(auth('customer')->user()->address)
                                        {{ auth('customer')->user()->address }}
                                    @else
                                        <span class="text-red-500">Alamat belum ditambahkan</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Products Section -->
                @if(isset($cartOrders) && $cartOrders->isNotEmpty())
                    <div class="bg-white rounded-lg sm:rounded-2xl p-3 sm:p-5 lg:p-8 shadow transition-all">
                        <h2 class="text-lg sm:text-xl lg:text-2xl font-normal mb-3 sm:mb-5 text-[#4871AD] font-serif border-b border-blue-100 pb-2">Pesanan Anda</h2>
                        <div class="space-y-3 sm:space-y-5">
                            @foreach ($cartOrders as $order)
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
                                    <!-- Shop Card -->
                                    <div class="bg-[#4871AD] rounded-lg sm:rounded-2xl overflow-hidden shadow-lg">
                                        <!-- Shop Header -->
                                        <div class="px-3 sm:px-6 pt-3 sm:pt-4 pb-2">
                                            <div class="flex items-center space-x-2 sm:space-x-3">
                                                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-white/20 rounded-full flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-1.25 0a.75.75 0 01-.75-.75v-.818a.75.75 0 01.75-.75h3a.75.75 0 01.75.75v.818a.75.75 0 01-.75.75m-1.25 0v2.568" />
                                                </div>
                                                <p class="font-normal text-white text-base sm:text-lg font-serif">{{ $seller->shop_name }}</p>
                                            </div>
                                        </div>
                                        <!-- Divider -->
                                        <div class="border-t border-white/20 mx-3 sm:mx-6"></div>
                                        <!-- Products -->
                                        @foreach ($sellerOrderLines as $index => $orderLine)
                                            <div class="px-3 sm:px-6 py-3 sm:py-4">
                                                <div class="flex items-center space-x-2 sm:space-x-4">
                                                    <!-- Product Image -->
                                                    <div class="w-12 h-12 sm:w-20 sm:h-20 bg-white/20 rounded-md sm:rounded-xl flex items-center justify-center overflow-hidden">
                                                        @if($orderLine->product->image_cover)
                                                            <img src="{{ Storage::url($orderLine->product->image_cover) }}" alt="{{ $orderLine->product->name }}" class="w-full h-full object-cover rounded-md sm:rounded-xl">
                                                        @else
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-10 h-10 text-white/50">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                            </svg>
                                                        @endif
                                                    </div>
                                                    <!-- Product Details -->
                                                    <div class="flex-1">
                                                        <h3 class="font-normal text-white text-xs sm:text-base lg:text-lg font-serif">{{ $orderLine->product->name }}</h3>
                                                        <p class="text-white/90 text-xs sm:text-sm lg:text-base mt-1 font-serif">Rp{{ number_format($orderLine->product->price, 0, ',', '.') }}</p>
                                                    </div>
                                                    <!-- Quantity Controls -->
                                                    <div class="flex items-center space-x-1 sm:space-x-3">
                                                        <!-- Decrement Button -->
                                                        <form method="POST" action="{{ route('customer.remove-from-cart', ['order' => $order->id, 'product' => $orderLine->product->id]) }}" class="quantity-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="w-7 h-7 sm:w-9 sm:h-9 bg-white text-[#4871AD] font-normal rounded-md sm:rounded-xl flex items-center justify-center shadow-lg transition-all hover:scale-110 active:scale-95 font-serif">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                        <!-- Quantity Display -->
                                                        <span class="w-7 sm:w-8 text-center text-white font-normal text-xs sm:text-base font-serif">{{ $orderLine->quantity }}</span>
                                                        <!-- Increment Button -->
                                                        <form method="POST" action="{{ route('customer.add-to-cart', ['product' => $orderLine->product->id]) }}" class="quantity-form">
                                                            @csrf
                                                            <button type="submit" class="w-7 h-7 sm:w-9 sm:h-9 bg-white text-[#4871AD] font-normal rounded-md sm:rounded-xl flex items-center justify-center shadow-lg transition-all hover:scale-110 active:scale-95 font-serif">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Divider -->
                                            @if(!$loop->last)
                                                <div class="border-t border-white/20 mx-3 sm:mx-6"></div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-lg sm:rounded-2xl p-6 sm:p-12 text-center shadow">
                        <div class="w-14 h-14 sm:w-24 sm:h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-8 h-8 sm:w-12 sm:h-12 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                            </svg>
                        </div>
                        <p class="text-gray-500 text-sm sm:text-lg font-serif">Keranjang kosong. Silakan tambahkan produk terlebih dahulu.</p>
                    </div>
                @endif
                <!-- Shipping Options -->
                <div class="bg-white rounded-lg sm:rounded-2xl p-3 sm:p-5 lg:p-8 shadow transition-all">
                    <h2 class="text-lg sm:text-xl lg:text-2xl font-normal mb-3 sm:mb-5 text-[#4871AD] font-serif border-b border-blue-100 pb-2">Opsi Pengiriman</h2>
                    <div class="flex flex-col gap-2 sm:gap-0 sm:flex-row sm:items-center sm:space-x-4">
                        <label for="shipping_standard" class="flex items-center w-full sm:w-auto bg-white rounded-md sm:rounded-xl p-3 sm:p-5 border-2 border-transparent hover:border-[#4871AD] transition-all cursor-pointer">
                            <input type="radio" name="shipping" id="shipping_standard" value="standard" checked class="w-5 h-5 text-[#4871AD] border-2 border-gray-300 focus:ring-[#4871AD] focus:ring-2 mr-3">
                            <div class="flex items-center space-x-2 flex-1">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-green-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0V6.375a1.5 1.5 0 013 0V18.75zM12 18.75V6.375a1.5 1.5 0 013 0V18.75m-3 0h3m-3 0h-3M9 14.25v3m6-3v3" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <span class="block font-normal text-gray-800 text-sm sm:text-lg font-serif">Pengiriman Standard</span>
                                    <span class="block text-gray-600 text-xs sm:text-sm font-serif">Estimasi 2-3 hari kerja</span>
                                </div>
                            </div>
                            <div class="text-right ml-2">
                                <span class="text-green-600 font-normal text-sm sm:text-lg font-serif">Gratis</span>
                                <p class="text-gray-500 text-xs">Ongkos Kirim</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            <!-- Right Column - Payment Summary -->
            <div class="lg:sticky lg:top-8 lg:h-fit mt-6 lg:mt-0">
                <div class="rounded-lg sm:rounded-2xl p-3 sm:p-6 lg:p-8 text-white shadow-xl border border-[#4871AD]/20 bg-[#4871AD] relative overflow-hidden">
                    <h2 class="text-lg sm:text-xl lg:text-2xl font-normal mb-3 sm:mb-5 flex items-center gap-2 font-serif">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 sm:w-7 h-6 sm:h-7 text-white/80">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 10c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                        </svg>
                        Ringkasan Pembayaran
                    </h2>
                    @php
                        $subtotal = 0;
                        if(isset($cartOrders)) {
                            foreach ($cartOrders as $order) {
                                foreach ($order->orderLines as $orderLine) {
                                    $subtotal += $orderLine->quantity * $orderLine->product->price;
                            }
                        }
                    }
                    $shipping = 0;
                    $total = $subtotal + $shipping;
                    @endphp
                    <div class="space-y-2 sm:space-y-4 mb-2 sm:mb-4">
                        <div class="flex justify-between items-center py-2 border-b border-white/20">
                            <span class="text-white/90 font-serif text-xs sm:text-base">Subtotal Produk</span>
                            <span class="font-normal text-sm sm:text-lg font-serif">Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-white/20">
                            <span class="text-white/90 font-serif text-xs sm:text-base">Ongkos Kirim</span>
                            <span class="font-normal text-sm sm:text-lg text-green-300 font-serif">Gratis</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-base sm:text-xl font-normal font-serif">Total</span>
                            <span class="text-lg sm:text-2xl font-normal font-serif">Rp{{ number_format($orderTotalPrice ?? $total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <div class="mb-2 sm:mb-4">
                        <div class="flex items-center gap-2 text-white/80 text-xs sm:text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 sm:w-5 h-4 sm:h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-3-3v6" />
                            </svg>
                            Semua harga sudah termasuk PPN.
                        </div>
                    </div>
                    <!-- Checkout Button -->
                    <form action="{{ route('customer.checkout.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="shipping_method" value="standard">
                        <input type="hidden" name="total_amount" value="{{ $orderTotalPrice ?? $total }}">
                        <button type="submit" class="w-full text-white py-3 sm:py-4 px-4 sm:px-6 rounded-lg sm:rounded-xl font-normal text-base sm:text-lg shadow-lg mt-2 bg-[#4871AD] hover:bg-[#5A7BC4] transition-all font-serif flex items-center justify-center space-x-2 sm:space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 sm:w-6 h-5 sm:h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                            </svg>
                            <span>Buat Pesanan</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>