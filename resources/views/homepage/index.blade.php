<x-app-layout>
    <div class="max-w-md mx-auto p-1 sm:max-w-3xl">

        <!-- Search Bar -->
        <!-- Search Bar -->
        <form method="GET" action="{{ route('homepage.index') }}" class="mb-4 space-y-2">
            <div class="flex items-center gap-2">
                <div class="flex-1 relative">
                    <i class="fas fa-search absolute top-2.5 left-3 text-gray-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search"
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-black" />
                </div>

                <select name="category" class="text-sm border border-gray-300 rounded-xl py-2 px-3">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->name }}"
                            {{ request('category') == $category->name ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Search button below -->
            <div class="flex items-center justify-between">
                <button type="submit"
                    class="text-sm bg-black text-white py-2 px-4 rounded-xl shadow hover:bg-gray-800 transition">
                    Search
                </button>

                <div class="flex items-center gap-3">
                    <a><i class="fas fa-comment-dots text-xl"></i></a>
                    <a
                        href="@auth('admin')
                            {{ route('admin.dashboard') }}
                        @elseif(auth('seller')->check())
                            {{ route('seller.dashboard') }}
                        @elseif(auth('customer')->check())
                            {{ route('customer.dashboard') }}
                        @else
                            {{ route('customer.login') }}
                        @endauth">
                        <i class="fas fa-house text-xl"></i>
                    </a>
                </div>
            </div>
        </form>



        <!-- Section Title -->
        {{-- <h2 class="font-semibold text-base mb-2">Direkomendasikan untukmu</h2> --}}

        <!-- Filter helper text -->
        @if (request('search'))
            <p class="text-sm text-gray-600 mb-2">Hasil pencarian untuk: <strong>{{ request('search') }}</strong></p>
        @endif
        @if (request('category'))
            <p class="text-sm text-gray-600 mb-2">Hasil pencarian untuk kategori:
                <strong>{{ request('category') }}</strong>
            </p>
        @endif
        @if (request('search') || request('category'))
            <a href="{{ route('homepage.index') }}" class="text-sm text-blue-500 mb-4">Reset Filter</a>
        @endif

        <!-- Product Grid -->
        <div class="grid grid-cols-2 gap-4">
            @forelse ($products as $product)
                <a href="{{ route('homepage.show-product', compact('product')) }}">
                    <div>
                        <div class="aspect-square bg-gray-200 overflow-hidden rounded">
                            <img src="{{ Storage::url($product->image_cover) }}" alt="Product Image"
                                class="w-full h-full object-contain" />
                        </div>
                        <p class="text-sm font-medium mt-1">{{ $product->name }}</p>
                        <p class="text-sm text-gray-700">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="text-xs text-gray-400">Stok : {{ $product->stock }}</p>
                        <p class="text-xs text-gray-400">By : {{ $product->seller->shop_name }}</p>
                    </div>
                </a>
            @empty
                <p class="text-gray-500">Tidak ada produk ditemukan.</p>
            @endforelse
        </div>

        <!-- Pagination Info and Links -->
        <div class="flex flex-col items-center mt-8 space-y-2">
            <p class="text-sm text-gray-500">
                Page {{ $products->currentPage() }} of {{ $products->lastPage() }}
            </p>
            {{ $products->links('pagination::tailwind') }}
        </div>
    </div>
</x-app-layout>
