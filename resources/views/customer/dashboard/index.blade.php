<x-app-layout class="font-serif">
    <div class="max-w-md mx-auto bg-white min-h-screen pb-20">
        <!-- Header dengan judul dan ikon -->
        <div class="p-4 flex justify-between items-center border-b">
            <h1 class="text-xl font-medium text-[#4871AD]" style="font-family: 'DM Serif Text', serif;">Akun Saya</h1>
            <div class="flex gap-4">
                <a href="#" class="text-[#4871AD]">
                    <i class="fas fa-bell"></i>
                </a>
                <a href="#" class="text-[#4871AD]">
                    <i class="fas fa-comment-alt"></i>
                </a>
            </div>
        </div>

        <!-- Profile section -->
        <div class="p-4 flex items-center">
            <!-- Avatar (warna biru) -->
            <div class="w-16 h-16 bg-[#4871AD] rounded-full flex items-center justify-center text-white overflow-hidden mr-4">
                @if(Auth::guard('customer')->user()->avatar)
                <img src="{{ Storage::url(Auth::guard('customer')->user()->avatar) }}" alt="Profile" class="w-full h-full object-cover">
                @else
                <i class="fas fa-user text-2xl"></i>
                @endif
            </div>

            <!-- User info -->
            <div class="flex-1">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-[#4871AD] font-medium text-lg" style="font-family: 'DM Serif Text', serif;">{{ Auth::guard('customer')->user()->name }}</h2>
                        <p class="text-gray-600 text-sm" style="font-family: 'DM Serif Text', serif;">{{ Auth::guard('customer')->user()->email }}</p>
                        <!-- Tombol Keluar (dipindahkan ke bawah email) -->
                        <form action="{{ route('customer.logout') }}" method="POST" class="mt-1">
                            @csrf
                            <button type="submit" class="text-red-600 text-sm font-medium" style="font-family: 'DM Serif Text', serif;">
                                <i class="fas fa-sign-out-alt mr-1"></i> Keluar
                            </button>
                        </form>
                    </div>
                    <a href="#" class="text-gray-400">
                        <i class="fas fa-cog"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Status Pesanan -->
        <div class="mx-4 mt-3 p-4 border rounded-lg">
            <h3 class="text-gray-700 mb-3" style="font-family: 'DM Serif Text', serif;">Status Pesanan</h3>
            <div class="grid grid-cols-3 gap-2 text-center">
                <div class="bg-[#4871AD] text-white py-2 rounded">
                    <div class="text-xl font-bold" style="font-family: 'DM Serif Text', serif;">0</div>
                    <div class="text-xs" style="font-family: 'DM Serif Text', serif;">Belum Dibayar</div>
                </div>
                <div class="bg-[#4871AD] text-white py-2 rounded">
                    <div class="text-xl font-bold" style="font-family: 'DM Serif Text', serif;">0</div>
                    <div class="text-xs" style="font-family: 'DM Serif Text', serif;">Dikirim</div>
                </div>
                <div class="bg-[#4871AD] text-white py-2 rounded">
                    <div class="text-xl font-bold" style="font-family: 'DM Serif Text', serif;">0</div>
                    <div class="text-xs" style="font-family: 'DM Serif Text', serif;">Selesai</div>
                </div>
            </div>
        </div>

        <!-- Menu Akun -->
        <div class="mx-4 mt-3 p-4 border rounded-lg">
            <div class="grid grid-cols-3 gap-2 text-center">
                <a href="#" class="py-3">
                    <div class="flex justify-center mb-1">
                        <div class="w-10 h-10 bg-[#4871AD] text-white rounded flex items-center justify-center">
                            <i class="fas fa-receipt"></i>
                        </div>
                    </div>
                    <span class="text-sm text-gray-700" style="font-family: 'DM Serif Text', serif;">Transaksi</span>
                </a>
                <a href="#" class="py-3">
                    <div class="flex justify-center mb-1">
                        <div class="w-10 h-10 bg-[#4871AD] text-white rounded flex items-center justify-center">
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <span class="text-sm text-gray-700" style="font-family: 'DM Serif Text', serif;">Ulasan</span>
                </a>
                <a href="#" class="py-3">
                    <div class="flex justify-center mb-1">
                        <div class="w-10 h-10 bg-[#4871AD] text-white rounded flex items-center justify-center">
                            <i class="fas fa-question-circle"></i>
                        </div>
                    </div>
                    <span class="text-sm text-gray-700" style="font-family: 'DM Serif Text', serif;">Bantuan</span>
                </a>
            </div>
        </div>

        <!-- Produk yang Diulas -->
        <div class="p-4">
            <h3 class="text-[#4871AD] font-medium mb-3" style="font-family: 'DM Serif Text', serif;">Produk yang Diulas</h3>
            <div class="grid grid-cols-2 gap-3">
                <!-- Product 1 -->
                <div class="bg-[#4871AD] rounded overflow-hidden text-white">
                    <div class="p-2 flex items-start">
                        <div class="w-10 h-10 bg-white rounded flex items-center justify-center mr-2">
                            <i class="fas fa-image text-gray-400"></i>
                        </div>
                        <div class="flex-1">
                            <div class="text-sm" style="font-family: 'DM Serif Text', serif;">Nama Produk</div>
                            <div class="flex text-yellow-300">
                                <i class="fas fa-star text-xs"></i>
                                <i class="fas fa-star text-xs"></i>
                                <i class="fas fa-star text-xs"></i>
                                <i class="fas fa-star text-xs"></i>
                                <i class="fas fa-star text-xs"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="bg-[#4871AD] rounded overflow-hidden text-white">
                    <div class="p-2 flex items-start">
                        <div class="w-10 h-10 bg-white rounded flex items-center justify-center mr-2">
                            <i class="fas fa-image text-gray-400"></i>
                        </div>
                        <div class="flex-1">
                            <div class="text-sm" style="font-family: 'DM Serif Text', serif;">Nama Produk</div>
                            <div class="flex text-yellow-300">
                                <i class="fas fa-star text-xs"></i>
                                <i class="fas fa-star text-xs"></i>
                                <i class="fas fa-star text-xs"></i>
                                <i class="fas fa-star text-xs"></i>
                                <i class="fas fa-star text-xs"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="fixed bottom-0 left-0 right-0 bg-[#4871AD] text-white z-30">
        <div class="w-full max-w-2xl md:max-w-4xl lg:max-w-6xl xl:max-w-7xl mx-auto grid grid-cols-4 text-center">
            <!-- Home -->
            <a href="{{ route('homepage.index') }}" class="py-2 flex flex-col items-center relative group">
                <svg width="24" height="24" viewBox="0 0 99 99" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg"
                    class="group-hover:scale-110 transition-transform duration-300">
                    <path d="M0 99V33L49.5 0L99 33V99H61.875V60.5H37.125V99H0Z" />
                </svg>
                <span class="text-xs font-serif mt-0.5" style="font-family: 'DM Serif Text', serif;">Beranda</span>
                <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t
                            {{ Route::is('homepage.index') ? 'opacity-100' : 'opacity-0' }}
                            group-hover:opacity-100 transition-opacity duration-300"></span>
            </a>
            <!-- Transactions -->
            <a href="{{ route('customer.transactions') }}" class="py-2 flex flex-col items-center relative group">
                <svg width="24" height="24" viewBox="0 0 99 99" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg"
                    class="group-hover:scale-110 transition-transform duration-300">
                    <path d="M0 99V0L8.25 7.425L16.5 0L24.75 7.425L33 0L41.25 7.425L49.5 0L57.75 7.425L66 0L74.25 7.425L82.5 0L90.75 7.425L99 0V99L90.75 91.575L82.5 99L74.25 91.575L66 99L57.75 91.575L49.5 99L41.25 91.575L33 99L24.75 91.575L16.5 99L8.25 91.575L0 99ZM16.5 74.25H82.5V64.35H16.5V74.25ZM16.5 54.45H82.5V44.55H16.5V54.45ZM16.5 34.65H82.5V24.75H16.5V34.65Z" />
                </svg>
                <span class="text-xs font-serif mt-0.5" style="font-family: 'DM Serif Text', serif;">Transaksi</span>
                <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t
                            {{ Route::is('customer.transactions') ? 'opacity-100' : 'opacity-0' }}
                            group-hover:opacity-100 transition-opacity duration-300"></span>
            </a>
            <!-- Inbox -->
            <a href="{{ route('customer.inbox') }}" class="py-2 flex flex-col items-center relative group">
                <svg width="24" height="24" viewBox="0 0 99 99" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg"
                    class="group-hover:scale-110 transition-transform duration-300">
                    <path
                        d="M11 99C7.975 99 5.38633 97.9238 3.234 95.7715C1.08167 93.6192 0.00366667 91.0287 0 88V11C0 7.975 1.078 5.38633 3.234 3.234C5.39 1.08167 7.97867 0.00366667 11 0H88C91.025 0 93.6155 1.078 95.7715 3.234C97.9275 5.39 99.0037 7.97867 99 11V88C99 91.025 97.9238 93.6155 95.7715 95.7715C93.6192 97.9275 91.0287 99.0037 88 99H11ZM49.5 71.5C52.9833 71.5 56.1458 70.4917 58.9875 68.475C61.8292 66.4583 63.8 63.8 64.9 60.5H88V11H11V60.5H34.1C35.2 63.8 37.1708 66.4583 40.0125 68.475C42.8542 70.4917 46.0167 71.5 49.5 71.5Z" />
                </svg>
                <span class="text-xs font-serif mt-0.5" style="font-family: 'DM Serif Text', serif;">
                    Kotak Masuk
                    @if ($notifications->count() > 0)
                    <span class="ml-1 bg-red-500 text-white px-1 rounded-full text-[10px]">
                        {{ $notifications->count() }}
                    </span>
                    @endif
                </span>
                <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t
                            {{ Route::is('customer.inbox') ? 'opacity-100' : 'opacity-0' }}
                            group-hover:opacity-100 transition-opacity duration-300"></span>
            </a>
            <!-- Account -->
            <a href="{{ route('customer.dashboard') }}" class="py-2 flex flex-col items-center relative group">
                <svg width="24" height="24" viewBox="0 0 99 99" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg"
                    class="group-hover:scale-110 transition-transform duration-300">
                    <path d="M49.5 0C56.0641 0 62.3594 2.60758 67.0009 7.24911C71.6424 11.8906 74.25 18.1859 74.25 24.75C74.25 31.3141 71.6424 37.6094 67.0009 42.2509C62.3594 46.8924 56.0641 49.5 49.5 49.5C42.9359 49.5 36.6406 46.8924 31.9991 42.2509C27.3576 37.6094 24.75 31.3141 24.75 24.75C24.75 18.1859 27.3576 11.8906 31.9991 7.24911C36.6406 2.60758 42.9359 0 49.5 0ZM49.5 61.875C76.8488 61.875 99 72.9506 99 86.625V99H0V86.625C0 72.9506 22.1512 61.875 49.5 61.875Z" />
                </svg>
                <span class="text-xs font-serif mt-0.5" style="font-family: 'DM Serif Text', serif;">Akun</span>
                <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t
                            {{ Route::is('customer.dashboard') ? 'opacity-100' : 'opacity-0' }}
                            group-hover:opacity-100 transition-opacity duration-300"></span>
            </a>
        </div>
    </div>
</x-app-layout>