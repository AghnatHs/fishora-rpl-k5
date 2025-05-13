<x-app-layout>
    <div class="max-w-md mx-auto bg-white pb-16">
        {{-- Header with back button --}}
        <div class="fixed -top-1 left-4 right-4 z-30 bg-white pb-2">
            <div class="max-w-md mx-auto flex items-center p-2">
                <a href="{{ route('admin.dashboard.products-monitoring') }}" class="mr-2">
                    <i class="fas fa-arrow-left text-[#4871AD] text-lg"></i>
                </a>
                <h2 class="text-2xl font-serif font-medium text-[#4871AD]">Info Produk</h2>
            </div>
        </div>

        <div class="h-10"></div>

        <div class="px-2">
            @include('components.modals.status')
            @include('components.modals.errors')
        </div>
    
        {{-- Content container--}}
        <div class="px-2 space-y-4">
            {{-- Product Card --}}
            <div class="rounded-lg p-4 shadow-sm border-2 border-[#4871AD]/30 flex flex-col mb-4">
                {{-- Product Image --}}
                <div x-data="{
                    active: 0,
                    images: {{ $productImages->toJson() }}
                }" class="relative w-full h-64 sm:h-[300px] overflow-hidden rounded-lg mb-3">

                    {{-- Images --}}
                    <template x-for="(image, index) in images" :key="index">
                        <div x-show="active === index" class="absolute inset-0 transition-opacity duration-300">
                            <img :src="image.url" class="w-full h-full object-contain" alt="Product image" />
                        </div>
                    </template>

                    {{-- Navigation Buttons --}}
                    <template x-if="images.length > 1">
                        <div>
                            <button @click="active = (active - 1 + images.length) % images.length"
                                class="absolute left-2 top-1/2 -translate-y-1/2 bg-[#4871AD]/70 text-white p-2 rounded-full shadow">
                                <i class="fas fa-chevron-left"></i>
                            </button>

                            <button @click="active = (active + 1) % images.length"
                                class="absolute right-2 top-1/2 -translate-y-1/2 bg-[#4871AD]/70 text-white p-2 rounded-full shadow">
                                <i class="fas fa-chevron-right"></i>
                            </button>

                            <div class="absolute bottom-2 w-full flex justify-center gap-1">
                                <template x-for="(image, index) in images" :key="'dot-' + index">
                                    <button @click="active = index"
                                        :class="{
                                            'bg-[#4871AD] w-2 h-2 rounded-full': true,
                                            'opacity-100': active === index,
                                            'opacity-40': active !== index
                                        }"
                                        class="transition-opacity"></button>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>

                {{-- Product Info --}}
                <div class="flex-1">
                    <h3 class="font-serif font-medium text-lg text-[#4871AD] mb-1">{{ $product->name }}</h3>
                    <p class="text-sm text-[#4871AD]/70 mb-1 font-serif">
                        Penjual: {{ $product->seller->shop_name ?? '-' }}
                    </p>

                    <p class="text-sm text-[#4871AD] font-medium font-serif">
                        Harga: Rp{{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    {{-- Categories --}}
                    <div class="mt-2 flex flex-wrap gap-1">
                        @foreach ($product->categories as $category)
                            <span class="text-xs bg-[#4871AD]/10 text-[#4871AD] px-2.5 py-1 rounded-md font-serif">
                                {{ $category->name }}
                            </span>
                        @endforeach
                    </div>

                    {{-- Warning Produk - Consistent layout for both mobile and desktop --}}
                    <div class="mt-4 space-y-3">
                        @foreach ($product->warnings as $index => $warning)
                            <div class="border-t-2 border-[#4871AD]/30 pt-3">
                                <form method="POST"
                                    action="{{ route('admin.dashboard.products-monitoring.update', ['productWarning' => $warning]) }}"
                                    class="flex flex-col gap-2 text-sm">
                                    @csrf
                                    @method('PUT')

                                    {{-- Top section with warning label and status badge --}}
                                    <div class="flex items-center gap-2">
                                        <span class="font-semibold text-[#4871AD] font-serif">WARN {{ $index + 1 }}</span>
                                        <span class="px-2 py-0.5 rounded text-white text-xs font-serif
                                                {{ $warning->status === 'RESOLVED' ? 'bg-green-500' : 'bg-red-500' }}">
                                            {{ $warning->status }}
                                        </span>
                                    </div>

                                    {{-- Description - Below warning label on all screens --}}
                                    <p class="text-gray-500 font-serif text-sm">
                                        {{ $warning->description }}
                                    </p>

                                    {{-- Action controls with arrow shifted left --}}
                                    <div class="flex items-center gap-2 justify-end mt-1">
                                        <div class="relative">
                                            <select name="status"
                                                class="text-xs border border-[#4871AD]/30 rounded-md px-2 py-1 pr-7 font-serif focus:ring-1 focus:ring-[#4871AD] focus:outline-none w-32 appearance-none">
                                                <option value="UNRESOLVED" @selected($warning->status === 'UNRESOLVED')>UNRESOLVED</option>
                                                <option value="RESOLVED" @selected($warning->status === 'RESOLVED')>RESOLVED</option>
                                            </select>
                                            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                                <i class="fas fa-chevron-down text-[#4871AD] text-xs"></i>
                                            </div>
                                        </div>

                                        <button type="submit"
                                            class="px-2.5 py-1 bg-[#4871AD] text-white rounded-md text-xs hover:bg-[#3a5a8a] font-serif whitespace-nowrap">
                                            Update
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Product Warning Form --}}
            <div class="rounded-lg p-4 shadow-sm border-2 border-[#4871AD]/30">
                <form action="{{ route('admin.dashboard.products-monitoring.create', compact('product')) }}" method="POST">
                    @csrf

                    {{-- Description --}}
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-[#4871AD] mb-1 font-serif">
                            Deskripsi Peringatan
                        </label>
                        <textarea id="description" name="description" rows="3" required
                            class="w-full px-3 py-2 border border-[#4871AD]/30 rounded-md text-sm focus:outline-none focus:ring-1 focus:ring-[#4871AD] font-serif"
                            placeholder="Masukkan deskripsi / alasan peringatan..."></textarea>
                    </div>

                    {{-- Submit Button --}}
                    <div class="mt-4">
                        <button type="submit" 
                            class="w-full bg-[#4871AD] text-white py-2 rounded-md hover:bg-[#3a5a8a] font-serif text-sm transition duration-200">
                            Peringatkan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>