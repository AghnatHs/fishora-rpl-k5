<x-app-layout>
    <div class="max-w-md mx-auto bg-white min-h-screen">
        <!-- Header dengan judul dan ikon -->
        <div class="p-4 flex justify-between items-center border-b">
            <h1 class="text-xl font-medium text-[#4871AD]">Akun</h1>
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
                    <img src="{{ Auth::guard('customer')->user()->avatar }}" alt="Profile" class="w-full h-full object-cover">
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

        <!-- Menu Akun - Mengubah layout menu -->
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

    {{-- Menggunakan component bottom navigation --}}
    <x-bottom-nav active="account" />
    <x-bottom-nav active="homepage" />
</x-app-layout>