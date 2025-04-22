<x-app-layout>
    <div class="max-w-md mx-auto p-4 sm:max-w-3xl">

        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <!-- To Homepage -->
            <a href="{{ route('homepage.index') }}"
                class="text-sm text-gray-600 hover:text-black flex items-center space-x-1">
                <i class="fas fa-house text-xl"></i>
            </a>

            <h1 class="text-xl font-semibold">Akun Saya</h1>
            <div class="flex gap-3 text-xl">
                <button><i class="fas fa-comment-dots"></i></button>
            </div>
        </div>
        
        <!-- Profile -->
        <div class="flex items-start space-x-4 mb-4">
            <!-- Avatar -->
            <div class="w-16 h-16 bg-gray-300 rounded-full"></div>

            <!-- Info + Gear -->
            <div class="flex-1">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="font-semibold">{{ Auth::guard('customer')->user()->name }}</p>
                        <p class="text-sm text-gray-600">{{ Auth::guard('customer')->user()->email }}</p>
                    </div>
                    <a href="#" class="text-gray-500 hover:text-gray-800 text-lg">
                        <i class="fas fa-cog"></i>
                    </a>
                </div>
                <form action="{{ route('customer.logout') }}" method="POST" class="mt-2">
                    @csrf
                    <button type="submit"
                        class="w-1/2 bg-red-600 hover:bg-red-700 text-white font-semibold py-1 px-1 rounded-lg shadow transition duration-200 text-sm">
                        Logout
                    </button>
                </form>
            </div>
        </div>


        <!-- Menu Section -->
        <div class="space-y-4">
            <a href="" class="flex items-center gap-2 text-gray-800 hover:text-black">
                <i class="fas fa-receipt"></i>
                <span>Daftar Transaksi</span>
            </a>

            <a href="" class="flex items-center gap-2 text-gray-800 hover:text-black">
                <i class="fas fa-star"></i>
                <span>Ulasan</span>
            </a>
        </div>

    </div>

</x-app-layout>
