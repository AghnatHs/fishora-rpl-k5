<x-app-layout>
    <div class="max-w-md mx-auto p-4 sm:max-w-3xl">

        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-semibold">Toko Saya</h1>
            <div class="flex gap-3 text-xl">
                <button><i class="fas fa-comment-dots"></i></button>
            </div>
        </div>

        <!-- Profile -->
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-16 h-16 bg-gray-300 rounded-full"></div>
            <div class="space-y-1">
                <p class="font-semibold">{{ Auth::guard('seller')->user()->shop_name }}</p>
                <p class="text-sm text-gray-600">{{ Auth::guard('seller')->user()->email }}</p>
                <form action="{{ route('seller.logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-1/2 bg-red-600 hover:bg-red-700 text-white font-semibold py-1 px-1 rounded-lg shadow transition duration-200 text-sm">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Status Pesanan -->
        <div class="bg-gray-100 p-4 rounded-lg mb-4">
            <h2 class="text-sm font-semibold mb-2">Status Pesanan</h2>
            <div class="grid grid-cols-3 text-center">
                <div>
                    <p class="text-lg font-bold">0</p>
                    <p class="text-sm">Perlu dikirim</p>
                </div>
                <div>
                    <p class="text-lg font-bold">0</p>
                    <p class="text-sm">Pembatalan</p>
                </div>
                <div>
                    <p class="text-lg font-bold">0</p>
                    <p class="text-sm">Selesai</p>
                </div>
            </div>
        </div>

        <!-- Menu -->
        <div class="bg-gray-100 p-4 rounded-lg mb-4">
            <div class="grid grid-cols-3 text-center gap-2 text-sm">
                <a href="{{ route('seller.products.index') }}"
                    class="flex flex-col items-center hover:text-blue-600 transition">
                    <i class="fas fa-box text-xl mb-1"></i>
                    <p>Produk</p>
                </a>
                <a href="" class="flex flex-col items-center hover:text-blue-600 transition">
                    <i class="fas fa-wallet text-xl mb-1"></i>
                    <p>Keuangan</p>
                </a>
                <a href="" class="flex flex-col items-center hover:text-blue-600 transition">
                    <i class="fas fa-question-circle text-xl mb-1"></i>
                    <p>Bantuan</p>
                </a>
            </div>
        </div>


        <!-- Produk Toko -->
        <div>
            <h2 class="font-semibold mb-2">Produk Anda</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                @forelse ($products as $product)
                    <!-- Product card -->
                    <a href="{{ route('seller.products.edit', $product) }}"
                        class="block transition-transform transform hover:scale-105">
                        <div class="bg-white border rounded-lg overflow-hidden">
                            <div class="aspect-square items-center text-center bg-gray-200 flex justify-center">
                                <img src="{{ Storage::url($product->image_cover) }}" alt=""
                                    class="object-cover w-full h-full">
                            </div>
                            <div class="p-2">
                                <p class="text-sm font-semibold">{{ $product->name }}</p>
                                <p class="text-sm text-gray-500">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </a>


                @empty
                    <div class="text-center text-gray-500 py-10">
                        <i class="fas fa-box-open text-4xl mb-2"></i>
                        <p class="text-lg font-medium">Belum ada produk</p>
                        <p class="text-sm">Yuk tambahkan produk pertamamu sekarang!</p>
                    </div>
                @endforelse
            </div>

        </div>

</x-app-layout>
