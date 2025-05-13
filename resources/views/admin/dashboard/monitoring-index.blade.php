<x-app-layout>
    <div class="max-w-md mx-auto bg-white pb-16">
        {{-- Header with back button --}}
        <div class="fixed -top-1 left-4 right-4 z-30 bg-white pb-[16px]">
            <div class="max-w-md mx-auto flex items-center p-2">
                <a href="{{ route('admin.dashboard') }}" class="mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#4871AD" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <h2 class="text-2xl font-serif font-medium text-[#4871AD]">Monitoring Harga</h2>
            </div>
        </div>

        <div class="h-8"></div>

        {{-- tabs and filter section --}}
        <div class="fixed left-4 right-4 bg-white z-20 top-15 max-w-md mx-auto px-2">
            <!-- Define tab variable first -->
            @php $tab = request('tab', 'default'); @endphp
            
            {{-- Filter Form --}}
            <div class="mb-4 px-2">
                <form method="GET" action="{{ route('admin.dashboard.products-monitoring') }}"
                    class="flex flex-col gap-3">
                    <input type="hidden" name="tab" value="{{ $tab }}">

                    {{-- Search Input --}}
                    <div class="flex-1 relative w-full">
                        <i class="fas fa-search absolute top-2.5 left-3 text-[#4871AD]/60"></i>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
                            class="w-full pl-10 pr-3 py-2 border border-[#4871AD]/30 rounded-md text-sm focus:outline-none focus:ring-1 focus:ring-[#4871AD] font-serif" />
                    </div>

                    <div class="flex gap-2">
                        {{-- Category Select with Font Awesome icon --}}
                        <div class="relative w-full">
                            <select name="category" class="text-sm border border-[#4871AD]/30 rounded-md py-2 pl-3 pr-8 w-full font-serif focus:ring-1 focus:ring-[#4871AD] focus:outline-none appearance-none text-gray-500">
                                <option value="" class="text-gray-500">Semua Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->name }}" class="text-gray-500"
                                        {{ request('category') == $category->name ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                <i class="fas fa-chevron-down text-[#4871AD] text-xs"></i>
                            </div>
                        </div>

                        <button type="submit"
                            class="bg-[#4871AD] text-white rounded-md px-4 py-2 text-sm hover:bg-[#3a5a8a] transition duration-200 font-serif">
                            Filter
                        </button>
                    </div>
                </form>
            </div>
            
            {{-- Tabs --}}
            <div class="mb-4 text-sm font-serif px-2">
                <div class="relative">
                    <div class="absolute bottom-0 left-0 right-0 border-b border-[#4871AD]/20"></div>
                    <div class="flex w-full overflow-x-auto">
                        <a href="?tab=default"
                            class="flex-1 text-center pb-2 whitespace-nowrap {{ $tab === 'default' ? 'border-b-2 border-[#4871AD] font-medium text-[#4871AD]' : 'text-gray-500' }} relative z-10">
                            Produk
                        </a>
                        <a href="?tab=dihapus"
                            class="flex-1 text-center pb-2 whitespace-nowrap {{ $tab === 'dihapus' ? 'border-b-2 border-[#4871AD] font-medium text-[#4871AD]' : 'text-gray-500' }} relative z-10">
                            Produk Dihapus
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-40"></div>

        <div class="px-2">
            @include('components.modals.status')
            @include('components.modals.errors')
        </div>

        {{-- Produk Cards --}}
        <div class="px-2 space-y-4">
            @forelse ($products as $product)
                <div class="rounded-lg p-4 shadow-sm border-2 border-[#4871AD]/30">
                    <div class="flex flex-col">
                        {{-- Product Image --}}
                        <img src="{{ Storage::url($product->image_cover) }}" alt="{{ $product->name }}"
                            class="w-full h-40 object-cover rounded-md mb-3 border border-[#4871AD]/20">

                        {{-- Product Info --}}
                        <div>
                            <h3 class="font-serif font-medium text-lg text-[#4871AD] mb-1">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-600 mb-1 font-serif">
                                Penjual: {{ $product->seller->shop_name ?? '-' }}
                            </p>

                            @if ($tab === 'dihapus')
                                <p class="text-sm text-red-600 font-serif font-medium mt-1">Alasan:
                                    {{ $product->deletion_reason ?? 'Tidak diketahui' }}</p>
                            @else
                                <p class="text-sm text-[#4871AD] font-serif font-medium mt-1">
                                    Harga: Rp{{ number_format($product->price, 0, ',', '.') }}
                                </p>
                            @endif

                            {{-- Product Warning --}}
                            <div class="mt-2 flex flex-wrap gap-1">
                                @foreach ($product->warnings as $index => $warning)
                                    <span
                                        class="text-xs px-2 py-1 rounded-md text-white font-serif
                                        {{ $warning->status === 'RESOLVED' ? 'bg-green-500' : 'bg-red-500' }}">
                                        WARN {{ $index + 1 }} | {{ $warning->description }} | {{ $warning->status }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        @if ($tab !== 'dihapus')
                            <div class="mt-4 flex justify-between items-center">
                                <a href="{{ route('admin.dashboard.products-monitoring.create', compact('product')) }}"
                                    class="text-yellow-500 hover:text-yellow-600 text-sm font-serif flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>Lihat
                                </a>

                                <form action="{{ route('admin.dashboard.products-monitoring.delete-product', compact('product')) }}"
                                    method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-serif flex items-center"
                                        onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                        <i class="fas fa-trash-alt mr-1"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-8 ">
                    <div class="w-16 h-16 mx-auto text-[#4871AD]/60 mb-2 flex items-center justify-center">
                        <i class="fas fa-shopping-cart text-5xl"></i>
                    </div>
                    <p class="text-base font-serif text-[#4871AD]">Tidak ada produk ditemukan.</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="flex flex-col items-center mt-6 space-y-2 px-2">
            <p class="text-sm text-[#4871AD]/70 font-serif">
                Page {{ $products->currentPage() }} of {{ $products->lastPage() }}
            </p>
            <div class="font-serif text-[#4871AD]">
                {{ $products->appends(request()->except('page'))->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</x-app-layout>