<div>
    <!-- Search Input -->
    <input type="text" wire:model.live="search"
        class="w-full border border-gray-300 rounded-md p-2 text-sm mb-4" placeholder="Cari nama produk...">

    <!-- Produk List -->
    @forelse ($products as $product)
        <div class="bg-gray-100 items-start rounded-lg p-4 shadow-sm mb-4">
            <div class="flex items-center space-x-4 mb-2">
                <div class="bg-white rounded overflow-hidden flex items-center justify-center flex-shrink-0">
                    <img class="w-16 h-16 object-cover rounded" src="{{ Storage::url($product->image_cover) }}"
                        alt="Product Image">
                </div>
                <div class="flex-1">
                    <p class="font-semibold">{{ $product->name }}</p>
                    <p class="text-sm text-gray-800">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-600">Stok : {{ $product->stock }}</p>
                    <p class="text-xs text-gray-600">Created At :
                        {{ $product->created_at }}</p>
                    <p class="text-xs text-gray-600">Last Updated by You :
                        {{ $product->updated_at->diffForHumans() }}</p>

                    <!-- Kategori Produk -->
                    <div class="mt-1 flex flex-wrap gap-1">
                        @foreach ($product->categories as $category)
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded">
                                {{ $category->name }}
                            </span>
                        @endforeach
                    </div>

                    <p class="mt-2 font-semibold">Foto Produk</p>
                    <div class="flex flex-wrap gap-1">
                        @forelse ($product->images as $image)
                            <img src="{{ Storage::url($image->filepath) }}" alt="Product Image"
                                class="w-24 h-24 object-contain">
                        @empty
                            <p class="text-sm text-red-500">Foto - foto produk belum diunggah.</p>
                        @endforelse
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
        <p class="text-gray-500">Tidak ada produk ditemukan.</p>
    @endforelse
</div>
