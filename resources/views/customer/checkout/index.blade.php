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
                        <div class="mb-6 md:mb-8">
                            <h2 class="text-lg font-medium text-[#4871AD] mb-2" style="font-family: 'DM Serif Text', serif;">
                                @if(isset($order->orderLines[0]->product->seller))
                                    {{ $order->orderLines[0]->product->seller->name }}
                                @else
                                    Toko Fishora
                                @endif
                            </h2>
                            
                            <div class="bg-white border rounded-lg mb-4 md:mb-6 md:p-6">
                                <div class="flex items-center gap-2 p-3 border-b bg-gray-50 rounded-t-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#4871AD" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 3.44A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72 3.001 3.001 0 0 1-3.75-.615A2.993 2.993 0 0 1 14.25 9.75c-.896 0-1.7-.393-2.25-1.016A2.993 2.993 0 0 1 9.75 9.75c-.896 0-1.7-.393-2.25-1.016a3.001 3.001 0 0 1-3.75.614 3.004 3.004 0 0 1-.621-4.72z" />
                                    </svg>
                                    <p class="font-semibold text-[#4871AD] text-base" style="font-family: 'DM Serif Text', serif;">
                                        {{ $order->orderLines[0]->product->seller->shop_name ?? 'Toko Fishora' }}
                                    </p>
                                </div>
                                
                                <div class="p-4 md:p-6">
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
                                                <p class="font-medium" style="font-family: 'DM Serif Text', serif;">{{ $orderLine->product->name }}</p>
                                                <div class="flex justify-between text-sm mt-1" style="font-family: 'DM Serif Text', serif;">
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
                @else
                    <div class="bg-gray-50 p-6 rounded-lg text-center">
                        <p style="font-family: 'DM Serif Text', serif;">Keranjang Anda kosong</p>
                        <a href="{{ route('homepage.index') }}" class="mt-3 inline-block text-[#4871AD] font-medium" style="font-family: 'DM Serif Text', serif;">Belanja Sekarang</a>
                    </div>
                @endif
            </div>
            <!-- Kolom Kanan: Rincian Pembayaran & Tombol Checkout -->
            <div class="flex flex-col gap-6">
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