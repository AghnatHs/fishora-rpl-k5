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
            
            <!-- Shipping Information -->
            <div class="mb-6">
                <h2 class="text-lg font-medium text-[#4871AD] mb-2">Informasi Pengiriman</h2>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm">{{ auth('customer')->user()->name }}</p>
                    <p class="text-sm">{{ auth('customer')->user()->email }}</p>
                    <!-- Tambahkan informasi alamat jika ada -->
                </div>
            </div>
            
            <!-- Order Summary -->
            <h2 class="text-lg font-medium text-[#4871AD] mb-2">Ringkasan Pesanan</h2>
            
            @if(isset($cartOrders) && $cartOrders->isNotEmpty())
                @foreach ($cartOrders as $order)
                    <div class="bg-white border rounded-lg mb-4">
                        <div class="p-3 border-b">
                            <p class="font-medium">Order #{{ $order->id }}</p>
                        </div>
                        
                        <div class="p-4">
                            @foreach ($order->orderLines as $orderLine)
                                <div class="mb-3 {{ !$loop->last ? 'border-b pb-3' : '' }}">
                                    <p class="font-medium">{{ $orderLine->product->name }}</p>
                                    <div class="flex justify-between text-sm mt-1">
                                        <span>{{ $orderLine->quantity }} x Rp{{ number_format($orderLine->product->price, 0, ',', '.') }}</span>
                                        <span>Rp{{ number_format($orderLine->quantity * $orderLine->product->price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                
                <!-- Total -->
                <div class="mt-6 bg-white border border-gray-200 rounded-lg p-4">
                    <div class="flex justify-between items-center">
                        <p class="font-medium">Total</p>
                        <p class="font-bold text-[#4871AD]">Rp{{ number_format($orderTotalPrice ?? 0, 0, ',', '.') }}</p>
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
                    <form action="{{ route('customer.checkout.process') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-[#4871AD] text-white py-3 rounded-md font-medium">
                            Bayar Sekarang
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>