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

            <!-- Product Card List-->
            @livewire('seller.product-list')

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
