<x-app-layout>
    <div class="w-full min-h-screen bg-white lg:shadow-lg lg:my-0 overflow-hidden">
        <!-- Fixed Top Navigation -->
        <div class="fixed top-0 left-0 right-0 bg-white z-30 shadow-md transition-all duration-300">
            <div class="w-full px-4 lg:px-16 xl:px-32 py-4 flex items-center justify-between gap-2">
                <h1 class="text-2xl text-[#4871AD] font-normal tracking-tight flex-shrink-0" style="font-family: 'DM Serif Text', serif; letter-spacing: -1px;">
                    Transaksi Saya
                </h1>
                <form action="{{ request()->url() }}" method="GET" class="flex items-center w-40 sm:w-48 md:w-56 lg:w-64 xl:w-72">
                    <label for="sort" class="mr-2 text-sm text-gray-500 font-serif hidden md:inline-block" style="font-family: 'DM Serif Text', serif;">Urutkan:</label>
                    <select name="sort" id="sort" onchange="this.form.submit()"
                        class="text-xs lg:text-base bg-white border border-gray-200 rounded-lg px-2 py-1 lg:px-4 lg:py-2 focus:outline-none focus:ring-2 focus:ring-[#4871AD] focus:border-transparent cursor-pointer hover:border-[#4871AD] transition-colors duration-200 font-serif text-center appearance-none shadow-sm w-full"
                        style="font-family: 'DM Serif Text', serif;">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                    </select>
                </form>
            </div>
        </div>

        <!-- Tab Navigation -->
        <div class="transition-all duration-300">
            <!-- Mobile -->
            <div class="block lg:hidden fixed top-20 left-0 right-0 bg-white z-30">
                <div class="w-full flex text-sm px-4 gap-2 pt-1 pb-1">
                    <a href="{{ route('customer.transactions.unpaid') }}"
                        class="flex-1 py-2 text-center rounded-lg font-normal transition-colors duration-200 {{ $activeTab == 'unpaid' ? 'bg-[#4871AD] text-white shadow' : 'bg-[#f5f8fc] text-[#4871AD] hover:bg-[#eaf1fa]' }}"
                        style="font-family: 'DM Serif Text', serif;">
                        Belum Bayar
                    </a>
                    <a href="{{ route('customer.transactions.packed') }}"
                        class="flex-1 py-2 text-center rounded-lg font-normal transition-colors duration-200 {{ $activeTab == 'packed' ? 'bg-[#4871AD] text-white shadow' : 'bg-[#f5f8fc] text-[#4871AD] hover:bg-[#eaf1fa]' }}"
                        style="font-family: 'DM Serif Text', serif;">
                        Dikemas
                    </a>
                    <a href="{{ route('customer.transactions.shipped') }}"
                        class="flex-1 py-2 text-center rounded-lg font-normal transition-colors duration-200 {{ $activeTab == 'shipped' ? 'bg-[#4871AD] text-white shadow' : 'bg-[#f5f8fc] text-[#4871AD] hover:bg-[#eaf1fa]' }}"
                        style="font-family: 'DM Serif Text', serif;">
                        Dikirim
                    </a>
                    <a href="{{ route('customer.transactions.completed') }}"
                        class="flex-1 py-2 text-center rounded-lg font-normal transition-colors duration-200 {{ $activeTab == 'completed' ? 'bg-[#4871AD] text-white shadow' : 'bg-[#f5f8fc] text-[#4871AD] hover:bg-[#eaf1fa]' }}"
                        style="font-family: 'DM Serif Text', serif;">
                        Selesai
                    </a>
                </div>
            </div>
            <!-- Desktop: Sidebar -->
            <div class="hidden lg:block fixed top-20 left-0 bottom-0 w-56 bg-white z-20 border-r border-gray-100 shadow-sm pt-8">
                <nav class="flex flex-col gap-2 px-4">
                    <a href="{{ route('customer.transactions.unpaid') }}"
                        class="py-3 px-4 rounded-lg text-left border-l-4 font-normal {{ $activeTab == 'unpaid' ? 'border-[#4871AD] bg-[#f5f8fc] text-[#4871AD]' : 'border-transparent text-gray-500 hover:bg-gray-50' }} transition-colors duration-200"
                        style="font-family: 'DM Serif Text', serif;">
                        Belum Bayar
                    </a>
                    <a href="{{ route('customer.transactions.packed') }}"
                        class="py-3 px-4 rounded-lg text-left border-l-4 font-normal {{ $activeTab == 'packed' ? 'border-[#4871AD] bg-[#f5f8fc] text-[#4871AD]' : 'border-transparent text-gray-500 hover:bg-gray-50' }} transition-colors duration-200"
                        style="font-family: 'DM Serif Text', serif;">
                        Dikemas
                    </a>
                    <a href="{{ route('customer.transactions.shipped') }}"
                        class="py-3 px-4 rounded-lg text-left border-l-4 font-normal {{ $activeTab == 'shipped' ? 'border-[#4871AD] bg-[#f5f8fc] text-[#4871AD]' : 'border-transparent text-gray-500 hover:bg-gray-50' }} transition-colors duration-200"
                        style="font-family: 'DM Serif Text', serif;">
                        Dikirim
                    </a>
                    <a href="{{ route('customer.transactions.completed') }}"
                        class="py-3 px-4 rounded-lg text-left border-l-4 font-normal {{ $activeTab == 'completed' ? 'border-[#4871AD] bg-[#f5f8fc] text-[#4871AD]' : 'border-transparent text-gray-500 hover:bg-gray-50' }} transition-colors duration-200"
                        style="font-family: 'DM Serif Text', serif;">
                        Selesai
                    </a>
                </nav>
            </div>
        </div>

        <!-- Transaction Content -->
        <div class="pt-32 lg:pt-28 lg:pl-60 px-2 md:px-4 pb-32 lg:pb-20">
            @include('components.modals.status')
            @include('components.modals.errors')

            <!-- Transaction Items -->
            @if(isset($transactions) && $transactions->count() > 0)
            @php
            $sortedTransactions = request('sort') == 'oldest'
            ? $transactions->sortBy('created_at')
            : $transactions->sortByDesc('created_at');
            @endphp
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                @foreach($sortedTransactions as $transaction)
                <div class="group mb-4 bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-xl hover:border-[#4871AD] transition-all duration-300 flex flex-col h-full overflow-hidden relative cursor-pointer">
                    <!-- Seller Info -->
                    <div class="p-4 border-b border-gray-100 bg-gradient-to-r from-[#f5f8fc] to-white flex justify-between items-center sticky top-0 z-10">
                        <div class="flex items-center gap-2">
                            <span class="inline-block w-2 h-2 rounded-full bg-[#4871AD] mr-2"></span>
                            <p class="font-normal text-[#4871AD] text-base" style="font-family: 'DM Serif Text', serif;">
                                Transaction #ID{{ $transaction->id}}
                            </p>
                        </div>
                        <span class="text-xs px-3 py-1 rounded-full bg-[#eaf1fa] text-[#4871AD] font-medium" style="font-family: 'DM Serif Text', serif;">
                            @if($activeTab == 'unpaid') Belum Bayar
                            @elseif($activeTab == 'packed') Dikemas
                            @elseif($activeTab == 'shipped') Dikirim
                            @elseif($activeTab == 'completed') Selesai
                            @endif
                        </span>
                    </div>
                    <!-- Product Items -->
                    <div class="divide-y divide-gray-100 max-h-64 overflow-y-auto scrollbar-thin scrollbar-thumb-[#4871AD]/30 scrollbar-track-gray-100">
                        @foreach($transaction->order->orderLines as $orderLine)
                        <div class="flex p-4 bg-white group-hover:bg-[#f5f8fc] transition-colors duration-200 {{ !$loop->last ? '' : 'rounded-b-2xl' }}">
                            <div class="w-20 h-20 bg-gray-100 rounded-xl flex items-center justify-center overflow-hidden border border-gray-200 shadow-sm transition-all duration-200">
                                @if($orderLine->product->image_cover)
                                <img src="{{ Storage::url($orderLine->product->image_cover) }}" alt="{{ $orderLine->product->name }}" class="w-full h-full object-cover object-center scale-105 hover:scale-110 transition-transform duration-300 rounded-xl shadow-md">
                                @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-10 h-10 text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                @endif
                            </div>
                            <div class="ml-4 flex-1">
                                <p class="font-medium text-gray-800" style="font-family: 'DM Serif Text', serif;">{{ $orderLine->product->name }}</p>
                                <p class="text-xs text-gray-500 mt-1" style="font-family: 'DM Serif Text', serif;">{{ $orderLine->quantity }} x Rp{{ number_format($orderLine->product->price, 0, ',', '.') }}</p>
                                <div class="flex justify-between items-center mt-2">
                                    <p class="text-[#4871AD] font-normal text-sm" style="font-family: 'DM Serif Text', serif;">Rp{{ number_format($orderLine->quantity * $orderLine->product->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Transaction Footer -->
                    <div class="p-4 bg-[#f5f8fc] border-t border-gray-100 flex justify-between items-center mt-auto">
                        <div>
                            <p class="text-xs text-gray-500 mb-1" style="font-family: 'DM Serif Text', serif;">Total Pembayaran</p>
                            <p class="font-bold text-[#4871AD] text-lg" style="font-family: 'DM Serif Text', serif;">Rp{{ number_format($transaction->order->orderLines->sum(function($item) { return $item->quantity * $item->product->price; }), 0, ',', '.') }}</p>
                        </div>
                        <div class="flex gap-2">
                            @if($activeTab == 'unpaid')
                            <form action="{{ route('customer.transactions.pay', $transaction->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-5 py-2 bg-[#4871AD] text-white rounded-lg shadow hover:bg-[#365a8c] hover:scale-105 transition-all duration-200 text-sm font-normal focus:outline-none focus:ring-2 focus:ring-[#4871AD]/50" style="font-family: 'DM Serif Text', serif;">
                                    Bayar Sekarang
                                </button>
                            </form>
                            @elseif($activeTab == 'packed')
                            <a href="#" class="px-5 py-2 bg-[#4871AD] text-white rounded-lg shadow hover:bg-[#365a8c] hover:scale-105 transition-all duration-200 text-sm font-normal focus:outline-none focus:ring-2 focus:ring-[#4871AD]/50" style="font-family: 'DM Serif Text', serif;">
                                Lacak Pesanan
                            </a>
                            @elseif($activeTab == 'shipped')
                            <a href="#" class="px-5 py-2 bg-[#4871AD] text-white rounded-lg shadow hover:bg-[#365a8c] hover:scale-105 transition-all duration-200 text-sm font-normal focus:outline-none focus:ring-2 focus:ring-[#4871AD]/50" style="font-family: 'DM Serif Text', serif;">
                                Terima Pesanan
                            </a>
                            @elseif($activeTab == 'completed')
                            @foreach($transaction->order->orderLines as $orderLine)
                            <a href="{{ route('homepage.show-product', $orderLine->product) }}" class="px-5 py-2 bg-[#4871AD] text-white rounded-lg shadow hover:bg-[#365a8c] hover:scale-105 transition-all duration-200 text-sm font-normal focus:outline-none focus:ring-2 focus:ring-[#4871AD]/50" style="font-family: 'DM Serif Text', serif;">
                                Beli Lagi
                            </a>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="absolute inset-0 rounded-2xl border-2 border-transparent group-hover:border-[#4871AD] pointer-events-none transition-all duration-300"></div>
                </div>
                @endforeach
            </div>
            @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-16 h-16 text-gray-300 mx-auto mb-4">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="text-lg font-medium text-gray-700" style="font-family: 'DM Serif Text', serif;">
                    @if($activeTab == 'unpaid')
                    Belum ada transaksi yang belum dibayar
                    @elseif($activeTab == 'packed')
                    Belum ada transaksi yang sedang dikemas
                    @elseif($activeTab == 'shipped')
                    Belum ada transaksi yang sedang dikirim
                    @elseif($activeTab == 'completed')
                    Belum ada transaksi yang selesai
                    @endif
                </h3>
                <p class="text-gray-500 mt-1" style="font-family: 'DM Serif Text', serif;">
                    @if($activeTab == 'unpaid')
                    Transaksi yang belum dibayar akan muncul di sini
                    @elseif($activeTab == 'packed')
                    Transaksi yang sedang dikemas akan muncul di sini
                    @elseif($activeTab == 'shipped')
                    Transaksi yang sedang dikirim akan muncul di sini
                    @elseif($activeTab == 'completed')
                    Transaksi yang telah selesai akan muncul di sini
                    @endif
                </p>
                <a href="{{ route('homepage.index') }}" class="mt-4 inline-block px-4 py-2 bg-[#4871AD] text-white rounded-md" style="font-family: 'DM Serif Text', serif;">
                    Belanja Sekarang
                </a>
            </div>
            @endif
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
                            {{ Route::is('customer.transactions*') ? 'opacity-100' : 'opacity-0' }}
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
                        @if(isset($notifications) && $notifications->count() > 0)
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
    </div>
</x-app-layout>