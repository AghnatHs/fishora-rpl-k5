<<<<<<< HEAD
<x-app-layout>
    <div class="max-w-md mx-auto min-h-screen bg-white flex flex-col sm:max-w-2xl">
        {{-- Back button --}}
        <div class="p-4 flex items-center">
            <a href="{{ url()->previous() }}" class="text-gray-700">
                <i class="fas fa-arrow-left text-lg"></i>
=======
<x-full-layout>
    <!-- Main container -->
    <div class="mx-auto max-w-md w-full min-h-screen bg-white lg:shadow-lg lg:my-0 overflow-hidden">
        <!-- Notification area -->
        <div class="fixed top-18 left-0 right-0 z-[60] px-4">
            <div class="max-w-md mx-auto px-4">
                @include('components.modals.status')
                @include('components.modals.errors')
            </div>
        </div>

        <!-- Back Button  -->
        <div class="fixed top-4 z-50 w-full max-w-md left-1/2 -translate-x-1/2 px-4 flex justify-between">
            <!-- Back button -->
            <a href="{{ route('homepage.index') }}" 
               class="flex items-center justify-center w-11 h-11 rounded-full bg-white/80 backdrop-blur-sm shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="#4871AD" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            
            <!-- Cart button with badge -->
            <a href="{{ route('customer.cart') }}" class="flex items-center justify-center w-11 h-11 rounded-full bg-white/80 backdrop-blur-sm shadow-lg relative">
                <i class="fas fa-shopping-cart text-[#4871AD] text-xl"></i>
                @auth('customer')
                    @if(session('cart_count', 0) > 0)
                        <span class="absolute top-0.5 right-0.5 bg-red-500 text-white text-[10px] rounded-full min-w-[14px] h-[14px] flex items-center justify-center font-medium leading-none">
                            {{ session('cart_count') }}
                        </span>
                    @endif
                @endauth
>>>>>>> 55606a5f9641f580bee3e831478329a8c5a6f973
            </a>
            <h1 class="text-lg font-medium ml-4">Detail Produk</h1>
        </div>
        
        <div class="flex flex-col min-h-screen bg-white">
            <!-- Full-Screen Image Gallery  -->
            <div x-data="{
                active: 0,
                images: {{ $productImages->toJson() }}
            }" class="relative w-full h-[55vh] overflow-hidden">
                
                <template x-for="(image, index) in images" :key="index">
                    <div x-show="active === index" class="absolute inset-0 transition-opacity duration-300 flex items-center justify-center">
                        <img :src="image.url" class="min-w-full min-h-full object-cover" alt="Product image" />
                    </div>
                </template>

