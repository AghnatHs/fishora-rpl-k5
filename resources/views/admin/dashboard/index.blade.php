<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <div class="max-w-md mx-auto bg-white pb-16">
        {{-- Header Navbar --}}
        <div class="fixed top-0 left-4 right-4 z-10 bg-white">
            <div class="max-w-md mx-auto flex justify-between items-center p-3">
                <h1 class="text-2xl font-serif font-medium text-[#4871AD]">Admin Dashboard</h1>
            </div>
        </div>

        <div class="h-8"></div>

        {{-- Admin Info --}}
        <div class="px-2 py-4">
            <div class="flex items-start bg-gradient-to-br from-white to-[#EBF1FA] rounded-lg p-4 shadow-md animate__animated animate__fadeIn" style="box-shadow: 0 6px 12px -1px rgba(72, 113, 173, 0.2), 0 4px 8px -1px rgba(72, 113, 173, 0.12);">
                <div class="flex-1">
                    <p class="font-serif text-xl animate__animated animate__fadeIn animate__delay-100ms">
                            Selamat datang, <span class="font-medium text-[#4871AD]">{{ Auth::guard('admin')->user()->name }}</span>
                    </p>
                    
                    <p class="text-gray-500 font-serif animate__animated animate__fadeIn animate__delay-300ms">
                        {{ Auth::guard('admin')->user()->email }}
                    </p>
                    
                    <button onclick="document.getElementById('admin-logout-form').submit();"
                        class="mt-2 -ml-1.5 text-red-600 animate__animated animate__fadeIn animate__delay-500ms hover:text-red-800 hover:bg-red-50 rounded transition-all duration-300 px-2 py-1 font-serif text-sm flex items-center hover:scale-105">
                        <i class="fas fa-sign-out-alt mr-1"></i> Keluar
                    </button>
                    
                    <form action="{{ route('admin.logout') }}" method="POST" id="admin-logout-form" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        
        {{-- Navigation Menu --}}
        <div class="px-2 space-y-3">
            <h2 class="font-serif text-lg font-medium text-gray-700 mb-3 ">Dashboard Menu</h2>
            <a href="{{ route('admin.dashboard.overview') }}"
                class="block w-full border border-[#4871AD] text-[#4871AD] hover:bg-[#EBF1FA] rounded-md p-3 transition duration-150">
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="size-7">
                        <path fill="currentColor" d="M13 9V3h8v6zM3 13V3h8v10zm10 8V11h8v10zM3 21v-6h8v6zm2-10h4V5H5zm10 8h4v-6h-4zm0-12h4V5h-4zM5 19h4v-2H5zm4-2"/>
                    </svg>
                    <span class="font-serif text-lg">Overview</span>
                </div>
            </a>
            
            <a href="{{ route('admin.dashboard.seller-verification') }}"
                class="block w-full border border-[#4871AD] text-[#4871AD] hover:bg-[#EBF1FA] rounded-md p-3 transition duration-150">
                <div class="flex items-center gap-3">
                    <i class="fa-regular fa-address-card text-[#4871AD] text-2xl w-6 h-6 flex items-center justify-center"></i>
                    <span class="font-serif text-lg ml-1">Verifikasi Penjual</span>
                </div>
            </a>
            
            <a href="{{ route('admin.dashboard.products-monitoring') }}"
                class="block w-full border border-[#4871AD] text-[#4871AD] hover:bg-[#EBF1FA] rounded-md p-3 transition duration-150">
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                    </svg>
                    <span class="font-serif text-lg mr-1">Monitoring Harga</span>
                </div>
            </a>
        </div>
    </div>
</x-app-layout>