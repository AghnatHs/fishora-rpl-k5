<x-app-layout>
    <div class="flex-1 max-w-4xl mx-auto p-2 sm:max-w-3xl w-full ">

        <!-- Back button -->
        <div class="p-4">
            <a href="{{ url()->previous() }}">
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

        <!-- Product Card -->
        <p class="block text-sm font-medium text-gray-700 mb-1">Info Produk</p>
        <div class="rounded-lg shadow-sm p-4 bg-white flex flex-col">
            <!-- Product Image -->
            <div x-data="{
                active: 0,
                images: {{ $productImages->toJson() }}
            }" class="relative w-full h-[400px] aspect-square overflow-hidden rounded-lg">

                <!-- Gambar -->
                <template x-for="(image, index) in images" :key="index">
                    <div x-show="active === index" class="absolute inset-0 transition-opacity duration-300">
                        <img :src="image.url" class="w-full h-100 object-contain" />
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
                                'bg-black w-3 h-3 rounded-full': true,
                                'opacity-100': active === index,
                                'opacity-40': active !== index
                            }"
                            class="transition-opacity"></button>
                    </template>
                </div>
            </div>

            <!-- Product Info -->
            <div class="flex-1 mb-4">
                <h3 class="font-semibold text-lg text-gray-800 mb-1">{{ $product->name }}</h3>
                <p class="text-sm text-gray-600 mb-1">
                    Penjual: {{ $product->seller->shop_name ?? '-' }}
                </p>

                <p class="text-sm text-gray-800 font-medium">
                    Harga: Rp{{ number_format($product->price, 0, ',', '.') }}
                </p>

                <!-- Categories -->
                <div class="mt-2 flex flex-wrap gap-1">
                    @foreach ($product->categories as $category)
                        <span class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded-md">
                            {{ $category->name }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Product Warning Form -->
        <form action="{{ route('admin.dashboard.products-monitoring.create', compact('product')) }}" method="POST"
            class="space-y-2">
            @csrf

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi
                    Peringatan</label>
                <textarea id="description" name="description" rows="3" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring focus:border-black"
                    placeholder="Masukkan deskripsi / alasan peringatan..."></textarea>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="w-full bg-yellow-400 text-black py-2 rounded-md hover:bg-yellow-500">
                    Peringatkan
                </button>
            </div>
        </form>

    </div>
</x-app-layout>
