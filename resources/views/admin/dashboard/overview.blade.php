<x-app-layout>
    <div class="max-w-md mx-auto bg-white pb-16">
        {{-- Header with back button --}}
        <div class="fixed top-0 left-4 right-4 z-10 bg-white">
            <div class="max-w-md mx-auto flex items-center p-2.5">
                <a href="{{ route('admin.dashboard') }}" class="mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#4871AD" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <h2 class="text-2xl font-serif font-medium text-[#4871AD]">Overview</h2>
            </div>
        </div>

        <div class="h-8"></div>

        {{-- Statistics List --}}
        <div class="divide-y divide-[#4871AD]/35 border-t border-b border-[#4871AD]/35">
            {{-- Total Penjual --}}
            <div class="flex items-center px-3 py-2.5">
                <div class="w-10 h-10 mr-3 text-[#4871AD] flex items-center justify-center">
                    <i class="fa-solid fa-user-group text-3xl"></i>
                </div>
                <div>
                    <h3 class="text-base font-serif text-[#4871AD]">Total Penjual</h3>
                    <p class="text-lg font-serif font-medium text-[#4871AD]">{{ $sellerTotal }}</p>
                </div>
            </div>

            {{-- Penjual Terverifikasi --}}
            <div class="flex items-center px-3 py-2.5">
                <div class="w-10 h-10 mr-3 text-[#4871AD] flex items-center justify-center">
                    <i class="fa-solid fa-user-check text-3xl ml-2"></i>
                </div>
                <div>
                    <h3 class="text-base font-serif text-[#4871AD]">Penjual Terverifikasi</h3>
                    <p class="text-lg font-serif font-medium text-[#4871AD]">{{ $sellerVerifiedTotal }}</p>
                </div>
            </div>

            {{-- Menunggu Verifikasi --}}
            <div class="flex items-center px-3 py-2.5">
                <div class="w-10 h-10 mr-3 text-[#4871AD] flex items-center justify-center">
                    <i class="fa-solid fa-triangle-exclamation text-3xl"></i>
                </div>
                <div>
                    <h3 class="text-base font-serif text-[#4871AD]">Menunggu Verifikasi</h3>
                    <p class="text-lg font-serif font-medium text-[#4871AD]">{{ $sellerUnverifiedTotal }}</p>
                </div>
            </div>

            {{-- Total Produk --}}
            <div class="flex items-center px-3 py-2.5">
                <div class="w-10 h-10 mr-3 text-[#4871AD] flex items-center justify-center">
                    <i class="fa-solid fa-cart-shopping text-3xl"></i>
                </div>
                <div>
                    <h3 class="text-base font-serif text-[#4871AD]">Total Produk</h3>
                    <p class="text-lg font-serif font-medium text-[#4871AD]">{{ $productTotal }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>