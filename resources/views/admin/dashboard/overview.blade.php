<x-app-layout>

    <div class="max-w-md mx-auto p-4 sm:max-w-3xl">
        <div>
            <!-- Back button -->
            <div class="p-4">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-arrow-left text-xl"></i>
                </a>
            </div>

            <h2 class="text-2xl font-semibold text-gray-800 mb-4">
                Welcome, {{ Auth::guard('admin')->user()->name }}!
            </h2>

            <div class="space-y-2 text-gray-700 mb-6">
                <p><span class="font-medium">Email:</span> {{ Auth::guard('admin')->user()->email }}
                <form action="{{ route('admin.logout') }}" method="POST" class="mt-6">
                    @csrf
                    <button type="submit"
                        class="w-max bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition duration-200">
                        Logout
                    </button>
                </form>
                </p>
            </div>

            <div class="px-0">
                <h3 class="text-base/7 font-semibold text-gray-900">Total Penjual</h3>
                <p class="mt-1 max-w-2xl text-sm/6 text-gray-500">{{ $sellerTotal }}</p>
            </div>
            <div class="px-0">
                <h3 class="text-base/7 font-semibold text-gray-900">Penjual Terverifikasi</h3>
                <p class="mt-1 max-w-2xl text-sm/6 text-gray-500">{{ $sellerVerifiedTotal }}</p>
            </div>
            <div class="px-0">
                <h3 class="text-base/7 font-semibold text-gray-900">Menunggu Verifikasi</h3>
                <p class="mt-1 max-w-2xl text-sm/6 text-gray-500">{{ $sellerUnverifiedTotal }}</p>
            </div>
            <div class="px-0">
                <h3 class="text-base/7 font-semibold text-gray-900">Total Produk</h3>
                <p class="mt-1 max-w-2xl text-sm/6 text-gray-500">0</p>
            </div>

        </div>
    </div>
</x-app-layout>
