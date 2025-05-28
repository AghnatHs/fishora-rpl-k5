<x-app-layout>
    <div class="max-w-md mx-auto bg-white pb-16">
        {{-- Header with back button --}}
        <div class="fixed top-0 left-0 right-0 z-30 bg-white pb-2">
            <div class="max-w-md mx-auto flex items-center justify-between p-2 px-4">
                <div class="flex items-center">
                    <a href="{{ route('seller.dashboard') }}" class="mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="#4871AD" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                    </a>
                    <h1 class="text-2xl font-serif font-medium text-[#4871AD]">Atur Profil Toko</h1>
                </div>
                <div>
                    <button type="button" class="text-[#4871AD]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="pt-16 px-1">
            <div class=" -mt-7 mb-6">
                @include('components.modals.status')
                @include('components.modals.errors')
            </div>

            <!-- Avatar Section -->
            <div class="flex flex-col items-center mb-8 -mt-5">
                <div class="w-20 h-20 bg-[#4871AD] rounded-full flex items-center justify-center text-white mb-2">
                    <i class="fas fa-user text-2xl"></i>
                </div>
                <p class="text-[#4871AD] font-serif text-sm">Ubah foto profil toko</p>
            </div>

            <form action="{{ route('seller.profile.update') }}" method="POST" class="-mt-2">
                @csrf

                <!-- Info Toko -->
                <div class="mb-6">
                    <h2 class="text-lg text-[#4871AD] font-serif mb-3">Info Toko</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="shop_name" class="block text-sm font-serif text-gray-600 mb-1">Nama Toko</label>
                            <input type="text" name="shop_name" id="shop_name" 
                                value="{{ old('shop_name', $seller->shop_name) }}" 
                                class="w-full p-2.5 rounded-lg border border-[#4871AD] text-[#4871AD] font-serif text-base focus:ring-[#4871AD] focus:border-[#4871AD]">
                        </div>

                        <!-- Alamat Toko (Sesuai struktur DB) -->
                        <div>
                            <label for="address_street" class="block text-sm font-serif text-gray-600 mb-1">Alamat Toko</label>
                            <input type="text" name="address_street" id="address_street" 
                                value="{{ old('address_street', $seller->address_street) }}" 
                                class="w-full p-2.5 rounded-lg border border-[#4871AD] text-[#4871AD] font-serif text-base focus:ring-[#4871AD] focus:border-[#4871AD]">
                        </div>
                        
                        <div>
                            <label for="address_city" class="block text-sm font-serif text-gray-600 mb-1">Kota</label>
                            <input type="text" name="address_city" id="address_city" 
                                value="{{ old('address_city', $seller->address_city) }}" 
                                class="w-full p-2.5 rounded-lg border border-[#4871AD] text-[#4871AD] font-serif text-base focus:ring-[#4871AD] focus:border-[#4871AD]">
                        </div>
                        
                        <div>
                            <label for="address_province" class="block text-sm font-serif text-gray-600 mb-1">Provinsi</label>
                            <input type="text" name="address_province" id="address_province" 
                                value="{{ old('address_province', $seller->address_province) }}" 
                                class="w-full p-2.5 rounded-lg border border-[#4871AD] text-[#4871AD] font-serif text-base focus:ring-[#4871AD] focus:border-[#4871AD]">
                        </div>
                        
                        <div>
                            <label for="address_zipcode" class="block text-sm font-serif text-gray-600 mb-1">Kode Pos</label>
                            <input type="text" name="address_zipcode" id="address_zipcode" 
                                value="{{ old('address_zipcode', $seller->address_zipcode) }}" 
                                class="w-full p-2.5 rounded-lg border border-[#4871AD] text-[#4871AD] font-serif text-base focus:ring-[#4871AD] focus:border-[#4871AD]">
                        </div>
                    </div>
                </div>

                <!-- Info Pribadi Toko -->
                <div class="mb-8">
                    <h2 class="text-lg text-[#4871AD] font-serif mb-3">Info Pribadi Toko</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="email" class="block text-sm font-serif text-gray-600 mb-1">Email</label>
                            <input type="email" name="email" id="email" 
                                value="{{ old('email', $seller->email) }}" 
                                class="w-full p-2.5 rounded-lg border border-[#4871AD] text-[#4871AD] font-serif text-base focus:ring-[#4871AD] focus:border-[#4871AD]">
                        </div>
                        
                        <div>
                            <label for="telephone" class="block text-sm font-serif text-gray-600 mb-1">No. Telepon</label>
                            <input type="text" name="telephone" id="telephone" 
                                value="{{ old('telephone', $seller->telephone) }}" 
                                class="w-full p-2.5 rounded-lg border border-[#4871AD] text-[#4871AD] font-serif text-base focus:ring-[#4871AD] focus:border-[#4871AD]">
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-[#4871AD] text-white font-serif py-2.5 rounded-md hover:bg-[#3a5a8a] transition duration-200">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</x-app-layout>