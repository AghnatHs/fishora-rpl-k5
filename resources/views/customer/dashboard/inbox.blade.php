<x-app-layout class="font-serif">
    <div class="max-w-md mx-auto bg-white min-h-screen pb-20">
        {{-- Header Navbar --}}
        <div class="fixed top-0 left-3 right-3 z-10 bg-white">
            <div class="max-w-md mx-auto flex justify-between items-center p-3">
                <h1 class="text-2xl font-serif font-medium text-[#4871AD]">Inbox</h1>
            </div>
        </div>

        <div class="h-8"></div>

        @include('components.modals.status')
        @include('components.modals.errors')

        {{-- Inbox Menu --}}
        <div class="px-3 pt-6">
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
                        <p class="text-[#4871AD] font-serif font-medium">Chat Penjual</p>
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

                                <form action="{{ route('customer.notification.read', ['id' => $notification->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="text-m text-blue-600 hover:underline">Mark as read</button>
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
        <div class="fixed bottom-0 left-0 right-0 bg-[#4871AD] text-white z-30">
            <div class="max-w-md mx-auto grid grid-cols-4 text-center">
                {{-- Home --}}
                <a href="{{ route('homepage.index') }}" class="py-2 flex flex-col items-center relative group">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 24V8L12 0L24 8V24H15V14.7H9V24H0Z" />
                    </svg>
                    <span class="text-xs font-serif mt-0.5">Home</span>
                    <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                </a>
                
                {{-- Transaction --}}
                <a href="{{ route('customer.transactions') }}" class="py-2 flex flex-col items-center relative group">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 3H5C3.89 3 3 3.9 3 5V19C3 20.1 3.89 21 5 21H19C20.11 21 21 20.1 21 19V5C21 3.9 20.11 3 19 3ZM9 17H7V10H9V17ZM13 17H11V7H13V17ZM17 17H15V13H17V17Z" />
                    </svg>
                    <span class="text-xs font-serif mt-0.5">Transaction</span>
                    <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                </a>
                
                {{-- Inbox --}}
                <a href="{{ route('customer.inbox') }}" class="py-2 flex flex-col items-center relative group">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 20.9999C2.45 20.9999 1.979 20.8042 1.587 20.4128C1.195 20.0214 0.999333 19.5507 1 18.9999V4.99994C1 4.44994 1.196 3.97894 1.588 3.58694C1.98 3.19494 2.451 2.99928 3 2.99994H21C21.55 2.99994 22.021 3.19594 22.413 3.58794C22.805 3.97994 23.0007 4.45061 23 4.99994V18.9999C23 19.5499 22.804 20.0209 22.412 20.4129C22.02 20.8049 21.5493 21.0006 21 20.9999H3ZM12 13.9999C12.283 13.9999 12.521 13.9039 12.713 13.7119C12.905 13.5199 13.0007 13.2826 13 12.9999H21V4.99994H3V12.9999H11C11 13.2839 11.096 13.5219 11.288 13.7139C11.48 13.9059 11.7173 14.0013 12 13.9999Z" />
                    </svg>
                    <span class="text-xs font-serif mt-0.5">
                        Inbox
                        @if ($notifications->count() > 0)
                            <span class="ml-1 bg-red-500 text-white px-1 rounded-full text-[10px]">
                                {{ $notifications->count() }}
                            </span>
                        @endif
                    </span>
                    <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t opacity-100"></span>
                </a>
                
                {{-- Account --}}
                <a href="{{ route('customer.dashboard') }}" class="py-2 flex flex-col items-center relative group">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 12C10.9 12 9.95833 11.6083 9.175 10.825C8.39167 10.0417 8 9.1 8 8C8 6.9 8.39167 5.95833 9.175 5.175C9.95833 4.39167 10.9 4 12 4C13.1 4 14.0417 4.39167 14.825 5.175C15.6083 5.95833 16 6.9 16 8C16 9.1 15.6083 10.0417 14.825 10.825C14.0417 11.6083 13.1 12 12 12ZM18 20H6C5.45 20 4.97933 19.8043 4.588 19.413C4.19667 19.0217 4.00067 18.5507 4 18V17.2C4 16.6333 4.146 16.1123 4.438 15.637C4.73 15.1617 5.11733 14.7993 5.6 14.55C6.63333 14.0333 7.68333 13.6457 8.75 13.387C9.81667 13.1283 10.9 12.9993 12 13C13.1 13 14.1833 13.1293 15.25 13.388C16.3167 13.6467 17.3667 14.034 18.4 14.55C18.8833 14.8 19.271 15.1627 19.563 15.638C19.855 16.1133 20.0007 16.634 20 17.2V18C20 18.55 19.8043 19.021 19.413 19.413C19.0217 19.805 18.5507 20.0003 18 20Z" />
                    </svg>
                    <span class="text-xs font-serif mt-0.5">Account</span>
                    <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>