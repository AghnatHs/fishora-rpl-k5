<x-app-layout class="font-serif">
    <!-- Add x-cloak styles in head -->
    <style>
        [x-cloak] { display: none !important; }
    </style>
    
    <!-- Search Navbar -->
    <div class="fixed -top-1 left-0 right-0 bg-white z-20 py-3 px-6 font-serif">
        <div class="max-w-md mx-auto">
            <form method="GET" action="{{ route('homepage.index') }}" x-data="{ 
                    filterOpen: false, 
                    showAllCategories: false, 
                    selectedCategory: '{{ request('category') }}' 
                }" x-init="$nextTick(() => {filterOpen = false})">
                <!-- Search Input dan Filter -->
                <div class="flex items-center z-30 gap-2 mb-3">
                    <div class="flex-1 relative border-2 border-[#4871AD] rounded-[12px] overflow-hidden bg-[#FFF8F8]">
                        <i class="fas fa-search absolute top-2 left-3 text-[#4871AD]"></i>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search"
                            class="w-full pl-10 pr-3 py-1 border-0 focus:outline-none focus:ring-0 bg-[#FFF8F8] text-[#4871AD] font-serif" />
                    </div>
                    
                    <!-- Filter Button dan Dropdown -->
                    <div class="relative">
                        <button type="button" @click="filterOpen = !filterOpen" 
                            class="bg-[#FFF8F8] border-2 border-[#4871AD] text-[#4871AD] py-1 px-4 rounded-[12px] flex items-center w-[100px] justify-between min-w-[100px]">
                            <span>Filter</span>
                            <div class="flex items-center">
                                <template x-if="selectedCategory">
                                    <i class="fas fa-check-circle ml-1 text-[#4871AD]"></i>
                                </template>
                                <template x-if="!selectedCategory && !filterOpen">
                                    <i class="fas fa-chevron-down ml-1 text-[#4871AD]"></i>
                                </template>
                                <template x-if="!selectedCategory && filterOpen">
                                    <i class="fas fa-chevron-up ml-1 text-[#4871AD]"></i>
                                </template>
                            </div>
                        </button>
                        
                        <!-- Category Dropdown with x-cloak to prevent flashing -->
                        <div x-show="filterOpen" 
                            x-cloak
                            @click.outside="filterOpen = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute right-0 mt-1 bg-[#FFF8F8] border-2 border-[#4871AD] rounded-[12px] z-[100] shadow-lg overflow-hidden flex flex-col" 
                            style="min-width: 220px; max-height: 300px;">
                            
                            <!-- Scrollable area for categories -->
                            <div class="overflow-y-auto flex-1 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-transparent" 
                                 style="max-height: 250px; scrollbar-width: thin; scrollbar-color: #D1D5DB transparent;">
                                <div class="py-1">
                                    <!-- 4 kategori pertama (selalu tampil) -->
                                    @foreach ($categories->take(4) as $category)
                                        <div class="px-4 py-1 text-[#4871AD] hover:bg-gray-50 cursor-pointer flex justify-between items-center"
                                            :class="{ 'bg-gray-50': selectedCategory === '{{ $category->name }}' }"
                                            @click="selectedCategory === '{{ $category->name }}' ? (selectedCategory = '', $refs.categoryInput.value = '') : (selectedCategory = '{{ $category->name }}', $refs.categoryInput.value = '{{ $category->name }}'); filterOpen = false;">
                                            <span>{{ $category->name }}</span>
                                            <template x-if="selectedCategory === '{{ $category->name }}'">
                                                <i class="fas fa-check text-[#4871AD]"></i>
                                            </template>
                                        </div>
                                        <hr class="border-gray-100">
                                    @endforeach
                                    
                                    <!-- Kategori tambahan -->
                                    <div x-show="showAllCategories">
                                        @foreach ($categories->skip(4) as $category)
                                            <div class="px-4 py-1 text-[#4871AD] hover:bg-gray-50 cursor-pointer flex justify-between items-center"
                                                :class="{ 'bg-gray-50': selectedCategory === '{{ $category->name }}' }"
                                                @click="selectedCategory === '{{ $category->name }}' ? (selectedCategory = '', $refs.categoryInput.value = '') : (selectedCategory = '{{ $category->name }}', $refs.categoryInput.value = '{{ $category->name }}'); filterOpen = false;">
                                                <span>{{ $category->name }}</span>
                                                <template x-if="selectedCategory === '{{ $category->name }}'">
                                                    <i class="fas fa-check text-[#4871AD]"></i>
                                                </template>
                                            </div>
                                            <hr class="border-gray-100">
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Tombol Lainnya/Minimalkan -->
                            <div class="mt-auto px-4 py-1 text-center text-gray-400 hover:bg-gray-50 cursor-pointer border-t border-gray-100 bg-[#FFF8F8] w-full"
                                @click.prevent.stop="showAllCategories = !showAllCategories">
                                <span x-text="showAllCategories ? 'Minimalkan' : 'Lainnya'"></span>
                                <i class="fas" :class="showAllCategories ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Search button dan icons -->
                <div class="flex items-center justify-between z-20">
                    <button type="submit" class="bg-[#4871AD] text-white py-1 px-6 rounded-[12px] font-medium font-serif">
                        Search
                    </button>
                    
                    <div class="flex items-center gap-4">
                        <!-- Chat icon with auth check -->
                        <a href="@auth('customer')
                                  #
                              @else
                                  {{ route('pick-login') }}
                              @endauth">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 2 22 22" fill="#4871AD" class="w-6 h-6">
                                <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/>
                            </svg>
                        </a>
                        
                        <!-- Cart icon with auth check -->
                        <a href="@auth('customer')
                                    {{ route('customer.cart') }}
                                @else
                                    {{ route('pick-login') }}
                                @endauth" class="relative">
                            <i class="fas fa-shopping-cart text-[#4871AD] text-xl"></i>
                            @auth('customer')
                                @if(session('cart_count', 0) > 0)
                                    <span class="absolute -top-1.5 -right-1.5 bg-red-500 text-white text-[12px] rounded-full min-w-[16px] h-[16px] flex items-center justify-center font-medium leading-none px-1">
                                        {{ session('cart_count') }}
                                    </span>
                                @endif
                            @endauth
                        </a>
                    </div>
                </div>
                
                <!-- Hidden input untuk kategori -->
                <input type="hidden" name="category" x-ref="categoryInput" :value="selectedCategory">
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="px-0 -mt-6 max-w-md mx-auto p-4 pt-28 pb-20 font-serif"> 
        <!-- Filter display info -->
        @if (request('search') || request('category'))
            <div class="mb-3">
                <div class="bg-gray-100 rounded-lg px-3 py-2 mb-2 text-[#4871AD] font-serif">
                    @if (request('search') && request('category'))
                        <p class="font-medium">Hasil pencarian produk "{{ request('search') }}" dan kategori "{{ request('category') }}"</p>
                    @elseif (request('search'))
                        <p class="font-medium">Hasil pencarian produk "{{ request('search') }}"</p>
                    @else
                        <p class="font-medium">Hasil filter kategori "{{ request('category') }}"</p>
                    @endif
                    <p class="text-xs mt-1">Terdapat {{ $products->total() }} hasil</p>
                </div>
                <a href="{{ route('homepage.index') }}" class="text-xs text-[#4871AD] font-serif flex items-center">
                    <i class="fas fa-times-circle mr-1"></i> Reset Filter
                </a>
            </div>
        @endif

        <!-- Products grid -->
        <div class="grid grid-cols-2 gap-3">
            @forelse ($products as $product)
                <a href="{{ route('homepage.show-product', compact('product')) }}" class="block relative overflow-visible group">
                    <div class="border border-[#4871AD] rounded-lg overflow-hidden transition-all duration-300 transform group-hover:scale-[1.03] group-hover:shadow-lg group-hover:shadow-blue-100">
                        <div class="aspect-square bg-gray-100 overflow-hidden">
                            <img src="{{ Storage::url($product->image_cover) }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover" />
                        </div>
                        <div class="p-2">
                            <p class="text-sm font-medium text-[#4871AD] font-serif">{{ $product->name }}</p>
                            <p class="text-sm text-[#4871AD] font-serif">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-500 font-serif">{{ $product->seller->shop_name }}</p>
                        </div>
                    </div>
                </a>
            @empty
                <p class="text-gray-500 col-span-2 text-center py-8 font-serif">Tidak ada produk ditemukan.</p>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="flex flex-col items-center mt-8 space-y-2">
            <p class="text-sm text-gray-500">
                Page {{ $products->currentPage() }} of {{ $products->lastPage() }}
            </p>
            {{ $products->links('pagination::tailwind') }}
        </div>
    </div>
    
    <!-- Bottom Navigation -->
    <div class="fixed bottom-0 left-0 right-0 bg-[#4871AD] text-white z-30">
        <div class="max-w-md mx-auto grid grid-cols-{{ auth('customer')->check() ? '4' : '2' }} text-center">
            <!-- Home (no auth check needed) -->
            <a href="{{ route('homepage.index') }}" class="py-2 flex flex-col items-center relative group">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 24V8L12 0L24 8V24H15V14.7H9V24H0Z" />
                </svg>
                <span class="text-xs font-serif mt-0.5">Home</span>
                <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t opacity-100"></span>
            </a>
            
            <!-- Transaction (only shown for customers) -->
            @auth('customer')
            <a href="#" class="py-2 flex flex-col items-center relative group">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 3H5C3.89 3 3 3.9 3 5V19C3 20.1 3.89 21 5 21H19C20.11 21 21 20.1 21 19V5C21 3.9 20.11 3 19 3ZM9 17H7V10H9V17ZM13 17H11V7H13V17ZM17 17H15V13H17V17Z" />
                </svg>
                <span class="text-xs font-serif mt-0.5">Transaction</span>
                <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
            </a>
            @endauth
            
            <!-- Inbox (only shown for customers) -->
            @auth('customer')
            <a href="#" class="py-2 flex flex-col items-center relative group">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 20.9999C2.45 20.9999 1.979 20.8042 1.587 20.4128C1.195 20.0214 0.999333 19.5507 1 18.9999V4.99994C1 4.44994 1.196 3.97894 1.588 3.58694C1.98 3.19494 2.451 2.99928 3 2.99994H21C21.55 2.99994 22.021 3.19594 22.413 3.58794C22.805 3.97994 23.0007 4.45061 23 4.99994V18.9999C23 19.5499 22.804 20.0209 22.412 20.4129C22.02 20.8049 21.5493 21.0006 21 20.9999H3ZM12 13.9999C12.283 13.9999 12.521 13.9039 12.713 13.7119C12.905 13.5199 13.0007 13.2826 13 12.9999H21V4.99994H3V12.9999H11C11 13.2839 11.096 13.5219 11.288 13.7139C11.48 13.9059 11.7173 14.0013 12 13.9999Z" />
                </svg>
                <span class="text-xs font-serif mt-0.5">Inbox</span>
                <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
            </a>
            @endauth
            
            <!-- Account (always visible, with role-based auth) -->
            <a href="@auth('admin')
                        {{ route('admin.dashboard') }}
                    @elseif(auth('seller')->check())
                        {{ route('seller.dashboard') }}
                    @elseif(auth('customer')->check())
                        {{ route('customer.dashboard') }}
                    @else
                        {{ route('pick-login') }}
                    @endauth" class="py-2 flex flex-col items-center relative group">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 12C10.9 12 9.95833 11.6083 9.175 10.825C8.39167 10.0417 8 9.1 8 8C8 6.9 8.39167 5.95833 9.175 5.175C9.95833 4.39167 10.9 4 12 4C13.1 4 14.0417 4.39167 14.825 5.175C15.6083 5.95833 16 6.9 16 8C16 9.1 15.6083 10.0417 14.825 10.825C14.0417 11.6083 13.1 12 12 12ZM18 20H6C5.45 20 4.97933 19.8043 4.588 19.413C4.19667 19.0217 4.00067 18.5507 4 18V17.2C4 16.6333 4.146 16.1123 4.438 15.637C4.73 15.1617 5.11733 14.7993 5.6 14.55C6.63333 14.0333 7.68333 13.6457 8.75 13.387C9.81667 13.1283 10.9 12.9993 12 13C13.1 13 14.1833 13.1293 15.25 13.388C16.3167 13.6467 17.3667 14.034 18.4 14.55C18.8833 14.8 19.271 15.1627 19.563 15.638C19.855 16.1133 20.0007 16.634 20 17.2V18C20 18.55 19.8043 19.021 19.413 19.413C19.0217 19.805 18.5507 20.0003 18 20Z" />
                </svg>
                <span class="text-xs font-serif mt-0.5">Account</span>
                <span class="absolute bottom-0 left-1/4 right-1/4 h-0.5 bg-white rounded-t opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
            </a>
        </div>
    </div>
</x-app-layout>