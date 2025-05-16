<x-full-layout>
    <!-- Main container with padding removal -->
    <div class="mx-auto max-w-md w-full min-h-screen bg-white lg:shadow-lg lg:my-0 overflow-hidden">
        <!-- Fixed Back Button - centered on desktop -->
        <div class="fixed top-4 z-50 w-full max-w-md left-1/2 -translate-x-1/2 px-4 flex">
            <a href="{{ route('seller.products.index') }}" 
               class="flex items-center justify-center w-11 h-11 rounded-full bg-white/80 backdrop-blur-sm shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="#4871AD" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
        </div>
        
        <div class="flex flex-col min-h-screen bg-white">
            <!-- Full-Screen Image Gallery - Moved to top with no gap -->
            <div x-data="{
                active: 0,
                images: [
                    @if($product->image_cover)
                        '{{ Storage::url($product->image_cover) }}',
                    @endif
                    @foreach($product->images as $image)
                        '{{ Storage::url($image->filepath) }}',
                    @endforeach
                ]
            }" class="relative w-full h-[55vh] overflow-hidden">
                
                <!-- Images (Force full-screen coverage) -->
                <template x-for="(image, index) in images" :key="index">
                    <div x-show="active === index" class="absolute inset-0 transition-opacity duration-300 flex items-center justify-center">
                        <img :src="image" class="min-w-full min-h-full object-cover" alt="Product image" />
                    </div>
                </template>
                
                <!-- Empty State -->
                <div x-show="images.length === 0" class="w-full h-full flex items-center justify-center bg-gray-100">
                    <div class="w-24 h-24 border-2 border-[#4871AD] rounded-md flex items-center justify-center">
                        <svg class="w-12 h-12 text-[#4871AD]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>

                <!-- Navigation Buttons with improved contrast -->
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

                        <!-- Enhanced Dot indicators with larger size and stronger contrast -->
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

            <!-- Main Content (No Card Style) -->
            <div class="px-5 pt-5 pb-24 overflow-y-auto flex-1">
                @include('components.modals.status')
                @include('components.modals.errors')
                
                <!-- Price and Title -->
                <div class="mb-6">
                    <p class="text-2xl font-serif text-[#4871AD] font-medium">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <h2 class="text-lg text-[#4871AD] font-serif mt-0.5 mb-1">{{ $product->name }} | <span class="text-base font-normal">Stok: {{ $product->stock }}</span></h2>
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

            <!-- Action Buttons (Fixed at bottom) -->
            <div class="fixed bottom-0 left-0 right-0 bg-white py-3 px-4 border-t border-gray-200 z-30 lg:max-w-md lg:mx-auto">
                <div class="w-full max-w-md mx-auto flex justify-between">
                    <a href="{{ route('seller.products.edit', $product) }}" 
                    class="flex-1 mr-2 bg-[#4871AD] text-white font-serif text-center py-2.5 rounded-md flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        Edit
                    </a>
                    
                    <form method="POST" action="{{ route('seller.products.destroy', $product) }}" class="flex-1 ml-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('Yakin ingin menghapus produk ini?')"
                                class="w-full bg-white border border-[#4871AD] text-[#4871AD] font-serif text-center py-2.5 rounded-md flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</x-full-layout>