<<<<<<< HEAD
        {{-- Product Image Slider --}}
        <div x-data="{
            active: 0,
            images: {{ $productImages->toJson() }}
        }" class="relative w-full aspect-square bg-gray-100">
            {{-- Images --}}
            <template x-for="(image, index) in images" :key="index">
                <div x-show="active === index" class="absolute inset-0 transition-opacity duration-300 flex items-center justify-center">
                    <img :src="image.url" class="max-w-full max-h-full object-contain" />
                </div>
            </template>

            {{-- Navigation Arrows (only show if more than one image) --}}
            <template x-if="images.length > 1">
                <div>
                    <button @click="active = (active - 1 + images.length) % images.length"
                        class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/80 w-8 h-8 rounded-full shadow flex items-center justify-center">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button @click="active = (active + 1) % images.length"
                        class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/80 w-8 h-8 rounded-full shadow flex items-center justify-center">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </template>

            {{-- Dots (only show if more than one image) --}}
            <template x-if="images.length > 1">
                <div class="absolute bottom-3 w-full flex justify-center gap-1.5">
                    <template x-for="(image, index) in images" :key="'dot-' + index">
                        <button @click="active = index"
                            :class="{
                                'w-2 h-2 rounded-full transition-colors': true,
                                'bg-blue-600': active === index,
                                'bg-gray-400': active !== index
                            }">
                        </button>
                    </template>
                </div>
            </template>
            
            {{-- No Image Fallback --}}
            <template x-if="images.length === 0">
                <div class="w-full h-full flex items-center justify-center">
                    <svg class="w-16 h-16 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </template>
        </div>

        {{-- Product Details --}}
        <div class="p-4 flex-1 flex flex-col justify-between">
            <div>
                {{-- Price and Name --}}
                <h2 class="text-xl font-bold text-gray-800 mb-1">
                    Rp{{ number_format($product->price, 0, ',', '.') }}
                </h2>
                <div class="flex justify-between items-center mb-3">
                    <p class="text-gray-700 font-medium">{{ $product->name }}</p>
                    <span class="text-sm text-gray-500">Stok: {{ $product->stock }}</span>
                </div>
                
                {{-- Seller & Categories --}}
                <div class="flex flex-wrap gap-2 mb-3">
                    <span class="inline-block bg-red-100 text-red-600 text-xs px-3 py-1 rounded-full font-medium">
                        {{ $product->seller->shop_name }}
                    </span>
                    
                    @foreach ($product->categories as $category)
                        <span class="text-xs bg-gray-100 text-gray-600 px-3 py-1 rounded-full">
                            {{ $category->name }}
                        </span>
                    @endforeach
                </div>
                
                {{-- Description --}}
                <div class="mb-4 mt-4 border-t pt-3">
                    <h3 class="font-medium text-gray-800 mb-2">Deskripsi Produk</h3>
                    <p class="text-sm text-gray-600">
                        {{ $product->description ?? 'Deskripsi produk belum tersedia.' }}
                    </p>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-3 mt-4">
                <div class="flex gap-2">
                    <button class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center">
                        <i class="fas fa-comment-dots text-gray-700"></i>
                    </button>
                    <button class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center">
                        <i class="fas fa-cart-plus text-gray-700"></i>
                    </button>
                </div>
                
                <button class="flex-1 bg-blue-600 text-white py-3 rounded-lg font-medium text-sm hover:bg-blue-700 transition">
                    Beli Sekarang
                </button>
            </div>
        </div>
    </div>
    
    {{-- Bottom Navigation --}}
    <div class="fixed bottom-0 left-0 right-0 bg-blue-600 text-white flex justify-around items-center py-3 px-2 shadow-lg z-10">
        <a href="{{ route('homepage.index') }}" class="flex flex-col items-center text-xs">
            <i class="fas fa-home text-xl mb-1"></i>
            <span>Home</span>
        </a>
        <a href="#" class="flex flex-col items-center text-xs">
            <i class="fas fa-receipt text-xl mb-1"></i>
            <span>Transaction</span>
        </a>
        <a href="#" class="flex flex-col items-center text-xs">
            <i class="fas fa-inbox text-xl mb-1"></i>
            <span>Inbox</span>
        </a>
        <a href="@auth('admin'){{ route('admin.dashboard') }}
                @elseif(auth('seller')->check()){{ route('seller.dashboard') }}
                @elseif(auth('customer')->check()){{ route('customer.dashboard') }}
                @else{{ route('customer.login') }}@endauth" 
            class="flex flex-col items-center text-xs">
            <i class="fas fa-user text-xl mb-1"></i>
            <span>Account</span>
        </a>
    </div>
    
    {{-- Spacer to prevent content from being hidden under bottom nav --}}
    <div class="h-16"></div>
