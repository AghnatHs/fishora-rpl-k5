<x-app-layout class="font-serif">
    <div class="max-w-md mx-auto bg-white min-h-screen pb-20">
        <!-- Header dengan judul dan ikon -->
        <div class="p-4 flex justify-between items-center border-b">
            <h1 class="text-xl font-medium text-[#4871AD]">Akun Saya</h1>
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
                        <h2 class="text-[#4871AD] font-medium text-lg">{{ Auth::guard('customer')->user()->name }}</h2>
                        <p class="text-gray-600 text-sm">{{ Auth::guard('customer')->user()->email }}</p>
                        <!-- Tombol Keluar (dipindahkan ke bawah email) -->
                        <form action="{{ route('customer.logout') }}" method="POST" class="mt-1">
                            @csrf
                            <button type="submit" class="text-red-600 text-sm font-medium">
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
            <h3 class="text-gray-700 mb-3">Status Pesanan</h3>
            <div class="grid grid-cols-3 gap-2 text-center">
                <div class="bg-[#4871AD] text-white py-2 rounded">
                    <div class="text-xl font-bold">0</div>
                    <div class="text-xs">Belum Dibayar</div>
                </div>
                <div class="bg-[#4871AD] text-white py-2 rounded">
                    <div class="text-xl font-bold">0</div>
                    <div class="text-xs">Dikirim</div>
                </div>
                <div class="bg-[#4871AD] text-white py-2 rounded">
                    <div class="text-xl font-bold">0</div>
                    <div class="text-xs">Selesai</div>
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
                    <span class="text-sm text-gray-700">Transaksi</span>
                </a>
                <a href="#" class="py-3">
                    <div class="flex justify-center mb-1">
                        <div class="w-10 h-10 bg-[#4871AD] text-white rounded flex items-center justify-center">
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <span class="text-sm text-gray-700">Ulasan</span>
                </a>
                <a href="#" class="py-3">
                    <div class="flex justify-center mb-1">
                        <div class="w-10 h-10 bg-[#4871AD] text-white rounded flex items-center justify-center">
                            <i class="fas fa-question-circle"></i>
                        </div>
                    </div>
                    <span class="text-sm text-gray-700">Bantuan</span>
                </a>
            </div>
        </div>

        <!-- Produk yang Diulas -->
        <div class="p-4">
            <h3 class="text-[#4871AD] font-medium mb-3">Produk yang Diulas</h3>
            <div class="grid grid-cols-2 gap-3">
                <!-- Product 1 -->
                <div class="bg-[#4871AD] rounded overflow-hidden text-white">
                    <div class="p-2 flex items-start">
                        <div class="w-10 h-10 bg-white rounded flex items-center justify-center mr-2">
                            <i class="fas fa-image text-gray-400"></i>
                        </div>
                        <div class="flex-1">
                            <div class="text-sm">Nama Produk</div>
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
                            <div class="text-sm">Nama Produk</div>
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

    <!-- Bottom Navigation -->
    <div class="fixed bottom-0 left-0 right-0 bg-[#4871AD] text-white z-30">
        <div class="max-w-md mx-auto grid grid-cols-4 text-center">
            <!-- Home -->
            <a href="{{ route('homepage.index') }}" class="py-2 flex flex-col items-center relative group">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 24V8L12 0L24 8V24H15V14.7H9V24H0Z" />
                </svg>
                <span class="text-xs font-serif mt-0.5">Home</span>
                <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
            </a>
            
            <!-- Transaction -->
            <a href="#" class="py-2 flex flex-col items-center relative group">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 3H5C3.89 3 3 3.9 3 5V19C3 20.1 3.89 21 5 21H19C20.11 21 21 20.1 21 19V5C21 3.9 20.11 3 19 3ZM9 17H7V10H9V17ZM13 17H11V7H13V17ZM17 17H15V13H17V17Z" />
                </svg>
                <span class="text-xs font-serif mt-0.5">Transaction</span>
                <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
            </a>
            
            <!-- Inbox -->
            <a href="{{ route('customer.inbox') }}" class="py-2 flex flex-col items-center relative group">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 20.9999C2.45 20.9999 1.979 20.8042 1.587 20.4128C1.195 20.0214 0.999333 19.5507 1 18.9999V4.99994C1 4.44994 1.196 3.97894 1.588 3.58694C1.98 3.19494 2.451 2.99928 3 2.99994H21C21.55 2.99994 22.021 3.19594 22.413 3.58794C22.805 3.97994 23.0007 4.45061 23 4.99994V18.9999C23 19.5499 22.804 20.0209 22.412 20.4129C22.02 20.8049 21.5493 21.0006 21 20.9999H3ZM12 13.9999C12.283 13.9999 12.521 13.9039 12.713 13.7119C12.905 13.5199 13.0007 13.2826 13 12.9999H21V4.99994H3V12.9999H11C11 13.2839 11.096 13.5219 11.288 13.7139C11.48 13.9059 11.7173 14.0013 12 13.9999Z" />
                </svg>
                <span class="text-xs font-serif mt-0.5">
                    Inbox
                    @if ($notifications->count() >= 0)
                        <span class="ml-1 bg-red-500 text-white px-1 rounded-full text-[10px]">
                            {{ $notifications->count() }}
                        </span>
                    @endif
                </span>
                <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
            </a>
            
            <!-- Account (active) -->
            <a href="{{ route('customer.dashboard') }}" class="py-2 flex flex-col items-center relative group">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 12C10.9 12 9.95833 11.6083 9.175 10.825C8.39167 10.0417 8 9.1 8 8C8 6.9 8.39167 5.95833 9.175 5.175C9.95833 4.39167 10.9 4 12 4C13.1 4 14.0417 4.39167 14.825 5.175C15.6083 5.95833 16 6.9 16 8C16 9.1 15.6083 10.0417 14.825 10.825C14.0417 11.6083 13.1 12 12 12ZM18 20H6C5.45 20 4.97933 19.8043 4.588 19.413C4.19667 19.0217 4.00067 18.5507 4 18V17.2C4 16.6333 4.146 16.1123 4.438 15.637C4.73 15.1617 5.11733 14.7993 5.6 14.55C6.63333 14.0333 7.68333 13.6457 8.75 13.387C9.81667 13.1283 10.9 12.9993 12 13C13.1 13 14.1833 13.1293 15.25 13.388C16.3167 13.6467 17.3667 14.034 18.4 14.55C18.8833 14.8 19.271 15.1627 19.563 15.638C19.855 16.1133 20.0007 16.634 20 17.2V18C20 18.55 19.8043 19.021 19.413 19.413C19.0217 19.805 18.5507 20.0003 18 20Z" />
                </svg>
                <span class="text-xs font-serif mt-0.5">Account</span>
                <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t opacity-100"></span>
            </a>
        </div>
    </div>
</x-app-layout>