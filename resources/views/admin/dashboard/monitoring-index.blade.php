<x-app-layout>
    <div class="max-w-4xl mx-auto p-4 sm:max-w-5xl">

        <!-- Back button -->
        <div class="p-4">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
        </div>

        <!-- Greeting -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">
            Welcome, {{ Auth::guard('admin')->user()->name }}!
        </h2>
        <p class="text-sm text-gray-600 mb-4">
            Email: {{ Auth::guard('admin')->user()->email }}
        </p>

        <!-- Logout -->
        <form action="{{ route('admin.logout') }}" method="POST" class="mb-6">
            @csrf
            <button type="submit"
                class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition duration-200">
                Logout
            </button>
        </form>

        @include('components.modals.status')
        @include('components.modals.errors')

        <!-- Tabs -->
        <div class="flex space-x-4 mb-4 text-sm font-medium border-b border-gray-200 overflow-x-auto no-scrollbar">
            @php $tab = request('tab', 'default'); @endphp
            <a href="?tab=default"
                class="pb-2 whitespace-nowrap {{ $tab === 'default' ? 'border-b-2 border-black font-semibold' : 'text-gray-500' }}">
                Produk
            </a>
            <a href="?tab=dihapus"
                class="pb-2 whitespace-nowrap {{ $tab === 'dihapus' ? 'border-b-2 border-black font-semibold' : 'text-gray-500' }}">
                Produk Dihapus
            </a>
        </div>

        <!-- Filter Form -->
        <div class="mb-4">
            <form method="GET" action="{{ route('admin.dashboard.products-monitoring') }}"
                class="flex flex-col gap-3 sm:flex-row sm:items-center">
                <input type="hidden" name="tab" value="{{ $tab }}">

                <!-- Search Input -->
                <div class="flex-1 relative w-full">
                    <i class="fas fa-search absolute top-2.5 left-3 text-gray-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-black" />
                </div>

                <!-- Category Select -->
                <select name="category" class="text-sm border border-gray-300 rounded-xl py-2 px-3 w-full sm:w-auto">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->name }}"
                            {{ request('category') == $category->name ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit"
                    class="bg-black text-white rounded-xl px-4 py-2 text-sm hover:bg-gray-800 w-full sm:w-auto">
                    Filter
                </button>
            </form>
        </div>

        <!-- Produk Cards -->
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($products as $product)
                <div class="border rounded-lg shadow-sm p-4 bg-white flex flex-col">
                    <!-- Product Image -->
                    <img src="{{ Storage::url($product->image_cover) }}" alt="{{ $product->name }}"
                        class="w-full h-40 object-cover rounded-md mb-4">

                    <!-- Product Info -->
                    <div class="flex-1">
                        <h3 class="font-semibold text-lg text-gray-800 mb-1">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-600 mb-1">
                            Penjual: {{ $product->seller->shop_name ?? '-' }}
                        </p>

                        @if ($tab === 'dihapus')
                            <p class="text-sm text-red-600 font-medium mt-1">Alasan:
                                {{ $product->deletion_reason ?? 'Tidak diketahui' }}</p>
                        @else
                            <p class="text-sm text-gray-800 font-medium mt-1">
                                Harga: Rp{{ number_format($product->price, 0, ',', '.') }}
                            </p>
                        @endif

                        <!-- Product Warning -->
                        <div class="mt-2 flex flex-wrap gap-1">
                            @foreach ($product->warnings as $index => $warning)
                                <span
                                    class="text-xs px-2 py-1 rounded-md text-white
            {{ $warning->status === 'RESOLVED' ? 'bg-green-500' : 'bg-red-500' }}">
                                    WARN {{ $index + 1 }} | {{ $warning->description }} | {{ $warning->status }}
                                </span>
                            @endforeach
                        </div>

                    </div>

                    <!-- Action Buttons -->
                    @if ($tab !== 'dihapus')
                        <div class="mt-4 flex justify-between items-center">
                            <a href="{{ route('admin.dashboard.products-monitoring.create', compact('product')) }}"
                                title="Peringatkan" class="text-yellow-700 hover:text-yellow-800 text-sm">
                                <i class="fas fa-exclamation-triangle mr-1"></i>Peringatkan
                            </a>

                            <form action="#" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm"
                                    onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                    <i class="fas fa-trash-alt mr-1"></i>Hapus
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500 py-8">
                    Tidak ada produk ditemukan.
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="flex flex-col items-center mt-6 space-y-2">
            <p class="text-sm text-gray-500">
                Page {{ $products->currentPage() }} of {{ $products->lastPage() }}
            </p>
            {{ $products->appends(request()->except('page'))->links('pagination::tailwind') }}
        </div>

    </div>
</x-app-layout>
