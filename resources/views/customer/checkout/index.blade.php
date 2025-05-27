<x-app-layout>
    <!-- Main container -->
    <div class="mx-auto w-full min-h-screen bg-white lg:shadow-lg lg:my-0 overflow-hidden max-w-[1400px] px-0 md:px-8 lg:px-16 xl:px-24">
        <!-- Fixed Top Navigation -->
        <div class="fixed top-0 left-0 right-0 bg-white z-20">
            <div class="max-w-md mx-auto px-4 py-4 flex items-center">
                <a href="{{ route('customer.cart') }}" class="text-[#4871AD]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <h1 class="text-2xl md:text-3xl text-[#4871AD] font-medium ml-3" style="font-family: 'DM Serif Text', serif;">Checkout</h1>
            </div>
        </div>
        
        <!-- Checkout Content -->
        <div class="pt-14 px-4 pb-24 md:pt-20 md:px-12 md:pb-32 lg:px-24 grid md:grid-cols-[1fr_400px] gap-8">
            <div class="md:col-span-2">
                @include('components.modals.status')
                @include('components.modals.errors')
                
                <!-- Alamat Pengiriman -->
                <div class="mb-6">
                <h2 class="text-lg font-medium text-[#4871AD] mb-2" style="font-family: 'DM Serif Text', serif;">Alamat</h2>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="font-medium" style="font-family: 'DM Serif Text', serif;">{{ auth('customer')->user()->name }}</p>
                    <p class="text-sm" style="font-family: 'DM Serif Text', serif;">{{ auth('customer')->user()->email }}</p>
                    <p class="text-sm mt-1" style="font-family: 'DM Serif Text', serif;">
                        @if(auth('customer')->user()->address)
                            {{ auth('customer')->user()->address }}
                        @else
                            Alamat belum ditambahkan
                        @endif
                    </p>
                </div>
            </div>
            
            <!-- Nama Toko & Pesanan -->
            @if(isset($cartOrders) && $cartOrders->isNotEmpty())
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
                        
                        <!-- One card per shop -->
                        <div class="bg-[#4871AD] rounded-lg overflow-hidden shadow-md mb-4 lg:max-w-m lg:mx-auto">
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
                                    <div class="w-16 h-16 bg-white/20 rounded flex items-center justify-center overflow-hidden">
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
                                            <p class="font-medium text-sm" style="font-family: 'DM Serif Text', serif;">{{ $orderLine->product->name }}</p>
                                            <p class="text-white/90 text-sm" style="font-family: 'DM Serif Text', serif;">Rp{{ number_format($orderLine->product->price, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Quantity Controls -->
                                    <div class="flex items-center ml-3">
                                        <!-- Decrement Button -->
                                        <form method="POST" action="{{ route('customer.remove-from-cart', ['order' => $order->id, 'product' => $orderLine->product->id]) }}" class="quantity-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-7 h-7 bg-white text-[#4871AD] font-bold rounded flex items-center justify-center transition-transform active:scale-90" 
                                                data-content="{{ $orderLine->quantity > 1 ? '-' : '-' }}" style="font-family: 'DM Serif Text', serif;">
                                                -
                                            </button>
                                        </form>

                                        <!-- Quantity Display -->
                                        <span class="mx-2 w-6 text-center text-white" style="font-family: 'DM Serif Text', serif;">{{ $orderLine->quantity }}</span>
                                        
                                        <!-- Increment Button -->
                                        <form method="POST" action="{{ route('customer.add-to-cart', ['product' => $orderLine->product->id]) }}" class="quantity-form">
                                            @csrf
                                            <button type="submit" class="w-7 h-7 bg-white text-[#4871AD] font-bold rounded flex items-center justify-center transition-transform active:scale-90"
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
                @endforeach
            @else
                <div class="text-center text-gray-500 my-12" style="font-family: 'DM Serif Text', serif;">
                    Keranjang kosong. Silakan tambahkan produk terlebih dahulu.
                </div>
            @endif
                <!-- Opsi Pengiriman -->
                <div class="mb-6">
                    <h2 class="text-lg font-medium text-[#4871AD] mb-2" style="font-family: 'DM Serif Text', serif;">Opsi Pengiriman</h2>
                    <div class="bg-white border rounded-lg p-4">
                        <div class="flex items-center">
                            <input type="radio" name="shipping" id="shipping_standard" value="standard" checked class="mr-3">
                            <label for="shipping_standard" class="flex-1">
                                <p class="font-medium" style="font-family: 'DM Serif Text', serif;">Standard</p>
                                <p class="text-sm text-gray-500" style="font-family: 'DM Serif Text', serif;">Estimasi 2-3 hari</p>
                            </label>
                            <span class="text-[#4871AD] font-medium" style="font-family: 'DM Serif Text', serif;">Gratis</span>
                        </div>
                    </div>
                </div>
                
                <!-- Rincian Pembayaran -->
                <div class="mb-6">
                    <h2 class="text-lg font-medium text-[#4871AD] mb-2" style="font-family: 'DM Serif Text', serif;">Rincian Pembayaran</h2>
                    <div class="bg-white border rounded-lg p-4 md:p-6">
                        @php
                            $subtotal = 0;
                            foreach ($cartOrders as $order) {
                                foreach ($order->orderLines as $orderLine) {
                                    $subtotal += $orderLine->quantity * $orderLine->product->price;
                                }
                            }
                            $shipping = 0; // Gratis ongkir
                            $total = $subtotal + $shipping;
                        @endphp
                        <div class="flex justify-between mb-2" style="font-family: 'DM Serif Text', serif;">
                            <span>Subtotal</span>
                            <span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between mb-2" style="font-family: 'DM Serif Text', serif;">
                            <span>Ongkos Kirim</span>
                            <span>Rp{{ number_format($shipping, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t my-2"></div>
                        <div class="flex justify-between font-medium text-[#4871AD]" style="font-family: 'DM Serif Text', serif;">
                            <span>Total</span>
                            <span>Rp{{ number_format($orderTotalPrice ?? $total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                <!-- Tombol Checkout -->
                <div>
                    <form action="{{ route('customer.checkout.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="shipping_method" value="standard">
                        <input type="hidden" name="total_amount" value="{{ $orderTotalPrice }}">
                        <button type="submit" class="w-full bg-[#4871AD] text-white py-3 rounded-md font-medium" style="font-family: 'DM Serif Text', serif;">
                            Buat Pesanan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>