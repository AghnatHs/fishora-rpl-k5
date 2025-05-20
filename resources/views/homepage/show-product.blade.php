<x-app-layout>
    <div class="max-w-md mx-auto min-h-screen bg-white flex flex-col sm:max-w-2xl">
        {{-- Back button --}}
        <div class="p-4 flex items-center">
            <a href="{{ url()->previous() }}" class="text-gray-700">
                <i class="fas fa-arrow-left text-lg"></i>
            </a>
            <h1 class="text-lg font-medium ml-4">Detail Produk</h1>
        </div>

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