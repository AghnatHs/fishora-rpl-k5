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

    {{-- Bottom Navigation --}}
    <div class="fixed bottom-0 left-0 right-0 bg-[#4871AD] text-white z-30">
        <div class="w-full grid grid-cols-4 text-center">
            <!-- Home -->
            <a href="{{ route('homepage.index') }}" class="flex-1 flex flex-col items-center justify-center py-2 relative group">
                <!-- SVG dan label -->
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 21C5.45 21 4.97933 20.8043 4.588 20.413C4.19667 20.0217 4.00067 19.5507 4 19V10C4 9.71667 4.075 9.45 4.225 9.2C4.375 8.95 4.58333 8.75 4.85 8.6L11.85 4.6C12.0167 4.5 12.1917 4.42067 12.375 4.362C12.5583 4.30333 12.75 4.274 12.95 4.274C13.15 4.274 13.3417 4.30333 13.525 4.362C13.7083 4.42067 13.8833 4.5 14.05 4.6L21.05 8.6C21.3167 8.75 21.525 8.95 21.675 9.2C21.825 9.45 21.9 9.71667 21.9 10V19C21.9 19.55 21.7043 20.021 21.313 20.413C20.9217 20.805 20.4507 21.0003 19.9 21H14V14H10V21H6Z" />
                </svg>
                <span class="text-xs font-serif mt-0.5">Home</span>
                <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
            </a>
            
            <!-- Transactions -->
            <a href="{{ route('customer.transactions') }}" class="flex-1 flex flex-col items-center justify-center py-2 relative group">
                <!-- SVG dan label -->
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 22H5C4.45 22 3.979 21.8043 3.587 21.413C3.195 21.0217 2.99933 20.5507 3 20V6C3 5.45 3.196 4.979 3.588 4.587C3.98 4.195 4.45067 3.99933 5 4H19C19.55 4 20.021 4.196 20.413 4.588C20.805 4.98 21.0007 5.45067 21 6V20C21 20.55 20.8043 21.021 20.413 21.413C20.0217 21.805 19.5507 22.0003 19 22ZM7 6C6.716 6 6.479 6.096 6.287 6.288C6.095 6.48 5.99967 6.71733 6 7C6 7.283 6.096 7.521 6.288 7.713C6.48 7.905 6.71733 8.001 7 8C7.283 8 7.521 7.904 7.713 7.712C7.905 7.52 8.00067 7.28267 8 7C8 6.716 7.904 6.479 7.712 6.287C7.52 6.095 7.28267 5.99967 7 6ZM7 10C6.716 10 6.479 10.096 6.287 10.288C6.095 10.48 5.99967 10.7173 6 11C6 11.283 6.096 11.521 6.288 11.713C6.48 11.905 6.71733 12.001 7 12C7.283 12 7.521 11.904 7.713 11.712C7.905 11.52 8.00067 11.2827 8 11C8 10.716 7.904 10.479 7.712 10.287C7.52 10.095 7.28267 9.99967 7 10ZM7 14C6.716 14 6.479 14.096 6.287 14.288C6.095 14.48 5.99967 14.7173 6 15C6 15.283 6.096 15.521 6.288 15.713C6.48 15.905 6.71733 16.001 7 16C7.283 16 7.521 15.904 7.713 15.712C7.905 15.52 8.00067 15.2827 8 15C8 14.716 7.904 14.479 7.712 14.287C7.52 14.095 7.28267 13.9997 7 14ZM12 8H18V6H12V8ZM12 12H18V10H12V12ZM12 16H18V14H12V16Z" />
                </svg>
                <span class="text-xs font-serif mt-0.5">Transactions</span>
                <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
            </a>
            <!-- Inbox -->
            <a href="{{ route('customer.inbox') }}" class="flex-1 flex flex-col items-center justify-center py-2 relative group">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 20.9999C2.45 20.9999 1.979 20.8042 1.587 20.4128C1.195 20.0214 0.999333 19.5507 1 18.9999V4.99994C1 4.44994 1.196 3.97894 1.588 3.58694C1.98 3.19494 2.451 2.99928 3 2.99994H21C21.55 2.99994 22.021 3.19594 22.413 3.58794C22.805 3.97994 23.0007 4.45061 23 4.99994V18.9999C23 19.5499 22.804 20.0209 22.412 20.4129C22.02 20.8049 21.5493 21.0006 21 20.9999H3ZM12 13.9999C12.283 13.9999 12.521 13.9039 12.713 13.7119C12.905 13.5199 13.0007 13.2826 13 12.9999H21V4.99994H3V12.9999H11C11 13.2839 11.096 13.5219 11.288 13.7139C11.48 13.9059 11.7173 14.0013 12 13.9999Z" />
                </svg>
                <span class="text-xs font-serif mt-0.5">Inbox</span>
                <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
            </a>
            <!-- Account (active) -->
            <a href="{{ route('customer.dashboard') }}" class="flex-1 flex flex-col items-center justify-center py-2 relative group">
                <!-- SVG dan label -->
                <svg class="text-2xl" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 12C10.9 12 9.95833 11.6083 9.175 10.825C8.39167 10.0417 8 9.1 8 8C8 6.9 8.39167 5.95833 9.175 5.175C9.95833 4.39167 10.9 4 12 4C13.1 4 14.0417 4.39167 14.825 5.175C15.6083 5.95833 16 6.9 16 8C16 9.1 15.6083 10.0417 14.825 10.825C14.0417 11.6083 13.1 12 12 12ZM18 20H6C5.45 20 4.97933 19.8043 4.588 19.413C4.19667 19.0217 4.00067 18.5507 4 18V17.2C4 16.6333 4.146 16.1123 4.438 15.637C4.73 15.1617 5.11733 14.7993 5.6 14.55C6.63333 14.0333 7.68333 13.6457 8.75 13.387C9.81667 13.1283 10.9 12.9993 12 13C13.1 13 14.1833 13.1293 15.25 13.388C16.3167 13.6467 17.3667 14.034 18.4 14.55C18.8833 14.8 19.271 15.1627 19.563 15.638C19.855 16.1133 20.0007 16.634 20 17.2V18C20 18.55 19.8043 19.021 19.413 19.413C19.0217 19.805 18.5507 20.0003 18 20Z" />
                </svg>
                <span class="text-xs font-serif mt-0.5">Account</span>
                <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t opacity-100"></span>
            </a>
        </div>
    </div>
</x-app-layout>