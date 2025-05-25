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
                    
                </div>
            </div>
            
            <!-- Order Summary -->
            <h2 class="text-lg font-medium text-[#4871AD] mb-2">Ringkasan Pesanan</h2>
            
            @if(isset($cartOrders) && $cartOrders->count())
                @foreach ($cartOrders as $order)
                    <div class="bg-white border border-gray-200 rounded-lg mb-4">
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
        @if(isset($cartOrders) && $cartOrders->count())
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
    <!-- Bottom Navigation -->
    <div class="fixed bottom-0 left-0 right-0 bg-[#4871AD] text-white z-30">
        <div class="max-w-md mx-auto grid grid-cols-4 text-center">
            <!-- Home -->
            <a href="{{ route('homepage.index') }}" class="py-2 flex flex-col items-center relative group">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 24V8L12 0L24 8V24H15V14.7H9V24H0Z" />
                </svg>
                <span class="text-xs font-serif mt-0.5">Home</span>
                <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
            </a>
            
            <!-- Transaction -->
            <a href="{{ route('customer.transactions') }}" class="py-2 flex flex-col items-center relative group">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 3H5C3.89 3 3 3.9 3 5V19C3 20.1 3.89 21 5 21H19C20.11 21 21 20.1 21 19V5C21 3.9 20.11 3 19 3ZM9 17H7V10H9V17ZM13 17H11V7H13V17ZM17 17H15V13H17V17Z" />
                </svg>
                <span class="text-xs font-serif mt-0.5">Transaction</span>
                <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
            </a>
            
            <!-- Inbox -->
            <a href="{{ route('customer.inbox') }}" class="py-2 flex flex-col items-center relative group">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 20.9999C2.45 20.9999 1.979 20.8042 1.587 20.4128C1.195 20.0214 0.999333 19.5507 1 18.9999V4.99994C1 4.44994 1.196 3.97894 1.588 3.58694C1.98 3.19494 2.451 2.99928 3 2.99994H21C21.55 2.99994 22.021 3.19594 22.413 3.58794C22.805 3.97994 23.0007 4.45061 23 4.99994V18.9999C23 19.5499 22.804 20.0209 22.412 20.4129C22.02 20.8049 21.5493 21.0006 21 20.9999H3ZM12 13.9999C12.283 13.9999 12.521 13.9039 12.713 13.7119C12.905 13.5199 13.0007 13.2826 13 12.9999H21V4.99994H3V12.9999H11C11 13.2839 11.096 13.5219 11.288 13.7139C11.48 13.9059 11.7173 14.0013 12 13.9999Z" />
                </svg>
                <span class="text-xs font-serif mt-0.5">Inbox</span>
                <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
            </a>
            
            <!-- Account (active) -->
            <a href="{{ route('customer.dashboard') }}" class="py-2 flex flex-col items-center relative group">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 12C10.9 12 9.95833 11.6083 9.175 10.825C8.39167 10.0417 8 9.1 8 8C8 6.9 8.39167 5.95833 9.175 5.175C9.95833 4.39167 10.9 4 12 4C13.1 4 14.0417 4.39167 14.825 5.175C15.6083 5.95833 16 6.9 16 8C16 9.1 15.6083 10.0417 14.825 10.825C14.0417 11.6083 13.1 12 12 12ZM18 20H6C5.45 20 4.97933 19.8043 4.588 19.413C4.19667 19.0217 4.00067 18.5507 4 18V17.2C4 16.6333 4.146 16.1123 4.438 15.637C4.73 15.1617 5.11733 14.7993 5.6 14.55C6.63333 14.0333 7.68333 13.6457 8.75 13.387C9.81667 13.1283 10.9 12.9993 12 13C13.1 13 14.1833 13.1293 15.25 13.388C16.3167 13.6467 17.3667 14.034 18.4 14.55C18.8833 14.8 19.271 15.1627 19.563 15.638C19.855 16.1133 20.0007 16.634 20 17.2V18C20 18.55 19.8043 19.021 19.413 19.413C19.0217 19.805 18.5507 20.0003 18 20Z" />
                </svg>
                <span class="text-xs font-serif mt-0.5">Account</span>
                <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t opacity-100"></span>
            </a>
        </div>
    </div>
</x-app-layout> 