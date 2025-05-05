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

        <!-- Tabs -->
        <div class="flex space-x-4 mb-4 text-sm font-medium border-b border-gray-200">
            @php $tab = request('tab', 'default'); @endphp
            <a href="?tab=default"
                class="pb-2 {{ $tab === 'default' ? 'border-b-2 border-black font-semibold' : 'text-gray-500' }}">Produk</a>
            <a href="?tab=dihapus"
                class="pb-2 {{ $tab === 'dihapus' ? 'border-b-2 border-black font-semibold' : 'text-gray-500' }}">Produk
                Dihapus</a>
        </div>


        <!-- Filter Form -->
        <div class="mb-4">
            <form method="GET" action="{{ route('admin.dashboard.products-monitoring') }}"
                class="flex flex-col sm:flex-row gap-2 items-start sm:items-center">
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

        <!-- Produk Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-700 border border-gray-200 rounded-lg">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-2">Cover</th>
                        <th class="px-4 py-2">Nama Produk</th>
                        <th class="px-4 py-2">Penjual</th>
                        @if ($tab === 'dihapus')
                            <th class="px-4 py-2">Alasan</th>
                        @else
                            <th class="px-4 py-2">Harga dari Penjual</th>
                            <th class="px-4 py-2">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="border-t">
                            <td class="px-4 py-2">
                                <img src="{{ Storage::url($product->image_cover) }}" alt="Cover"
                                    class="w-16 h-16 object-cover rounded">
                            </td>
                            <td class="px-4 py-2 font-medium">
                                {{ $product->name }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $product->seller->shop_name ?? '-' }}
                            </td>

                            @if ($tab === 'dihapus')
                                <td class="px-4 py-2">{{ $product->deletion_reason ?? 'Tidak diketahui' }}</td>
                            @else
                                <td class="px-4 py-2">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="px-4 py-2 space-x-2 text-sm">
                                    <a href="#" title="Edit"
                                        class="text-yellow-600 hover:text-yellow-800"><i class="fas fa-edit"></i></a>

                                    <form action="#" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus" class="text-red-600 hover:text-red-800"
                                            onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                Tidak ada produk ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
