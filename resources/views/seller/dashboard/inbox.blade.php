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

                {{-- Notifications --}}
                <div class="mt-6 font-serif">
                    <h2 class="text-lg text-[#4871AD] mb-3">Notifications</h2>

                    @forelse ($notifications as $notification)
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md shadow-sm mb-3">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-sm text-gray-800">
                                        {{ $notification->data['message'] }}
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $notification->created_at }}
                                    </p>
                                </div>

                                <form action="#" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="text-xs text-blue-600 hover:underline">Mark as read</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No new notifications</p>
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

    </div>
</x-app-layout>
