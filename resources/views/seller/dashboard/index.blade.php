<x-app-layout>
    <div class="max-w-md mx-auto bg-white pb-16">
        {{-- Header Navbar --}}
        <div class="fixed top-0 left-3 right-3 z-10 bg-white">
            <div class="max-w-md mx-auto flex justify-between items-center p-3">
                <h1 class="text-2xl font-serif font-medium text-[#4871AD]">Toko Saya</h1>
                <div class="flex gap-4">
                    <button
                        class="text-[#4871AD] hover:text-[#7EA3E4] transition-colors duration-300 hover:scale-110 transform">
                        <svg width="20" height="22" viewBox="0 0 61 72" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M32.5269 70.165L32.4859 70.1716L32.2437 70.2871L32.1754 70.3003L32.1277 70.2871L31.8854 70.1683C31.849 70.1595 31.8217 70.1661 31.8035 70.1881L31.7898 70.2211L31.7318 71.6338L31.7489 71.6998L31.783 71.7427L32.1379 71.9869L32.1891 72.0001L32.23 71.9869L32.5849 71.7427L32.6259 71.6899L32.6395 71.6338L32.5815 70.2244C32.5724 70.1892 32.5542 70.1694 32.5269 70.165ZM33.4278 69.792L33.38 69.7986L32.7521 70.1056L32.718 70.1386L32.7078 70.1749L32.7692 71.5942L32.7862 71.6338L32.8135 71.6602L33.4994 71.9638C33.5426 71.9748 33.5756 71.966 33.5984 71.9374L33.612 71.8912L33.496 69.8646C33.4846 69.8228 33.4619 69.7986 33.4278 69.792ZM30.9879 69.7986C30.9729 69.7898 30.9549 69.7869 30.9378 69.7906C30.9206 69.7943 30.9056 69.8043 30.8958 69.8184L30.8753 69.8646L30.7593 71.8912C30.7616 71.9308 30.7809 71.9572 30.8173 71.9704L30.8685 71.9638L31.5544 71.6569L31.5885 71.6305L31.5987 71.5942L31.6602 70.1749L31.6499 70.1353L31.6158 70.1023L30.9879 69.7986Z"
                                fill="currentColor" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6.61366 23.1044C6.61366 16.9768 9.13025 11.1001 13.6098 6.76713C18.0894 2.43421 24.1649 0 30.5 0C36.8351 0 42.9106 2.43421 47.3902 6.76713C51.8698 11.1001 54.3863 16.9768 54.3863 23.1044V35.528L60.6036 47.5555C60.8898 48.1091 61.025 48.7243 60.9962 49.3426C60.9675 49.9609 60.7758 50.5618 60.4393 51.0883C60.1029 51.6148 59.6329 52.0494 59.074 52.3507C58.5151 52.6521 57.8858 52.8102 57.2459 52.8101H43.7194C42.9604 55.6429 41.2503 58.1516 38.8577 59.9426C36.4651 61.7335 33.5254 62.7052 30.5 62.7052C27.4746 62.7052 24.5349 61.7335 22.1423 59.9426C19.7497 58.1516 18.0396 55.6429 17.2806 52.8101H3.75412C3.11424 52.8102 2.48495 52.6521 1.92602 52.3507C1.3671 52.0494 0.897105 51.6148 0.560673 51.0883C0.224242 50.5618 0.0325459 49.9609 0.00379209 49.3426C-0.0249617 48.7243 0.110182 48.1091 0.396386 47.5555L6.61366 35.528V23.1044ZM24.5898 52.8101C25.1889 53.8136 26.0504 54.6468 27.0878 55.2262C28.1253 55.8055 29.3021 56.1105 30.5 56.1105C31.6979 56.1105 32.8747 55.8055 33.9122 55.2262C34.9496 54.6468 35.8112 53.8136 36.4102 52.8101H24.5898ZM30.5 6.60127C25.975 6.60127 21.6353 8.33999 18.4356 11.4349C15.2359 14.5299 13.4383 18.7275 13.4383 23.1044V35.528C13.4383 36.5523 13.1918 37.5625 12.7183 38.4788L8.72589 46.2089H52.2775L48.2851 38.4788C47.8105 37.5628 47.5628 36.5526 47.5617 35.528V23.1044C47.5617 18.7275 45.7641 14.5299 42.5644 11.4349C39.3647 8.33999 35.025 6.60127 30.5 6.60127Z"
                                fill="currentColor" />
                        </svg>
                    </button>
                    <button
                        class="text-[#4871AD] hover:text-[#7EA3E4] transition-colors duration-300 hover:scale-110 transform">
                        <svg width="20" height="20" viewBox="0 0 70 66" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14 39.6H42V33H14V39.6ZM14 29.7H56V23.1H14V29.7ZM14 19.8H56V13.2H14V19.8ZM0 66V6.6C0 4.785 0.686 3.2318 2.058 1.9404C3.43 0.649 5.07733 0.0022 7 0H63C64.925 0 66.5735 0.6468 67.9455 1.9404C69.3175 3.234 70.0023 4.7872 70 6.6V46.2C70 48.015 69.3152 49.5693 67.9455 50.8629C66.5758 52.1565 64.9273 52.8022 63 52.8H14L0 66ZM11.025 46.2H63V6.6H7V49.9125L11.025 46.2Z"
                                fill="currentColor" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="h-8"></div>

        {{-- Profile section --}}
        <div class="px-0 py-4">
            <div class="flex items-start">
                <div class="w-19 h-19 bg-[#4871AD] rounded-full mr-3 flex items-center justify-center text-white">
                    <i class="fas fa-user text-2xl"></i>
                </div>
                <div class="flex-1">
                    <p class="font-serif font-medium text-[#4871AD] text-lg">
                        {{ Auth::guard('seller')->user()->shop_name }}</p>
                    <p class="font-serif text-sm text-gray-500">{{ Auth::guard('seller')->user()->email }}</p>
                    <button onclick="document.getElementById('logout-form').submit();"
                        class="mt-0.5 -ml-1.5 text-red-600 hover:text-red-800 hover:bg-red-50 rounded transition-colors duration-300 px-2 py-1 font-serif text-sm font-medium flex items-center">
                        <i class="fas fa-sign-out-alt mr-1"></i> Keluar
                    </button>
                </div>
                <a href="{{ route('seller.profile') }}"
                    class="ml-auto text-[#4871AD] hover:text-[#7EA3E4] transition-colors duration-300 hover:scale-110 transform inline-block">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path
                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                        </path>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Status Pesanan --}}
        <div class="px-0 mb-4">
            <div class="border border-[#4871AD] rounded-lg p-3">
                <h2 class="text-base font-serif text-[#4871AD] mb-2">Status Pesanan</h2>
                <div class="grid grid-cols-3 gap-2 text-center">
                    <div
                        class="bg-[#4871AD] text-white rounded-md p-2 transition-all duration-300 hover:bg-[#5A83BF] hover:scale-105 hover:shadow-md cursor-pointer">
                        <p class="text-lg font-bold font-serif">0</p>
                        <p class="text-xs font-serif">Perlu dikirim</p>
                    </div>
                    <div
                        class="bg-[#4871AD] text-white rounded-md p-2 transition-all duration-300 hover:bg-[#5A83BF] hover:scale-105 hover:shadow-md cursor-pointer">
                        <p class="text-lg font-bold font-serif">0</p>
                        <p class="text-xs font-serif">Pembatalan</p>
                    </div>
                    <div
                        class="bg-[#4871AD] text-white rounded-md p-2 transition-all duration-300 hover:bg-[#5A83BF] hover:scale-105 hover:shadow-md cursor-pointer">
                        <p class="text-lg font-bold font-serif">0</p>
                        <p class="text-xs font-serif">Selesai</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Menu --}}
        <div class="px-0 mb-4">
            <div class="border border-[#4871AD] rounded-lg p-2">
                <div class="grid grid-cols-3 gap-1 text-center">
                    <a href="{{ route('seller.products.index') }}" class="flex flex-col items-center group">
                        <div
                            class="w-10 h-10 text-[#4871AD] group-hover:text-[#7EA3E4] mb-0.5 flex items-center justify-center transition-colors duration-300">
                            <svg width="24" height="24" viewBox="0 0 87 83" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-8 h-8 group-hover:scale-110 transition-transform duration-300">
                                <path
                                    d="M86.4167 0.875H0.583374V26.625H4.87504V73.8333C4.87504 76.1098 5.77935 78.293 7.38904 79.9027C8.99873 81.5124 11.1819 82.4167 13.4584 82.4167H73.5417C75.8182 82.4167 78.0014 81.5124 79.611 79.9027C81.2207 78.293 82.125 76.1098 82.125 73.8333V26.625H86.4167V0.875ZM9.16671 9.45833H77.8334V18.0417H9.16671V9.45833ZM73.5417 73.8333H13.4584V26.625H73.5417V73.8333ZM30.625 35.2083H56.375C56.375 37.4848 55.4707 39.668 53.861 41.2777C52.2514 42.8874 50.0682 43.7917 47.7917 43.7917H39.2084C36.9319 43.7917 34.7487 42.8874 33.139 41.2777C31.5294 39.668 30.625 37.4848 30.625 35.2083Z" />
                            </svg>
                        </div>
                        <p
                            class="text-xs font-serif text-[#4871AD] group-hover:text-[#7EA3E4] leading-tight transition-colors duration-300">
                            Produk</p>
                    </a>
                    <a href="" class="flex flex-col items-center group">
                        <div
                            class="w-10 h-10 text-[#4871AD] group-hover:text-[#7EA3E4] mb-0.5 flex items-center justify-center transition-colors duration-300">
                            <svg width="24" height="24" viewBox="0 0 83 79" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-8 h-8 group-hover:scale-110 transition-transform duration-300">
                                <path
                                    d="M78.125 65.25V69.5417C78.125 71.8181 77.2207 74.0013 75.611 75.611C74.0013 77.2207 71.8181 78.125 69.5417 78.125H9.45833C7.18189 78.125 4.99869 77.2207 3.389 75.611C1.77931 74.0013 0.875 71.8181 0.875 69.5417V9.45833C0.875 7.18189 1.77931 4.99869 3.389 3.389C4.99869 1.77931 7.18189 0.875 9.45833 0.875H69.5417C71.8181 0.875 74.0013 1.77931 75.611 3.389C77.2207 4.99869 78.125 7.18189 78.125 9.45833V13.75H39.5C37.2236 13.75 35.0404 14.6543 33.4307 16.264C31.821 17.8737 30.9167 20.0569 30.9167 22.3333V56.6667C30.9167 58.9431 31.821 61.1263 33.4307 62.736C35.0404 64.3457 37.2236 65.25 39.5 65.25M39.5 56.6667H82.4167V22.3333H39.5M56.6667 45.9375C54.9593 45.9375 53.3219 45.2593 52.1147 44.052C50.9074 42.8447 50.2292 41.2073 50.2292 39.5C50.2292 37.7927 50.9074 36.1553 52.1147 34.948C53.3219 33.7407 54.9593 33.0625 56.6667 33.0625C58.374 33.0625 60.0114 33.7407 61.2187 34.948C62.4259 36.1553 63.1042 37.7927 63.1042 39.5C63.1042 41.2073 62.4259 42.8447 61.2187 44.052C60.0114 45.2593 58.374 45.9375 56.6667 45.9375Z" />
                            </svg>
                        </div>
                        <p
                            class="text-xs font-serif text-[#4871AD] group-hover:text-[#7EA3E4] leading-tight transition-colors duration-300">
                            Keuangan</p>
                    </a>
                    <a href="" class="flex flex-col items-center group">
                        <div
                            class="w-10 h-10 text-[#4871AD] group-hover:text-[#7EA3E4] mb-0.5 flex items-center justify-center transition-colors duration-300">
                            <svg width="24" height="24" viewBox="0 0 84 84" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-8 h-8 group-hover:scale-110 transition-transform duration-300">
                                <path
                                    d="M41.7916 66.9997C43.25 66.9997 44.4833 66.4955 45.4916 65.4872C46.5 64.4789 47.0028 63.2469 47 61.7914C46.9972 60.3358 46.4944 59.1025 45.4916 58.0914C44.4889 57.0802 43.2555 56.5775 41.7916 56.583C40.3278 56.5886 39.0958 57.0927 38.0958 58.0955C37.0958 59.0983 36.5916 60.3302 36.5833 61.7914C36.575 63.2525 37.0791 64.4858 38.0958 65.4914C39.1125 66.4969 40.3444 66.9997 41.7916 66.9997ZM38.0416 50.958H45.75C45.75 48.6664 46.0111 46.8608 46.5333 45.5414C47.0555 44.2219 48.5305 42.4164 50.9583 40.1247C52.7639 38.3191 54.1875 36.5997 55.2291 34.9664C56.2708 33.333 56.7916 31.3719 56.7916 29.083C56.7916 25.1941 55.368 22.208 52.5208 20.1247C49.6736 18.0414 46.3055 16.9997 42.4166 16.9997C38.4583 16.9997 35.2472 18.0414 32.7833 20.1247C30.3194 22.208 28.6 24.708 27.625 27.6247L34.5 30.333C34.8472 29.083 35.6291 27.7289 36.8458 26.2705C38.0625 24.8122 39.9194 24.083 42.4166 24.083C44.6389 24.083 46.3055 24.6914 47.4166 25.908C48.5278 27.1247 49.0833 28.4608 49.0833 29.9164C49.0833 31.3053 48.6666 32.608 47.8333 33.8247C47 35.0414 45.9583 36.1691 44.7083 37.208C41.6528 39.9164 39.7778 41.965 39.0833 43.3539C38.3889 44.7427 38.0416 47.2775 38.0416 50.958ZM42 83.6664C36.2361 83.6664 30.8194 82.5733 25.75 80.3872C20.6805 78.2011 16.2708 75.2316 12.5208 71.4789C8.77082 67.7261 5.80276 63.3164 3.61665 58.2497C1.43054 53.183 0.336096 47.7664 0.333318 41.9997C0.33054 36.233 1.42499 30.8164 3.61665 25.7497C5.80832 20.683 8.77637 16.2733 12.5208 12.5205C16.2653 8.76775 20.675 5.7997 25.75 3.61636C30.825 1.43303 36.2416 0.338584 42 0.333029C47.7583 0.327473 53.175 1.42192 58.25 3.61636C63.325 5.81081 67.7347 8.77886 71.4792 12.5205C75.2236 16.2622 78.193 20.6719 80.3875 25.7497C82.5819 30.8275 83.675 36.2441 83.6666 41.9997C83.6583 47.7552 82.5639 53.1719 80.3833 58.2497C78.2028 63.3275 75.2347 67.7372 71.4792 71.4789C67.7236 75.2205 63.3139 78.19 58.25 80.3872C53.1861 82.5844 47.7694 83.6775 42 83.6664Z" />
                            </svg>
                        </div>
                        <p
                            class="text-xs font-serif text-[#4871AD] group-hover:text-[#7EA3E4] leading-tight transition-colors duration-300">
                            Pusat Bantuan</p>
                    </a>
                </div>
            </div>
        </div>

        {{-- Produk Toko --}}
        <div class="px-0">
            <div class="border border-[#4871AD] p-2">
                <h2 class="text-base font-serif font-medium text-[#4871AD] mb-2">Tampilan Produk di Toko</h2>
                <div class="grid grid-cols-2 gap-2">
                    @forelse ($products as $product)
                        <a href="{{ route('seller.products.show', $product) }}"
                            class="block transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                            <div class="border border-[#4871AD] rounded-lg overflow-hidden">
                                <div class="aspect-square bg-[#ABCDFF] overflow-hidden">
                                    <img src="{{ Storage::url($product->image_cover) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                                </div>
                                <div class="p-1.5">
                                    <p class="text-xs font-medium font-serif text-[#4871AD] truncate">
                                        {{ $product->name }}</p>
                                    <p class="text-xs font-serif text-gray-600">
                                        Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="border border-[#4871AD] rounded-lg text-center py-6 col-span-2">
                            <i class="fas fa-box-open text-3xl mb-1 text-[#4871AD]"></i>
                            <p class="text-sm font-medium font-serif text-[#4871AD]">Belum ada produk</p>
                            <p class="text-xs font-serif">Yuk tambahkan produk pertamamu sekarang!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Bottom Navigation --}}
        <div class="fixed bottom-0 left-0 right-0 bg-[#4871AD] text-white">
            <div class="max-w-md mx-auto grid grid-cols-2 text-center">

                {{-- Link ke Dashboard --}}
                <a href="{{ route('seller.dashboard') }}" class="py-2 flex flex-col items-center relative group">
                    <svg width="24" height="24" viewBox="0 0 99 99" fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg"
                        class="group-hover:scale-110 transition-transform duration-300">
                        <path d="M0 99V33L49.5 0L99 33V99H61.875V60.5H37.125V99H0Z" />
                    </svg>
                    <span class="text-xs font-serif mt-0.5">Toko</span>
                    <span
                        class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t
                {{ Route::is('seller.dashboard') ? 'opacity-100' : 'opacity-0' }}
                group-hover:opacity-100 transition-opacity duration-300"></span>
                </a>

                {{-- Link ke Inbox --}}
                <a href="{{ route('seller.inbox') }}" class="py-2 flex flex-col items-center relative group">
                    <svg width="24" height="24" viewBox="0 0 99 99" fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg"
                        class="group-hover:scale-110 transition-transform duration-300">
                        <path
                            d="M11 99C7.975 99 5.38633 97.9238 3.234 95.7715C1.08167 93.6192 0.00366667 91.0287 0 88V11C0 7.975 1.078 5.38633 3.234 3.234C5.39 1.08167 7.97867 0.00366667 11 0H88C91.025 0 93.6155 1.078 95.7715 3.234C97.9275 5.39 99.0037 7.97867 99 11V88C99 91.025 97.9238 93.6155 95.7715 95.7715C93.6192 97.9275 91.0287 99.0037 88 99H11ZM49.5 71.5C52.9833 71.5 56.1458 70.4917 58.9875 68.475C61.8292 66.4583 63.8 63.8 64.9 60.5H88V11H11V60.5H34.1C35.2 63.8 37.1708 66.4583 40.0125 68.475C42.8542 70.4917 46.0167 71.5 49.5 71.5Z" />
                    </svg>
                    <span class="text-xs font-serif mt-0.5">
                        Inbox
                        @if ($notifications->count() > 0)
                            <span class="ml-1 bg-red-500 text-white px-1 rounded-full text-[10px]">
                                {{ $notifications->count() }}
                            </span>
                        @endif
                    </span>
                    <span
                        class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t
                {{ Route::is('seller.inbox') ? 'opacity-100' : 'opacity-0' }}
                group-hover:opacity-100 transition-opacity duration-300"></span>
                </a>
            </div>
        </div>

        <form action="{{ route('seller.logout') }}" method="POST" id="logout-form" class="hidden">
            @csrf
        </form>
    </div>
</x-app-layout>
