<x-full-layout>
    <!-- Main container -->
    <div class="mx-auto max-w-md w-full min-h-screen bg-white lg:max-w-6xl lg:shadow-none lg:my-0 overflow-hidden">
        <!-- Notification area -->
        <div class="fixed top-18 left-0 right-0 z-[60] px-4">
            <div class="max-w-md lg:max-w-2xl mx-auto px-4">
                @include('components.modals.status')
                @include('components.modals.errors')
            </div>
        </div>

        <!-- Back & Cart Button  -->
        <div class="fixed top-4 z-50 w-full max-w-md lg:max-w-6xl left-1/2 -translate-x-1/2 px-4 flex justify-between lg:justify-end lg:gap-4">
            <!-- Back button -->
            <a href="{{ route('homepage.index') }}" 
               class="flex items-center justify-center w-11 h-11 rounded-full bg-white/80 backdrop-blur-sm shadow-lg hover:bg-[#e6eefd] hover:scale-110 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="#4871AD" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            <!-- Cart button with badge -->
            @auth('customer')
                <a href="{{ route('customer.cart') }}" class="flex items-center justify-center w-11 h-11 rounded-full bg-white/80 backdrop-blur-sm shadow-lg relative hover:bg-[#e6eefd] hover:scale-110 transition-all duration-200">
                    <i class="fas fa-shopping-cart text-[#4871AD] text-xl"></i>
                    @if(session('cart_count', 0) > 0)
                        <span class="absolute top-0.5 right-0.5 bg-red-500 text-white text-[10px] rounded-full min-w-[14px] h-[14px] flex items-center justify-center font-medium leading-none animate-bounce">
                            {{ session('cart_count') }}
                        </span>
                    @endif
                </a>
            @endauth
        </div>
        
        <div class="flex flex-col min-h-screen bg-white lg:flex-row lg:gap-8 lg:px-12 lg:pt-24 lg:pb-12">
            <!-- Full-Screen Image Gallery  -->
            <div x-data="{
                active: 0,
                images: {{ $productImages->toJson() }}
            }" class="relative w-full h-[55vh] overflow-hidden lg:w-1/2 lg:h-auto lg:min-h-[500px] flex-shrink-0">
                <template x-for="(image, index) in images" :key="index">
                    <div x-show="active === index" class="absolute inset-0 transition-opacity duration-300 flex items-center justify-center">
                        <img :src="image.url" class="min-w-full min-h-full object-cover lg:rounded-2xl lg:shadow-lg" alt="Product image" />
                    </div>
                </template>
                <!-- Navigation Buttons-->
                <template x-if="images.length > 1">
                    <div>
                        <button @click="active = (active - 1 + images.length) % images.length"
                            class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/80 backdrop-blur-sm text-[#4871AD] p-2.5 rounded-full shadow-lg hover:bg-[#e6eefd] hover:scale-110 transition-all duration-200">
                            <i class="fas fa-chevron-left text-xl"></i>
                        </button>
                        <button @click="active = (active + 1) % images.length"
                            class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/80 backdrop-blur-sm text-[#4871AD] p-2.5 rounded-full shadow-lg hover:bg-[#e6eefd] hover:scale-110 transition-all duration-200">
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
                                    class="transition-all hover:scale-125"></button>
                            </template>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Main Content-->
            <div class="px-5 pt-5 pb-24 overflow-y-auto flex-1 lg:px-0 lg:pt-0 lg:pb-0 lg:w-1/2 lg:flex lg:flex-col lg:justify-between">
                <!-- Price and Title -->
                <div class="mb-6 lg:mb-8">
                    <p class="text-2xl font-normal" style="font-family: 'DM Serif Text', serif; color: #4871AD;">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    <h2 class="text-lg mt-0.5 mb-1 font-normal" style="font-family: 'DM Serif Text', serif; color: #4871AD;">{{ $product->name }} | <span class="text-base font-normal">Stok: {{ $product->stock }}</span></h2>
                    <!-- Seller Info -->
                    <div class="flex items-center mt-2 mb-3">
                        <div class="w-8 h-8 bg-[#4871AD]/10 rounded-full flex items-center justify-center text-[#4871AD] mr-2">
                            <i class="fas fa-store text-sm"></i>
                        </div>
                        <div>
                            <p class="text-base font-normal" style="font-family: 'DM Serif Text', serif; color: #4871AD;">{{ $product->seller->shop_name }}</p>
                        </div>
                    </div>
                    <!-- Categories -->
                    <div class="flex flex-wrap gap-2">
                        @foreach($product->categories as $category)
                            <span class="inline-block px-3 py-1 bg-[#4871AD]/10 text-[#4871AD] rounded-full text-sm font-normal hover:bg-[#4871AD] hover:text-white transition-all duration-200 cursor-pointer" style="font-family: 'DM Serif Text', serif;">
                                {{ $category->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
                <!-- Description -->
                <div class="mb-10 lg:mb-0">
                    <h2 class="text-lg mb-1 font-normal" style="font-family: 'DM Serif Text', serif; color: #4871AD;">Deskripsi</h2>
                    <p class="text-base text-gray-600 font-normal whitespace-pre-line" style="font-family: 'DM Serif Text', serif;">{{ $product->description }}</p>
                </div>
                <!-- Action Buttons  -->
                <div class="fixed bottom-0 left-0 right-0 bg-white py-3 px-4 border-t border-gray-300 z-30 lg:static lg:border-none lg:bg-transparent lg:p-0">
                    <div class="w-full max-w-md mx-auto flex justify-between lg:max-w-none lg:mx-0 lg:gap-6">
                        <a href="@auth('customer') # @else # @endauth" class="flex-1 mr-3 flex flex-col items-center text-[#4871AD] font-normal hover:bg-[#e6eefd] hover:scale-105 rounded-lg py-2 transition-all duration-200" style="font-family: 'DM Serif Text', serif;">
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
                                <button type="submit" class="w-full flex flex-col items-center text-[#4871AD] font-normal cart-button hover:bg-[#e6eefd] hover:scale-105 rounded-lg py-2 transition-all duration-200" data-content="Keranjang" style="font-family: 'DM Serif Text', serif;">
                                    <div class="text-2xl mb-1 cart-icon-container">
                                        <i class="fas fa-shopping-cart text-[#4871AD] text-xl"></i>
                                    </div>
                                    <span class="text-sm">Keranjang</span>
                                </button>
                            </form>
                        @endauth
                    </div>
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
