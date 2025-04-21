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

                <!-- Product Images -->
                <div x-data="{ images: [null] }" class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Foto Produk</label>

                    <template x-for="(image, index) in images" :key="index">
                        <div class="flex items-center space-x-2">
                            <input type="file" :name="'images[]'"
                                class="block w-full text-sm text-gray-500 border border-gray-300 rounded" />
                            <button type="button" @click="images.splice(index, 1)"
                                class="text-red-600 hover:text-red-800 text-sm font-bold">x</button>
                        </div>
                    </template>

                    <button type="button" @click="images.push(null)"
                        class="flex items-center text-sm text-blue-600 hover:underline mt-2">
                        <span class="text-lg mr-1">+</span> Tambah Foto
                    </button>
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

                <!-- Product Categories -->
                <label class="block mb-2 text-sm font-medium text-gray-700">Kategori</label>
                <div class="grid grid-cols-2 gap-2">
                    @foreach ($categories as $category)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}
                                class="rounded text-blue-600 focus:ring-2 focus:ring-blue-400">
                            <span class="text-sm text-gray-800">{{ $category->name }}</span>
                        </label>
                    @endforeach
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