</x-app-layout>
=======
                <!-- Navigation Buttons-->
                <template x-if="images.length > 1">
                    <div>
                        <button @click="active = (active - 1 + images.length) % images.length"
                            class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/80 backdrop-blur-sm text-[#4871AD] p-2.5 rounded-full shadow-lg">
                            <i class="fas fa-chevron-left text-xl"></i>
                        </button>

                        <button @click="active = (active + 1) % images.length"
                            class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/80 backdrop-blur-sm text-[#4871AD] p-2.5 rounded-full shadow-lg">
                            <i class="fas fa-chevron-right text-xl"></i>
                        </button>

                        <!-- Indikator dot -->
                        <div class="absolute bottom-5 left-0 right-0 flex justify-center gap-3 z-10">
                            <template x-for="(image, index) in images" :key="'dot-' + index">
                                <button @click="active = index"
                                    :class="{
                                        'w-3 h-3 rounded-full shadow-lg border-2': true,
                                        'bg-[#4871AD] border-white': active === index,
                                        'bg-white border-gray-300': active !== index
                                    }"
                                    class="transition-all"></button>
                            </template>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Main Content-->
            <div class="px-5 pt-5 pb-24 overflow-y-auto flex-1">
                
                <!-- Price and Title -->
                <div class="mb-6">
                    <p class="text-2xl font-serif text-[#4871AD] font-medium">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    <h2 class="text-lg text-[#4871AD] font-serif mt-0.5 mb-1">{{ $product->name }} | <span class="text-base font-normal">Stok: {{ $product->stock }}</span></h2>
                    
                    <!-- Seller Info -->
                    <div class="flex items-center mt-2 mb-3">
                        <div class="w-8 h-8 bg-[#4871AD]/10 rounded-full flex items-center justify-center text-[#4871AD] mr-2">
                            <i class="fas fa-store text-sm"></i>
                        </div>
                        <div>
                            <p class="text-base font-serif text-[#4871AD]">{{ $product->seller->shop_name }}</p>
                        </div>
                    </div>
                    
                    <!-- Categories -->
                    <div class="flex flex-wrap gap-2">
                        @foreach($product->categories as $category)
                            <span class="inline-block px-3 py-1 bg-[#4871AD]/10 text-[#4871AD] rounded-full text-sm font-serif">
                                {{ $category->name }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-10">
                    <h2 class="text-lg text-[#4871AD] font-serif mb-1">Deskripsi</h2>
                    <p class="text-base text-gray-600 font-serif whitespace-pre-line">{{ $product->description }}</p>
                </div>
            </div>

            <!-- Action Buttons  -->
            <div class="fixed bottom-0 left-0 right-0 bg-white py-3 px-4 border-t border-gray-300 z-30 lg:max-w-md lg:mx-auto">
                <div class="w-full max-w-md mx-auto flex justify-between">
                    <a href="@auth('customer')
                              #
                          @else
                              {{ route('pick-login') }}
                          @endauth" class="flex-1 mr-3 flex flex-col items-center text-[#4871AD] font-serif">
                        <div class="text-2xl mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#4871AD" class="w-8 h-8">
                                <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/>
                            </svg>
                        </div>
                        <span class="text-sm">Chat</span>
                    </a>
                    
                    @auth('customer')
                        <form action="{{ route('customer.add-to-cart', compact('product')) }}" method="POST" class="flex-1 ml-3 cart-form">
                            @csrf
                            <button type="submit" class="w-full flex flex-col items-center text-[#4871AD] font-serif cart-button" data-content="Keranjang">
                                <div class="text-2xl mb-1 cart-icon-container">
                                    <i class="fas fa-shopping-cart text-[#4871AD] text-xl"></i>
                                </div>
                                <span class="text-sm">Keranjang</span>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('pick-login') }}" class="flex-1 ml-3 flex flex-col items-center text-[#4871AD] font-serif">
                            <div class="text-2xl mb-1">
                                <i class="fas fa-shopping-cart text-[#4871AD] text-xl"></i>
                            </div>
                            <span class="text-sm">Keranjang</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.cart-form').forEach(form => {
                form.addEventListener('submit', function() {
                    const button = this.querySelector('.cart-button');
                    
                    // Save the original HTML structure
                    const originalHTML = `
                        <div class="text-2xl mb-1 cart-icon-container">
                            <i class="fas fa-shopping-cart text-[#4871AD] text-xl"></i>
                        </div>
                        <span class="text-sm">Keranjang</span>
                    `;
                    
                    // Prevent default loading text by forcing the original HTML content
                    setTimeout(function() {
                        button.innerHTML = originalHTML;
                    }, 0);
                    
                    button.disabled = true;
                });
            });
        });
    </script>
</x-full-layout>
>>>>>>> 55606a5f9641f580bee3e831478329a8c5a6f973
