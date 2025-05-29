<x-app-layout class="font-serif">
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Search Navbar -->
    <div class="fixed top-0 left-0 right-0 bg-white z-20 py-2 lg:py-3 px-3 lg:px-4 shadow-md font-serif border-b border-[#e6eefd]">
        <div class="max-w-md mx-auto flex items-center justify-center gap-2 lg:gap-6 lg:max-w-7xl"
            x-data="{ 
                filterOpen: false, 
                selectedCategory: '{{ request('category') ?? '' }}',
                hideNavbar: false 
             }"
            <!-- Logo Fishora (Desktop only) -->
            <div class="hidden lg:flex items-center flex-shrink-0">
                <div class="flex items-center gap-2">
                    <div class="w-30 h-13 flex items-center justify-center">
                        <img src="{{ asset('images/fishora_logo_svg.svg') }}" alt="Fishora Logo" class="w-40 h-30 object-contain">
                    </div>
                </div>
            </div>

            <div class="relative flex-shrink-0">
                <button type="button" @click="filterOpen = !filterOpen"
                    class="flex items-center justify-center gap-1 lg:gap-2 bg-[#FFF8F8] border-2 border-[#4871AD] text-[#4871AD] py-2 px-3 lg:px-4 rounded-[12px] hover:bg-[#e6eefd] transition-all min-w-[45px] lg:min-w-[180px]">
                    <svg class="w-5 h-5 lg:w-7 lg:h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="3" y="3" width="7" height="7" rx="2" />
                        <rect x="14" y="3" width="7" height="7" rx="2" />
                        <rect x="14" y="14" width="7" height="7" rx="2" />
                        <rect x="3" y="14" width="7" height="7" rx="2" />
                    </svg>
                    <span class="hidden lg:inline font-serif text-base lg:text-lg" x-text="selectedCategory || 'Kategori'"></span>
                    <svg class="w-4 h-4 lg:w-6 lg:h-6 lg:ml-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M6 9l6 6 6-6" />
                    </svg>
                </button>
                <!-- Dropdown kategori -->
                <div x-show="filterOpen"
                    x-cloak
                    @click.outside="filterOpen = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-95"
                    class="absolute left-0 mt-2 bg-[#FFF8F8] border-2 border-[#4871AD] rounded-[12px] z-[100] shadow-lg overflow-hidden flex flex-col w-80 lg:w-57 max-h-80">
                    <div class="overflow-y-auto flex-1 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-transparent max-h-72">
                        <div class="py-2">
                            <div class="px-4 py-3 text-[#4871AD] hover:bg-gray-50 cursor-pointer flex justify-between items-center"
                                :class="{ 'bg-gray-50': selectedCategory === '' }"
                                @click="selectedCategory = ''; $refs.categoryInput.value = ''; filterOpen = false; $refs.searchForm.submit();">
                                <span class="font-medium text-base">Semua Kategori</span>
                                <template x-if="selectedCategory === ''">
                                    <i class="fas fa-check text-[#4871AD] text-lg"></i>
                                </template>
                            </div>
                            <hr class="border-gray-200">
                            @foreach ($categories as $category)
                            <div class="px-4 py-3 text-[#4871AD] hover:bg-gray-50 cursor-pointer flex justify-between items-center"
                                :class="{ 'bg-gray-50': selectedCategory === '{{ $category->name }}' }"
                                @click="selectedCategory = '{{ $category->name }}'; $refs.categoryInput.value = '{{ $category->name }}'; filterOpen = false; $refs.searchForm.submit();">
                                <span class="text-base">{{ $category->name }}</span>
                                <template x-if="selectedCategory === '{{ $category->name }}'">
                                    <i class="fas fa-check text-[#4871AD] text-lg"></i>
                                </template>
                            </div>
                            @if (!$loop->last)
                            <hr class="border-gray-200">
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Bar -->
            <form id="searchForm" x-ref="searchForm" method="GET" action="{{ route('homepage.index') }}" class="flex-1 max-w-lg">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Temukan ikan impianmu"
                    @focus="hideNavbar = window.innerWidth < 1024 ? true : false"
                    @blur="setTimeout(() => { hideNavbar = false }, 200)"
                    class="w-full px-3 py-2 lg:px-4 lg:py-3 border-2 border-[#4871AD] rounded-[12px] bg-[#FFF8F8] text-[#4871AD] font-serif focus:outline-none focus:ring-2 focus:ring-[#4871AD] transition-all text-sm lg:text-lg" />
                <input type="hidden" name="category" x-ref="categoryInput" :value="selectedCategory">
            </form>

            <!-- Tombol Cari -->
            <button type="submit" form="searchForm" class="flex items-center justify-center bg-[#4871AD] text-white rounded-[12px] px-3 py-2 lg:px-6 lg:py-3 hover:bg-[#365a8c] transition-all">
                <i class="fas fa-search text-base lg:text-xl"></i>
                <span class="ml-1 font-serif text-sm lg:text-lg hidden sm:inline">Cari</span>
            </button>
            <!-- Keranjang -->
            @auth('customer')
            <a href="{{ route('customer.cart') }}" class="relative flex items-center group">
                <i class="fas fa-shopping-cart text-[#4871AD] text-xl lg:text-3xl group-hover:text-[#365a8c] transition-all"></i>
                @if(session('cart_count', 0) > 0)
                <span class="absolute -top-1 -right-1 lg:-top-2 lg:-right-2 bg-red-500 text-white text-xs rounded-full min-w-[16px] h-[16px] lg:min-w-[18px] lg:h-[18px] flex items-center justify-center font-bold animate-pulse shadow-lg text-[10px] lg:text-xs">
                    {{ session('cart_count') }}
                </span>
                @endif
            </a>
            @endauth
            <!-- Chat -->
            <a href="@auth('customer'){{ route('customer.inbox') }}@else{{ route('pick-login') }}@endauth" class="flex items-center group">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 2 22 22" fill="#4871AD" class="w-6 h-6 lg:w-8 lg:h-8 group-hover:fill-[#365a8c] transition-all">
                    <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z" />
                </svg>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="px-0 -mt-6 max-w-md mx-auto p-3 pt-20 pb-20 font-serif lg:max-w-7xl lg:px-12 lg:pt-36 lg:pb-24">
        <!-- Filter display info -->
        @if (request('search') || request('category'))
        <div class="mb-3 lg:max-w-4xl lg:mx-auto">
            <div class="bg-gray-100 rounded-lg px-3 py-2 mb-2 text-[#4871AD] font-serif">
                @if (request('search') && request('category'))
                <p class="font-medium">Hasil pencarian ikan hias "{{ request('search') }}" dan kategori "{{ request('category') }}"</p>
                @elseif (request('search'))
                <p class="font-medium">Hasil pencarian ikan hias "{{ request('search') }}"</p>
                @else
                <p class="font-medium">Hasil filter kategori "{{ request('category') }}"</p>
                @endif
                <p class="text-xs mt-1">Terdapat {{ $products->total() }} hasil</p>
            </div>
            <a href="{{ route('homepage.index') }}" class="inline-flex items-center gap-2 bg-white border-2 border-[#4871AD] text-[#4871AD] px-4 py-2 rounded-lg font-serif text-sm font-medium hover:bg-[#4871AD] hover:text-white hover:shadow-md transform hover:scale-105 transition-all duration-300 ease-in-out group">
                <i class="fas fa-times-circle text-sm group-hover:rotate-90 transition-transform duration-300"></i>
                <span>Reset Filter</span>
            </a>
        </div>
        @endif

        <!-- Products grid -->
        <div class="grid grid-cols-2 gap-3 lg:grid-cols-4 lg:gap-8 lg:max-w-7xl lg:mx-auto" id="products-container">
            @forelse ($products as $product)
            <a href="{{ route('homepage.show-product', compact('product')) }}"
                class="product-card block group rounded-xl shadow-sm border border-[#e6eefd] bg-white hover:shadow-xl hover:border-[#4871AD] hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                <div class="aspect-square bg-gray-100 overflow-hidden flex items-center justify-center">
                    <img src="{{ Storage::url($product->image_cover) }}" alt="{{ $product->name }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-all duration-300" />
                </div>
                <div class="flex flex-col gap-1 p-3 lg:p-4">
                    <div class="flex items-center justify-between">
                        <span class="text-base lg:text-lg font-bold text-[#4871AD] font-serif truncate group-hover:underline">{{ $product->name }}</span>
                        <span class="text-base lg:text-lg font-bold text-[#4871AD] font-serif group-hover:text-[#365a8c] transition-all">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex items-center gap-2 mt-1">
                        <i class="fas fa-store text-[#4871AD] text-xs"></i>
                        <span class="text-xs text-gray-500 font-serif font-normal truncate group-hover:text-[#4871AD]">{{ $product->seller->shop_name }}</span>
                    </div>
                </div>
            </a>
            @empty
            <p class="text-gray-500 col-span-2 lg:col-span-4 text-center py-8 font-serif">Tidak ada ikan hias ditemukan</p>
            @endforelse
        </div>

        @if ($products->hasMorePages())
        <div class="flex justify-center mt-8">
            <a href="{{ $products->nextPageUrl() }}"
                class="inline-flex items-center gap-2 bg-[#4871AD] text-white px-6 py-3 rounded-lg font-serif font-medium hover:bg-[#365a8c] hover:shadow-lg transform hover:scale-105 transition-all duration-300 ease-in-out group">
                <span>Muat Lebih Banyak</span>
                <i class="fas fa-chevron-down text-sm group-hover:animate-bounce"></i>
            </a>
        </div>
        @endif

        <!-- Pagination -->
        @if (!$products->hasMorePages() && $products->lastPage() > 1)
        <div class="flex flex-col items-center mt-8 space-y-2">
            {{ $products->links('pagination::tailwind') }}
        </div>
        @endif
    </div>

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .product-card {
            animation: fadeInUp 0.5s ease forwards;
        }

        .product-card:nth-child(2n) {
            animation-delay: 0.1s;
        }

        .product-card:nth-child(3n) {
            animation-delay: 0.2s;
        }

        .product-card:nth-child(4n) {
            animation-delay: 0.3s;
        }
    </style>

    <!-- Bottom Navigation -->
    @if (!auth('admin')->check())
    <div id="bottom-navbar" class="fixed bottom-0 left-0 right-0 bg-[#4871AD] text-white z-30 transition-opacity duration-200"
        :class="{'opacity-0 pointer-events-none': hideNavbar, 'opacity-100': !hideNavbar}">
        <div class="w-full max-w-2xl md:max-w-4xl lg:max-w-6xl xl:max-w-7xl mx-auto 
            @if(auth('customer')->check()) grid grid-cols-4 @else grid grid-cols-2 @endif text-center">
            <!-- Beranda -->
            <a href="{{ route('homepage.index') }}" class="py-2 flex flex-col items-center relative group transition-all">
                <svg width="24" height="24" viewBox="0 0 99 99" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="group-hover:scale-110 transition-transform duration-300">
                    <path d="M0 99V33L49.5 0L99 33V99H61.875V60.5H37.125V99H0Z" />
                </svg>
                <span class="text-xs font-serif mt-0.5" style="font-family: 'DM Serif Text', serif;">Beranda</span>
                <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t {{ Route::is('homepage.index') ? 'opacity-100' : 'opacity-0' }} group-hover:opacity-100 transition-opacity duration-300"></span>
            </a>
            @if(auth('customer')->check())
            <!-- Transaksi -->
            <a href="{{ route('customer.transactions') }}" class="py-2 flex flex-col items-center relative group transition-all">
                <svg width="24" height="24" viewBox="0 0 99 99" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="group-hover:scale-110 transition-transform duration-300">
                    <path d="M0 99V0L8.25 7.425L16.5 0L24.75 7.425L33 0L41.25 7.425L49.5 0L57.75 7.425L66 0L74.25 7.425L82.5 0L90.75 7.425L99 0V99L90.75 91.575L82.5 99L74.25 91.575L66 99L57.75 91.575L49.5 99L41.25 91.575L33 99L24.75 91.575L16.5 99L8.25 91.575L0 99ZM16.5 74.25H82.5V64.35H16.5V74.25ZM16.5 54.45H82.5V44.55H16.5V54.45ZM16.5 34.65H82.5V24.75H16.5V34.65Z" />
                </svg>
                <span class="text-xs font-serif mt-0.5" style="font-family: 'DM Serif Text', serif;">Transaksi</span>
                <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t {{ Route::is('customer.transactions') || Route::is('customer.transactions.*') ? 'opacity-100' : 'opacity-0' }} group-hover:opacity-100 transition-opacity duration-300"></span>
            </a>
            <!-- Kotak Masuk (customer saja) -->
            <a href="{{ route('customer.inbox') }}" class="py-2 flex flex-col items-center relative group transition-all">
                <svg width="24" height="24" viewBox="0 0 99 99" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="group-hover:scale-110 transition-transform duration-300">
                    <path d="M11 99C7.975 99 5.38633 97.9238 3.234 95.7715C1.08167 93.6192 0.00366667 91.0287 0 88V11C0 7.975 1.078 5.38633 3.234 3.234C5.39 1.08167 7.97867 0.00366667 11 0H88C91.025 0 93.6155 1.078 95.7715 3.234C97.9275 5.39 99.0037 7.97867 99 11V88C99 91.025 97.9238 93.6155 95.7715 95.7715C93.6192 97.9275 91.0287 99.0037 88 99H11ZM49.5 71.5C52.9833 71.5 56.1458 70.4917 58.9875 68.475C61.8292 66.4583 63.8 63.8 64.9 60.5H88V11H11V60.5H34.1C35.2 63.8 37.1708 66.4583 40.0125 68.475C42.8542 70.4917 46.0167 71.5 49.5 71.5Z" />
                </svg>
                <span class="text-xs font-serif mt-0.5" style="font-family: 'DM Serif Text', serif;">Kotak Masuk
                    @if (isset($notifications) && $notifications->count() > 0)
                    <span class="ml-1 bg-red-500 text-white px-1 rounded-full text-[10px]">
                        {{ $notifications->count() }}
                    </span>
                    @endif
                </span>
                <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t {{ Route::is('customer.inbox') ? 'opacity-100' : 'opacity-0' }} group-hover:opacity-100 transition-opacity duration-300"></span>
            </a>
            @endif
            <!-- Akun (semua role kecuali admin) -->
            <a href="@if(auth('seller')->check())
                            {{ route('seller.dashboard') }}
                        @elseif(auth('customer')->check())
                            {{ route('customer.dashboard') }}
                        @else
                            {{ route('pick-login') }}
                        @endif" class="py-2 flex flex-col items-center relative group transition-all">
                <svg width="24" height="24" viewBox="0 0 99 99" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="group-hover:scale-110 transition-transform duration-300">
                    <path d="M49.5 0C56.0641 0 62.3594 2.60758 67.0009 7.24911C71.6424 11.8906 74.25 18.1859 74.25 24.75C74.25 31.3141 71.6424 37.6094 67.0009 42.2509C62.3594 46.8924 56.0641 49.5 49.5 49.5C42.9359 49.5 36.6406 46.8924 31.9991 42.2509C27.3576 37.6094 24.75 31.3141 24.75 24.75C24.75 18.1859 27.3576 11.8906 31.9991 7.24911C36.6406 2.60758 42.9359 0 49.5 0ZM49.5 61.875C76.8488 61.875 99 72.9506 99 86.625V99H0V86.625C0 72.9506 22.1512 61.875 49.5 61.875Z" />
                </svg>
                <span class="text-xs font-serif mt-0.5" style="font-family: 'DM Serif Text', serif;">Akun</span>
                <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t {{ Route::is('customer.dashboard') ? 'opacity-100' : 'opacity-0' }} group-hover:opacity-100 transition-opacity duration-300"></span>
            </a>
        </div>
    </div>
    @endif
</x-app-layout>