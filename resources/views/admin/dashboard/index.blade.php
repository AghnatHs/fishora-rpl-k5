<x-app-layout>

    <div class="max-w-md mx-auto p-4 sm:max-w-3xl">
        <div>
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

            <div class="border-t border-gray-100 space-y-4">
                <a href="{{ route('admin.dashboard.overview') }}"
                    class="w-max flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-lg font-medium rounded transition duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.429 9.75 2.25 12l4.179 2.25m0-4.5 5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0 4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0-5.571 3-5.571-3" />
                    </svg>
                    Overview
                </a>
                <a href="{{ route('admin.dashboard.seller-verification') }}"
                    class="w-max flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-lg font-medium rounded transition duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                    </svg>
                    Verifikasi Penjual
                </a>
                <a href="{{ route('admin.dashboard.products-monitoring') }}"
                    class="w-max flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-lg font-medium rounded transition duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11 4a7 7 0 1 1 0 14 7 7 0 0 1 0-14zM21 21l-4.35-4.35" />
                    </svg>
                    Monitoring Produk
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
