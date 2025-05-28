<x-app-layout class="font-serif">
    <!-- Header Mobile -->
    <div class="p-4 flex justify-between items-center md:rounded-xl md:shadow-sm bg-white sticky top-0 z-20 border-b border-gray-200 block md:hidden">
        <h1 class="text-xl md:text-2xl font-medium text-[#4871AD]" style="font-family: 'DM Serif Text', serif;">Akun Saya</h1>
        <div class="flex gap-4">
            <a href="{{ route('customer.inbox') }}" class="text-[#4871AD] hover:bg-[#e6eef8] rounded-full p-2 transition-colors duration-200">
                <i class="fas fa-bell"></i>
            </a>
            <a href="{{ route('customer.inbox') }}" class="text-[#4871AD] hover:bg-[#e6eef8] rounded-full p-2 transition-colors duration-200">
                <i class="fas fa-comment-alt"></i>
            </a>
        </div>
    </div>
    <div class="w-full min-h-screen pb-20 bg-white flex flex-col md:flex-row md:gap-6">
        <!-- Sidebar Akun -->
        <aside class="md:w-1/3 md:max-w-xs bg-white md:rounded-xl md:shadow-md md:my-8 md:ml-8 flex flex-col items-center md:items-stretch">
            <div class="p-4 w-full flex flex-col items-center md:items-center">
                <div class="w-20 h-20 md:w-28 md:h-28 bg-[#4871AD] rounded-full flex items-center justify-center text-white overflow-hidden shadow-md mb-3">
                    @if(Auth::guard('customer')->user()->avatar)
                    <img src="{{ Storage::url(Auth::guard('customer')->user()->avatar) }}" alt="Profile" class="w-full h-full object-cover">
                    @else
                    <i class="fas fa-user text-3xl md:text-5xl"></i>
                    @endif
                </div>
                <h2 class="text-[#4871AD] font-medium text-lg md:text-xl text-center" style="font-family: 'DM Serif Text', serif;">{{ Auth::guard('customer')->user()->name }}</h2>
                <p class="text-gray-600 text-sm md:text-base text-center" style="font-family: 'DM Serif Text', serif;">{{ Auth::guard('customer')->user()->email }}</p>
                <form action="{{ route('customer.logout') }}" method="POST" class="mt-2 w-full flex justify-center">
                    @csrf
                    <button type="submit" class="text-red-600 text-sm font-medium hover:underline hover:text-red-700 transition-colors flex items-center gap-1" style="font-family: 'DM Serif Text', serif;">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </button>
                </form>
                <a href="#" class="text-gray-400 hover:text-[#4871AD] mt-3 transition-colors text-center"> {{-- Link untuk pengaturan akun --}}
                    <i class="fas fa-cog"></i>
                </a>
            </div>
        </aside>

        <!-- Main Content (Kanan) -->
        <main class="flex-1 md:my-8 md:mr-8">
            <!-- Header Desktop -->
            <div class="p-4 justify-between items-center md:rounded-xl md:shadow-sm bg-white sticky top-0 z-20 border-b border-gray-200 hidden md:flex">
                <h1 class="text-xl md:text-2xl font-medium text-[#4871AD]" style="font-family: 'DM Serif Text', serif;">Akun Saya</h1>
                <div class="flex gap-4">
                    <a href="{{ route('customer.inbox') }}" class="text-[#4871AD] hover:bg-[#e6eef8] rounded-full p-2 transition-colors duration-200">
                        <i class="fas fa-bell"></i>
                    </a>
                    <a href="{{ route('customer.inbox') }}" class="text-[#4871AD] hover:bg-[#e6eef8] rounded-full p-2 transition-colors duration-200">
                        <i class="fas fa-comment-alt"></i>
                    </a>
                </div>
            </div>

            <!-- Status Pesanan -->
            <div class="mx-0 md:mx-0 mt-3 p-4 rounded-xl shadow-sm bg-[#f8fafc]">
                <h3 class="text-gray-700 mb-3 md:text-lg" style="font-family: 'DM Serif Text', serif;">Status Pesanan</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-center">
                    <a href="{{ route('customer.transactions.unpaid', ['status' => 'unpaid']) }}" class="bg-[#4871AD] text-white py-4 rounded-xl hover:bg-blue-700 transition-colors flex flex-col items-center shadow group">
                        <div class="text-xl md:text-2xl font-bold group-hover:scale-110 transition-transform" style="font-family: 'DM Serif Text', serif;">{{ $statusCounts['unpaid'] ?? 0 }}</div>
                        <div class="text-xs md:text-sm" style="font-family: 'DM Serif Text', serif;">Belum Dibayar</div>
                    </a>
                    <a href="{{ route('customer.transactions.packed', ['status' => 'packed']) }}" class="bg-[#4871AD] text-white py-4 rounded-xl hover:bg-blue-700 transition-colors flex flex-col items-center shadow group">
                        <div class="text-xl md:text-2xl font-bold group-hover:scale-110 transition-transform" style="font-family: 'DM Serif Text', serif;">{{ $statusCounts['packed'] ?? 0 }}</div>
                        <div class="text-xs md:text-sm" style="font-family: 'DM Serif Text', serif;">Dikemas</div>
                    </a>
                    <a href="{{ route('customer.transactions.shipped', ['status' => 'shipped']) }}" class="bg-[#4871AD] text-white py-4 rounded-xl hover:bg-blue-700 transition-colors flex flex-col items-center shadow group">
                        <div class="text-xl md:text-2xl font-bold group-hover:scale-110 transition-transform" style="font-family: 'DM Serif Text', serif;">{{ $statusCounts['shipped'] ?? 0 }}</div>
                        <div class="text-xs md:text-sm" style="font-family: 'DM Serif Text', serif;">Dikirim</div>
                    </a>
                    <a href="{{ route('customer.transactions.completed', ['status' => 'completed']) }}" class="bg-[#4871AD] text-white py-4 rounded-xl hover:bg-blue-700 transition-colors flex flex-col items-center shadow group">
                        <div class="text-xl md:text-2xl font-bold group-hover:scale-110 transition-transform" style="font-family: 'DM Serif Text', serif;">{{ $statusCounts['completed'] ?? 0 }}</div>
                        <div class="text-xs md:text-sm" style="font-family: 'DM Serif Text', serif;">Selesai</div>
                    </a>
                </div>
            </div>

        <!-- Menu Akun -->
        <div class="mx-0 md:mx-4 mt-3 p-4 rounded-xl shadow-sm bg-[#f8fafc]">
            <div class="grid grid-cols-3 gap-3 text-center">
                <a href="{{ route('customer.transactions', ['status' => 'unpaid']) }}" class="py-3 group transition-colors rounded-xl hover:bg-[#e6eef8] flex flex-col items-center">
                    <div class="flex justify-center mb-1">
                        <div class="w-12 h-12 bg-[#4871AD] text-white rounded-xl flex items-center justify-center group-hover:scale-110 group-hover:bg-blue-700 transition-all shadow">
                            <i class="fas fa-receipt"></i>
                        </div>
                    </div>
                    <span class="text-sm text-gray-700 group-hover:text-[#4871AD] font-medium" style="font-family: 'DM Serif Text', serif;">Transaksi</span>
                </a>
                <a href="#" class="py-3 group transition-colors rounded-xl hover:bg-[#e6eef8] flex flex-col items-center">
                    <div class="flex justify-center mb-1">
                        <div class="w-12 h-12 bg-[#4871AD] text-white rounded-xl flex items-center justify-center group-hover:scale-110 group-hover:bg-blue-700 transition-all shadow">
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <span class="text-sm text-gray-700 group-hover:text-[#4871AD] font-medium" style="font-family: 'DM Serif Text', serif;">Ulasan</span>
                </a>
                <a href="#" class="py-3 group transition-colors rounded-xl hover:bg-[#e6eef8] flex flex-col items-center">
                    <div class="flex justify-center mb-1">
                        <div class="w-12 h-12 bg-[#4871AD] text-white rounded-xl flex items-center justify-center group-hover:scale-110 group-hover:bg-blue-700 transition-all shadow">
                            <i class="fas fa-question-circle"></i>
                        </div>
                    </div>
                    <span class="text-sm text-gray-700 group-hover:text-[#4871AD] font-medium" style="font-family: 'DM Serif Text', serif;">Bantuan</span>
                </a>
            </div>
        </div>

        <!-- Produk yang Telah Dibeli -->
        <div class="p-4">
            <h3 class="text-[#4871AD] font-medium mb-3 md:text-lg" style="font-family: 'DM Serif Text', serif;">Produk yang Telah Dibeli</h3>
            @if(isset($purchasedProducts) && $purchasedProducts->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($purchasedProducts->take(4) as $product)
                <div class="bg-[#4871AD] rounded-xl overflow-hidden text-white hover:shadow-lg hover:scale-105 transition-all">
                    <a href="{{-- route('product.show', $product->slug) --}}" class="block p-2">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center mr-2 overflow-hidden">
                                @if($product->image_url)
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                @else
                                    <i class="fas fa-image text-gray-400"></i>
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="text-sm truncate" style="font-family: 'DM Serif Text', serif;">{{ $product->name }}</div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-500 text-sm" style="font-family: 'DM Serif Text', serif;">Anda belum melakukan pembelian</p>
            @endif
        </div>
    </div>

    {{-- Bottom Navbar--}}
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
                            {{ Route::is('customer.transactions') || Route::is('customer.transactions.*') ? 'opacity-100' : 'opacity-0' }}
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
                    @if (isset($notifications) && $notifications->count() > 0)
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