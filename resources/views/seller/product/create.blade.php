<x-app-layout>
    <div class="flex flex-col min-h-screen">

        <!-- Content Wrapper -->
        <div class="flex-1 max-w-md mx-auto p-2 sm:max-w-3xl w-full ">

            <!-- Header -->
            <div class="flex items-center justify-between mb-4">
                <!-- Back Button -->
                <a href="{{ route('seller.products.index') }}"
                    class="text-sm text-gray-600 hover:text-black flex items-center space-x-1">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>

                <!-- Title -->
                <h1 class="text-xl font-semibold">Tambah Produk</h1>
            </div>

            @include('components.modals.status')

            @include('components.modals.errors')

            <!-- Product Form -->
            <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Product Image -->
                <div class="mb-4">
                    <label for="image_cover" class="block text-sm font-medium text-gray-700">Cover Produk</label>
                    <input type="file" name="image_cover" id="image_cover"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                </div>

                <!-- Product Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                    <input type="text" name="name" id="name"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md" required value={{ old('name') }}>
                </div>

                <!-- Product Description -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" class="mt-1 p-2 w-full border border-gray-300 rounded-md"
                        required>{{ old('description') }}</textarea>
                </div>

                <!-- Product Stock -->
                <div class="mb-4">
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stok</label>
                    <input type="number" name="stock" id="stock"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md" required value={{ old('stock') }}>
                </div>

                <!-- Product Price -->
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                    <input type="number" name="price" id="price"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md" required value={{ old('price') }}>
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">
                        Tambah
                    </button>
                </div>
            </form>

        </div>

    </div>
</x-app-layout>
