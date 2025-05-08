<x-app-layout>
    <div class="max-w-md mx-auto bg-white pb-16">
        {{-- Header Navbar --}}
        <div class="fixed top-0 left-4 right-4 z-10 bg-white">
            <div class="max-w-md mx-auto flex justify-between items-center p-3">
                <h1 class="text-2xl font-serif font-medium text-[#4871AD]">Inbox</h1>
            </div>
        </div>

        <div class="h-8"></div>

        {{-- Inbox Menu --}}
        <div class="px-2">
            <div class="mb-4">
                <a href="#" class="flex items-center py-3 border-b border-gray-100">
                    <div class="w-8 h-8 text-[#4871AD] flex items-center justify-center mr-3">
                        <svg width="24" height="24" viewBox="0 0 70 66" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14 39.6H42V33H14V39.6ZM14 29.7H56V23.1H14V29.7ZM14 19.8H56V13.2H14V19.8ZM0 66V6.6C0 4.785 0.686 3.2318 2.058 1.9404C3.43 0.649 5.07733 0.0022 7 0H63C64.925 0 66.5735 0.6468 67.9455 1.9404C69.3175 3.234 70.0023 4.7872 70 6.6V46.2C70 48.015 69.3152 49.5693 67.9455 50.8629C66.5758 52.1565 64.9273 52.8022 63 52.8H14L0 66ZM11.025 46.2H63V6.6H7V49.9125L11.025 46.2Z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-[#4871AD] font-serif font-medium">Chat Pembeli</p>
                    </div>
                    <div class="text-gray-400">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </a>

                <a href="#" class="flex items-center py-3 border-b border-gray-100">
                    <div class="w-8 h-8 text-[#4871AD] flex items-center justify-center mr-3">
                        <svg width="24" height="24" viewBox="0 0 61 72" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6.61366 23.1044C6.61366 16.9768 9.13025 11.1001 13.6098 6.76713C18.0894 2.43421 24.1649 0 30.5 0C36.8351 0 42.9106 2.43421 47.3902 6.76713C51.8698 11.1001 54.3863 16.9768 54.3863 23.1044V35.528L60.6036 47.5555C60.8898 48.1091 61.025 48.7243 60.9962 49.3426C60.9675 49.9609 60.7758 50.5618 60.4393 51.0883C60.1029 51.6148 59.6329 52.0494 59.074 52.3507C58.5151 52.6521 57.8858 52.8102 57.2459 52.8101H43.7194C42.9604 55.6429 41.2503 58.1516 38.8577 59.9426C36.4651 61.7335 33.5254 62.7052 30.5 62.7052C27.4746 62.7052 24.5349 61.7335 22.1423 59.9426C19.7497 58.1516 18.0396 55.6429 17.2806 52.8101H3.75412C3.11424 52.8102 2.48495 52.6521 1.92602 52.3507C1.3671 52.0494 0.897105 51.6148 0.560673 51.0883C0.224242 50.5618 0.0325459 49.9609 0.00379209 49.3426C-0.0249617 48.7243 0.110182 48.1091 0.396386 47.5555L6.61366 35.528V23.1044Z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-[#4871AD] font-serif font-medium">Notifikasi</p>
                    </div>
                    <div class="text-gray-400">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </a>
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
                    <span class="text-xs font-serif mt-0.5">Inbox</span>
                    <span
                        class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t
                {{ Route::is('seller.inbox') ? 'opacity-100' : 'opacity-0' }}
                group-hover:opacity-100 transition-opacity duration-300"></span>
                </a>
            </div>
        </div>

    </div>
</x-app-layout>
