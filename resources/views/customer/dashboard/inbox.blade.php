<x-app-layout class="font-serif">
    <div class="bg-white min-h-screen flex">

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen px-0 md:px-16 py-0 md:pt-4 md:pb-12">
            <!-- Top Navbar Desktop & Mobile -->
            <div class="sticky top-0 z-20 w-full bg-white border-b border-gray-200">
                <div class="hidden md:flex items-center justify-center px-4 md:px-16 py-4">
                    <h1 class="text-2xl md:text-3xl font-medium text-[#4871AD] font-serif">Kotak Masuk</h1>
                </div>
                <div class="flex md:hidden items-center justify-center p-4 bg-white">
                    <h1 class="text-xl font-medium text-[#4871AD] font-serif">Kotak Masuk</h1>
                </div>
            </div>

            <!-- Kategori Tab -->
            <div class="flex w-full bg-[#f5f8fc] border-b border-gray-100 sticky top-[64px] z-10">
                <a href="?tab=notifikasi"
                    class="flex-1 text-center py-3 font-normal text-base transition-colors duration-200 {{ request('tab', 'notifikasi') == 'notifikasi' ? 'text-[#4871AD] border-b-2 border-[#4871AD] bg-white' : 'text-gray-500 hover:text-[#4871AD]' }}"
                    style="font-family: 'DM Serif Text', serif;">
                    Notifikasi
                </a>
                <a href="?tab=chat"
                    class="flex-1 text-center py-3 font-normal text-base transition-colors duration-200 {{ request('tab') == 'chat' ? 'text-[#4871AD] border-b-2 border-[#4871AD] bg-white' : 'text-gray-500 hover:text-[#4871AD]' }}"
                    style="font-family: 'DM Serif Text', serif;">
                    Chat Penjual
                </a>
            </div>

            {{-- Konten utama --}}
            @if (request('tab', 'notifikasi') == 'notifikasi')
            @if ($notifications->isEmpty())
            <div class="flex-1 flex items-start justify-center pt-8 md:pt-12">
                <div class="flex flex-col items-center">
                    <img src="{{ asset('images/notification.svg') }}" alt="Belum Ada Notifikasi"
                        class="w-72 h-72 object-contain mb-4">
                    <p class="text-base font-normal text-gray-600 mt-2" style="font-family: 'DM Serif Text', serif;">
                        Belum Ada Notifikasi</p>
                </div>
            </div>
            @else
            <div class="flex-1 flex flex-col px-4 py-8 space-y-4">
                @foreach ($notifications as $notification)
                <div 
                    x-data="notificationItem({{ $notification->read_at ? 'true' : 'false' }}, '{{ route('customer.notification.read', ['id' => $notification->id]) }}')" 
                @click="open = !open"
                class="cursor-pointer bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md shadow-sm hover:bg-yellow-100 transition">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-800" style="font-family: 'DM Serif Text', serif;">
                                {{ $notification->data['message'] }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1" style="font-family: 'DM Serif Text', serif;">
                                {{ $notification->created_at }}
                            </p>
                        </div>
                        @if(!$notification->read_at)
                            <button @click.stop="markAsRead($event)" class="text-m text-blue-600 hover:underline flex items-center self-center"
                                style="font-family: 'DM Serif Text', serif;">Tandai dibaca</button>
                        @else
                            <span class="text-m text-green-600 flex items-center self-center" style="font-family: 'DM Serif Text', serif;">Sudah dibaca</span>
                        @endif
                    </div>
                    <div x-show="open" x-transition class="mt-2 text-xs text-gray-600"
                        style="font-family: 'DM Serif Text', serif;">
                        @if(isset($notification->data['detail']))
                        <div>
                            <p class="mb-2">{{ $notification->data['detail'] }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @endif
            @elseif(request('tab') == 'chat')
            <div class="flex-1 flex flex-col items-center justify-center py-12">
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 text-[#4871AD] flex items-center justify-center mb-4">
                        <svg width="48" height="48" viewBox="0 0 70 66" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 39.6H42V33H14V39.6ZM14 29.7H56V23.1H14V29.7ZM14 19.8H56V13.2H14V19.8ZM0 66V6.6C0 4.785 0.686 3.2318 2.058 1.9404C3.43 0.649 5.07733 0.0022 7 0H63C64.925 0 66.5735 0.6468 67.9455 1.9404C69.3175 3.234 70.0023 4.7872 70 6.6V46.2C70 48.015 69.3152 49.5693 67.9455 50.8629C66.5758 52.1565 64.9273 52.8022 63 52.8H14L0 66ZM11.025 46.2H63V6.6H7V49.9125L11.025 46.2Z" />
                        </svg>
                    </div>
                    <p class="text-[#4871AD] text-lg font-normal" style="font-family: 'DM Serif Text', serif;">Chat
                        Penjual</p>
                    <p class="text-gray-500 mt-2 text-sm" style="font-family: 'DM Serif Text', serif;">Fitur chat
                        penjual akan segera hadir</p>
                </div>
            </div>
            @endif
            <div class="fixed bottom-0 left-0 right-0 bg-[#4871AD] text-white z-30">
                <div class="w-full max-w-2xl md:max-w-4xl lg:max-w-6xl xl:max-w-7xl mx-auto grid grid-cols-4 text-center">
                    <!-- Home -->
                    <a href="{{ route('homepage.index') }}" class="py-2 flex flex-col items-center relative group">
                        <svg width="24" height="24" viewBox="0 0 99 99" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg"
                            class="group-hover:scale-110 transition-transform duration-300">
                            <path d="M0 99V33L49.5 0L99 33V99H61.875V60.5H37.125V99H0Z" />
                        </svg>
                        <span class="text-xs font-serif mt-0.5" style="font-family: 'DM Serif Text', serif;">Beranda</span>
                        <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t
                            {{ Route::is('homepage.index') ? 'opacity-100' : 'opacity-0' }}
                            group-hover:opacity-100 transition-opacity duration-300"></span>
                    </a>
                    <!-- Transactions -->
                    <a href="{{ route('customer.transactions') }}" class="py-2 flex flex-col items-center relative group">
                        <svg width="24" height="24" viewBox="0 0 99 99" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg"
                            class="group-hover:scale-110 transition-transform duration-300">
                            <path d="M0 99V0L8.25 7.425L16.5 0L24.75 7.425L33 0L41.25 7.425L49.5 0L57.75 7.425L66 0L74.25 7.425L82.5 0L90.75 7.425L99 0V99L90.75 91.575L82.5 99L74.25 91.575L66 99L57.75 91.575L49.5 99L41.25 91.575L33 99L24.75 91.575L16.5 99L8.25 91.575L0 99ZM16.5 74.25H82.5V64.35H16.5V74.25ZM16.5 54.45H82.5V44.55H16.5V54.45ZM16.5 34.65H82.5V24.75H16.5V34.65Z" />
                        </svg>
                        <span class="text-xs font-serif mt-0.5" style="font-family: 'DM Serif Text', serif;">Transaksi</span>
                        <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t
                            {{ Route::is('customer.transactions') ? 'opacity-100' : 'opacity-0' }}
                            group-hover:opacity-100 transition-opacity duration-300"></span>
                    </a>
                    <!-- Inbox -->
                    <a href="{{ route('customer.inbox') }}" class="py-2 flex flex-col items-center relative group">
                        <svg width="24" height="24" viewBox="0 0 99 99" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg"
                            class="group-hover:scale-110 transition-transform duration-300">
                            <path
                                d="M11 99C7.975 99 5.38633 97.9238 3.234 95.7715C1.08167 93.6192 0.00366667 91.0287 0 88V11C0 7.975 1.078 5.38633 3.234 3.234C5.39 1.08167 7.97867 0.00366667 11 0H88C91.025 0 93.6155 1.078 95.7715 3.234C97.9275 5.39 99.0037 7.97867 99 11V88C99 91.025 97.9238 93.6155 95.7715 95.7715C93.6192 97.9275 91.0287 99.0037 88 99H11ZM49.5 71.5C52.9833 71.5 56.1458 70.4917 58.9875 68.475C61.8292 66.4583 63.8 63.8 64.9 60.5H88V11H11V60.5H34.1C35.2 63.8 37.1708 66.4583 40.0125 68.475C42.8542 70.4917 46.0167 71.5 49.5 71.5Z" />
                        </svg>
                        <span class="text-xs font-serif mt-0.5" style="font-family: 'DM Serif Text', serif;">
                            Kotak Masuk
                            @if ($notifications->count() > 0)
                            <span id="notification-counter" class="ml-1 bg-red-500 text-white px-1 rounded-full text-[10px]">
                                {{ $notifications->count() }}
                            </span>
                            @endif
                        </span>
                        <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t
                            {{ Route::is('customer.inbox') ? 'opacity-100' : 'opacity-0' }}
                            group-hover:opacity-100 transition-opacity duration-300"></span>
                    </a>
                    <!-- Account -->
                    <a href="{{ route('customer.dashboard') }}" class="py-2 flex flex-col items-center relative group">
                        <svg width="24" height="24" viewBox="0 0 99 99" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg"
                            class="group-hover:scale-110 transition-transform duration-300">
                            <path d="M49.5 0C56.0641 0 62.3594 2.60758 67.0009 7.24911C71.6424 11.8906 74.25 18.1859 74.25 24.75C74.25 31.3141 71.6424 37.6094 67.0009 42.2509C62.3594 46.8924 56.0641 49.5 49.5 49.5C42.9359 49.5 36.6406 46.8924 31.9991 42.2509C27.3576 37.6094 24.75 31.3141 24.75 24.75C24.75 18.1859 27.3576 11.8906 31.9991 7.24911C36.6406 2.60758 42.9359 0 49.5 0ZM49.5 61.875C76.8488 61.875 99 72.9506 99 86.625V99H0V86.625C0 72.9506 22.1512 61.875 49.5 61.875Z" />
                        </svg>
                        <span class="text-xs font-serif mt-0.5" style="font-family: 'DM Serif Text', serif;">Akun</span>
                        <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t
                            {{ Route::is('customer.dashboard') ? 'opacity-100' : 'opacity-0' }}
                            group-hover:opacity-100 transition-opacity duration-300"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('notificationItem', function(isReadInitial, readUrl) {
                return {
                    open: false,
                    isRead: isReadInitial,
                    markAsRead(event) {
                        if (this.isRead) return;
                        
                        if (event) {
                            event.stopPropagation();
                        }
                        
                        fetch(readUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                _method: 'PATCH'
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                this.isRead = true;
                                
                                // Update notification counter in bottom bar
                                const counter = document.querySelector('#notification-counter');
                                if (counter) {
                                    const count = parseInt(counter.textContent.trim());
                                    if (count > 1) {
                                        counter.textContent = count - 1;
                                    } else {
                                        counter.remove();
                                    }
                                }
                            }
                        });
                    }
                }
            });
        });
    </script>
</x-app-layout>