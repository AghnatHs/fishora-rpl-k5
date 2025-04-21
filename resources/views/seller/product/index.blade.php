<x-app-layout>
    <div class="flex flex-col min-h-screen">

        <!-- Content Wrapper -->
        <div class="flex-1 max-w-md mx-auto p-2 sm:max-w-3xl w-full">

            <!-- Header -->
            <div class="flex items-center justify-between mb-4">
                <!-- Back Button -->
                <a href="{{ route('seller.dashboard') }}"
                    class="text-sm text-gray-600 hover:text-black flex items-center space-x-1">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>

                <!-- Title -->
                <h1 class="text-xl font-semibold">Produk Saya</h1>
            </div>

            <!-- Tabs -->
            <div class="flex justify-around text-sm font-medium border-b pb-2 mb-4">
                <a href="#" class="text-center flex-1">Live ({{ $liveCount ?? 0 }})</a>
                <a href="#" class="text-center flex-1">Habis ({{ $outOfStockCount ?? 0 }})</a>
                <a href="#" class="text-center flex-1">Dihapus oleh sistem ({{ $deletedCount ?? 0 }})</a>
            </div>

            @include('components.modals.status')

            @include('components.modals.errors')

            <!-- Product Card -->
            @forelse ($products as $product)
                <div class="bg-gray-100 rounded-lg p-4 shadow-sm mb-4">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-16 h-16 bg-white rounded overflow-hidden flex items-center justify-center">
                            <img class="object-cover w-full h-full" src="{{ Storage::url($product->image_cover) }}"
                                alt="Product Image">
                        </div>
                        <div>
                            <p class="font-semibold">{{ $product->name }}</p>
                            <p class="text-sm text-gray-800">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-600">Stok : {{ $product->stock }}</p>

                            <!-- Kategori Produk -->
                            <div class="mt-1 flex flex-wrap gap-1">
                                @foreach ($product->categories as $category)
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded">
                                        {{ $category->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    <div class="flex space-x-1 text-sm">
                        <a href="{{ route('seller.products.edit', compact('product')) }}"
                            class="bg-green-500 px-3 py-1 rounded hover:bg-green-600 text-white">Edit</a>
                        <form method="POST" action="{{ route('seller.products.destroy', compact('product')) }}">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 px-3 py-1 rounded hover:bg-red-600 text-white">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 py-10">
                    <i class="fas fa-box-open text-4xl mb-2"></i>
                    <p class="text-lg font-medium">Belum ada produk</p>
                    <p class="text-sm">Yuk tambahkan produk pertamamu sekarang!</p>
                </div>
            @endforelse

        </div>

        <!-- Fixed Bottom Button -->
        <div class="fixed bottom-0 left-0 w-full bg-white border-t p-4">
            <div class="max-w-md mx-auto sm:max-w-3xl">
                <a href="{{ route('seller.products.create') }}"
                    class="block w-full bg-black text-white text-center py-2 rounded-lg hover:bg-gray-800 text-sm">
                    Tambah Produk Baru
                </a>
            </div>
        </div>

    </div>
</x-app-layout>
