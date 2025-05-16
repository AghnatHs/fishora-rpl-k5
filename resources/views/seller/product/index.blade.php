<x-app-layout>
    <div class="max-w-md mx-auto bg-white pb-16">
        {{-- Header with back button --}}
        <div class="fixed top-0 left-0 right-0 z-30 bg-white pb-2 ">
            <div class="max-w-md mx-auto flex items-center p-2 px-4">
                <a href="{{ route('seller.dashboard') }}" class="mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="#4871AD" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <h2 class="text-2xl font-serif font-medium text-[#4871AD]">Produk Saya</h2>
            </div>
        </div>

        {{-- Tabs section --}}
        <div class="fixed left-0 right-0 bg-white z-21 top-12">
            <div class="max-w-md mx-auto">
                <div class="flex text-center">
                    <a href="?tab=live" class="flex-1 py-1 {{ $tab === 'live' ? 'text-[#4871AD]' : 'text-gray-500' }} relative">
                        <div class="font-serif text-sm">Live</div>
                        <div class="font-serif text-xs">({{ $liveCount ?? 0 }})</div>
                        @if($tab === 'live')
                            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-20 h-0.5 bg-[#4871AD]"></div>
                        @endif
                    </a>
                    <a href="?tab=outofstock" class="flex-1 py-1 {{ $tab === 'outofstock' ? 'text-[#4871AD]' : 'text-gray-500' }} relative">
                        <div class="font-serif text-sm">Habis</div>
                        <div class="font-serif text-xs">({{ $outOfStockCount ?? 0 }})</div>
                        @if($tab === 'outofstock')
                            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-20 h-0.5 bg-[#4871AD]"></div>
                        @endif
                    </a>
                    <a href="?tab=deleted" class="flex-1 py-1 {{ $tab === 'deleted' ? 'text-[#4871AD]' : 'text-gray-500' }} relative">
                        <div class="font-serif text-sm">Dihapus</div>
                        <div class="font-serif text-xs">({{ $deletedCount ?? 0 }})</div>
                        @if($tab === 'deleted')
                            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-20 h-0.5 bg-[#4871AD]"></div>
                        @endif
                    </a>
                </div>
                <div class="border-b border-gray-200 w-full"></div>
            </div>
        </div>

        {{-- Main content --}}
        <div class="pt-17"> {{-- Increased padding to account for header + tabs + possible alerts --}}
            <div class="px-0 mb-2">
                <div class="h-2"></div>
                @include('components.modals.status')
                @include('components.modals.errors')
            </div>

            {{-- Product List --}}
            <div class="px-0">
                @livewire('seller.product-list')
            </div>
        </div>

        {{-- Fixed Bottom Button  --}}
        <div class="fixed bottom-0 left-0 right-0 bg-[#4871AD] py-3 px-4 z-30">
            <div class="max-w-md mx-auto flex justify-center">
                <a href="{{ route('seller.products.create') }}"
                    class="w-5/6 bg-white text-[#4871AD] font-serif text-center py-0.5 rounded-md text-base">
                    Tambah Produk Baru
                </a>
            </div>
        </div>
    </div>
</x-app-layout>