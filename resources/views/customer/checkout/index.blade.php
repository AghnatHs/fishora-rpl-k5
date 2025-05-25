<x-app-layout>
    <!-- Main container -->
    <div class="mx-auto max-w-md w-full min-h-screen bg-white lg:shadow-lg lg:my-0 overflow-hidden">
        <!-- Fixed Top Navigation -->
        <div class="fixed top-0 left-0 right-0 bg-white z-20">
            <div class="max-w-md mx-auto px-4 py-4 flex items-center">
                <a href="{{ route('customer.cart') }}" class="text-[#4871AD]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <h1 class="text-2xl text-[#4871AD] font-medium ml-3">Checkout</h1>
            </div>
        </div>
        
        <!-- Checkout Content -->
        <div class="pt-20 px-4 pb-24">
            @include('components.modals.status')
            @include('components.modals.errors')
            
            <!-- Alamat Pengiriman -->
            <div class="mb-6">
                <h2 class="text-lg font-medium text-[#4871AD] mb-2">Alamat</h2>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="font-medium">{{ auth('customer')->user()->name }}</p>
                    <p class="text-sm">{{ auth('customer')->user()->email }}</p>
                    <p class="text-sm mt-1">
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
                    <div class="mb-6">
                        <h2 class="text-lg font-medium text-[#4871AD] mb-2">
                            @if(isset($order->orderLines[0]->product->seller))
                                {{ $order->orderLines[0]->product->seller->name }}
                            @else
                                Toko Fishora
                            @endif
                        </h2>
                        
                        <div class="bg-white border rounded-lg mb-4">
                            <div class="p-3 border-b">
                                <p class="font-medium">Order #{{ substr($order->id, 0, 8) }}</p>
                            </div>
                            
                            <div class="p-4">
                                @foreach ($order->orderLines as $orderLine)
                                    <div class="flex items-center mb-3 {{ !$loop->last ? 'border-b pb-3' : '' }}">
                                        <!-- Gambar Produk -->
                                        <div class="w-16 h-16 bg-gray-100 rounded flex items-center justify-center overflow-hidden mr-3">
                                            @if($orderLine->product->image_cover)
                                                <img src="{{ Storage::url($orderLine->product->image_cover) }}" alt="{{ $orderLine->product->name }}" class="w-full h-full object-cover">
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-gray-400">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            @endif
                                        </div>
                                        
                                        <!-- Informasi Produk -->
                                        <div class="flex-1">
                                            <p class="font-medium">{{ $orderLine->product->name }}</p>
                                            <div class="flex justify-between text-sm mt-1">
                                                <span>{{ $orderLine->quantity }} x Rp{{ number_format($orderLine->product->price, 0, ',', '.') }}</span>
                                                <span>Rp{{ number_format($orderLine->quantity * $orderLine->product->price, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            
                <!-- Opsi Pengiriman -->
                <div class="mb-6">
                    <h2 class="text-lg font-medium text-[#4871AD] mb-2">Opsi Pengiriman</h2>
                    <div class="bg-white border rounded-lg p-4">
                        <div class="flex items-center">
                            <input type="radio" name="shipping" id="shipping_standard" value="standard" checked class="mr-3">
                            <label for="shipping_standard" class="flex-1">
                                <p class="font-medium">Standard</p>
                                <p class="text-sm text-gray-500">Estimasi 2-3 hari</p>
                            </label>
                            <span class="text-[#4871AD] font-medium">Gratis</span>
                        </div>
                    </div>
                </div>
                
                <!-- Rincian Pembayaran -->
                <div class="mb-6">
                    <h2 class="text-lg font-medium text-[#4871AD] mb-2">Rincian Pembayaran</h2>
                    <div class="bg-white border rounded-lg p-4">
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
                        
                        <div class="flex justify-between mb-2">
                            <span>Subtotal</span>
                            <span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span>Ongkos Kirim</span>
                            <span>Rp{{ number_format($shipping, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t my-2"></div>
                        <div class="flex justify-between font-medium text-[#4871AD]">
                            <span>Total</span>
                            <span>Rp{{ number_format($orderTotalPrice ?? $total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-gray-50 p-6 rounded-lg text-center">
                    <p>Keranjang Anda kosong</p>
                    <a href="{{ route('homepage.index') }}" class="mt-3 inline-block text-[#4871AD] font-medium">Belanja Sekarang</a>
                </div>
            @endif
        </div>
        
        <!-- Fixed Payment Footer -->
        @if(isset($cartOrders) && $cartOrders->isNotEmpty())
            <div class="fixed bottom-0 left-0 right-0 z-30">
                <div class="max-w-md mx-auto bg-white border-t py-4 px-6">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-gray-500">Total</span>
                        <span class="font-medium text-[#4871AD]">Rp{{ number_format($orderTotalPrice ?? 0, 0, ',', '.') }}</span>
                    </div>
                    <form action="{{ route('customer.checkout.process') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-[#4871AD] text-white py-3 rounded-md font-medium">
                            Buat Pesanan
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>