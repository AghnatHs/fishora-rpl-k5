<x-app-layout>
    <div class="max-w-md mx-auto bg-white min-h-screen">
        <!-- Header dengan judul dan ikon -->
        <div class="p-4 flex justify-between items-center border-b">
            <h1 class="text-xl font-medium text-[#4871AD]">Beranda</h1>
            <div class="flex gap-4">
                <a href="#" class="text-[#4871AD]">
                    <i class="fas fa-bell"></i>
                </a>
                <a href="#" class="text-[#4871AD]">
                    <i class="fas fa-comment-alt"></i>
                </a>
            </div>
        </div>

        <!-- Form pencarian -->
        <div class="p-4">
            <form method="GET" action="{{ route('homepage.index') }}" class="mb-4">
                <div class="relative mb-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Mau cari ikan apa?" 
                        class="w-full border border-gray-300 pl-10 pr-4 py-2 rounded-md focus:outline-none focus:ring-1 focus:ring-[#4871AD]">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                
                <button type="submit"
                    class="w-full bg-[#4871AD] text-white py-2 px-4 rounded-md text-center font-medium">
                    Cari
                </button>
            </form>
        </div>

        <!-- Kategori populer -->
        <div class="px-4 mb-4">
            <h3 class="text-[#4871AD] font-medium mb-3">Kategori Populer</h3>
            <div class="flex overflow-x-auto gap-2 pb-2">
                <a href="{{ route('homepage.index') }}" class="flex-shrink-0 px-4 py-2 bg-[#4871AD] text-white rounded-full">Semua</a>
                <a href="{{ route('homepage.index', ['category' => 'air-tawar']) }}" class="flex-shrink-0 px-4 py-2 bg-gray-100 text-gray-800 rounded-full">Ikan Air Tawar</a>
                <a href="{{ route('homepage.index', ['category' => 'air-laut']) }}" class="flex-shrink-0 px-4 py-2 bg-gray-100 text-gray-800 rounded-full">Ikan Air Laut</a>
                <a href="{{ route('homepage.index', ['category' => 'ikan-hias']) }}" class="flex-shrink-0 px-4 py-2 bg-gray-100 text-gray-800 rounded-full">Ikan Hias</a>
            </div>
        </div>

        <!-- Produk -->
        <div class="px-4 pb-16">
            <h3 class="text-[#4871AD] font-medium mb-3">Produk Terbaru</h3>
            
            @if(isset($products) && $products->count() > 0)
                <div class="grid grid-cols-2 gap-3">
                    @foreach($products as $product)
                        <div class="bg-white border rounded-lg overflow-hidden shadow-sm">
                            <div class="bg-gray-200 aspect-square relative">
                                @if($product->image)
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" 
                                         class="absolute inset-0 w-full h-full object-cover">
                                @else
                                    <div class="absolute inset-0 flex items-center justify-center text-gray-400">
                                        <i class="fas fa-image text-3xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="p-2">
                                <div class="text-[#4871AD] font-medium text-sm">{{ $product->name }}</div>
                                <div class="font-bold">Rp{{ number_format($product->price, 0, ',', '.') }}</div>
                                <div class="text-xs text-gray-500 mt-1">{{ $product->seller->location ?? 'Lokasi tidak tersedia' }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="mt-6">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center py-10 border rounded-lg">
                    <div class="text-gray-400 mb-3">
                        <i class="fas fa-fish text-5xl"></i>
                    </div>
                    <p class="text-gray-500">Belum ada produk yang tersedia</p>
                    <p class="text-gray-400 text-sm mt-1">Coba cari dengan kata kunci lain</p>
                </div>
            @endif
        </div>
    </div>

    {{-- Menggunakan component bottom navigation --}}
    <x-bottom-nav active="home" />
</x-app-layout>