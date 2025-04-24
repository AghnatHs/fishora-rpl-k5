<x-app-layout>
    <div class="max-w-md mx-auto min-h-screen bg-white flex flex-col">

        <!-- Back button -->
        <div class="p-4">
            <a href="{{ url()->previous() }}">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
        </div>

        <!-- Product Image -->
        <div x-data="{
            active: 0,
            images: {{ $productImages->toJson() }}
        }" class="relative w-full aspect-square overflow-hidden rounded-lg">

            <!-- Gambar -->
            <template x-for="(image, index) in images" :key="index">
                <div x-show="active === index" class="absolute inset-0 transition-opacity duration-300">
                    <img :src="image.url" class="w-full h-full object-cover" />
                </div>
            </template>

            <!-- Tombol Prev -->
            <button @click="active = (active - 1 + images.length) % images.length"
                class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/70 p-2 rounded-full shadow">
                &larr;
            </button>

            <!-- Tombol Next -->
            <button @click="active = (active + 1) % images.length"
                class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/70 p-2 rounded-full shadow">
                &rarr;
            </button>

            <!-- Dots -->
            <div class="absolute bottom-2 w-full flex justify-center gap-2">
                <template x-for="(image, index) in images" :key="'dot-' + index">
                    <button @click="active = index"
                        :class="{
                            'bg-white w-3 h-3 rounded-full': true,
                            'opacity-100': active === index,
                            'opacity-40': active !== index
                        }"
                        class="transition-opacity"></button>
                </template>
            </div>
        </div>

        <!-- Detail Section -->
        <div class="p-4 bg-white flex-1 flex flex-col justify-between">
            <div>
                <h2 class="text-xl font-bold mb-1">Rp{{ number_format($product->price, 0, ',', '.') }}</h2>
                <p class="text-sm text-gray-700 font-semibold">{{ $product->name }} | <span class="text-gray-500">Stok:
                        {{ $product->stock }}</span></p>

                <p class="text-sm text-gray-600 mt-2">
                    {{ $product->description ?? 'Deskripsi produk belum tersedia.' }}
                </p>

                <!-- Categories -->
                <div class="flex flex-wrap gap-2 mt-3">
                    @foreach ($product->categories as $category)
                        <span class="text-xs bg-gray-100 text-gray-600 px-3 py-1 rounded-full">
                            {{ $category->name }}
                        </span>
                    @endforeach
                </div>

                <!-- Seller -->
                <div class="mt-3">
                    <span class="inline-block bg-red-100 text-red-600 text-xs px-3 py-1 rounded-full font-semibold">
                        {{ $product->seller->shop_name }}
                    </span>
                </div>
            </div>

            <!-- Bottom Navigation -->
            <div class="mt-6 border-t pt-4 flex justify-around items-center bg-gray-100 text-center text-sm">
                <a href="#" class="flex flex-col items-center text-gray-700">
                    <i class="fas fa-comment-dots text-xl"></i>
                    Chat
                </a>
                <a href="#" class="flex flex-col items-center text-gray-700">
                    <i class="fas fa-cart-plus text-xl"></i>
                    Keranjang
                </a>
                {{-- <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-black text-white px-6 py-2 rounded-full font-semibold text-sm hover:bg-gray-800 transition">
                        Beli sekarang
                    </button>
                </form> --}}
            </div>
        </div>

    </div>
</x-app-layout>
