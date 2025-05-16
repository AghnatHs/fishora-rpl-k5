
<div>
    <!-- Search Input -->
    <div class="relative mb-3">
        <i class="fas fa-search absolute left-3 top-2.5 text-[#4871AD]/60"></i>
        <input type="text" wire:model.live="search" 
            class="w-full pl-9 border border-[#4871AD]/30 rounded-md py-1.5 px-2 text-sm font-serif focus:ring-[#4871AD] focus:border-[#4871AD] focus:outline-none"
            placeholder="Cari nama produk...">
    </div>

    <!-- Produk List-->
    @forelse ($products as $product)
        <div class="bg-white border border-[#4871AD]/20 rounded-md p-3 shadow-sm mb-3 hover:border-[#4871AD]/40 transition-colors relative">
            <!-- Invisible link overlay  -->
            @if($this->tab !== 'deleted')
                <a href="{{ route('seller.products.show', $product) }}" class="absolute inset-0 z-10">
                    <span class="sr-only">View {{ $product->name }}</span>
                </a>
            @endif
            
            <!-- Header dengan Info Utama -->
            <div class="flex space-x-3 mb-2">
                <!-- Gambar Produk -->
                <div class="flex-shrink-0">
                    <img class="w-17 h-17 object-cover rounded border border-[#4871AD]/10" 
                         src="{{ Storage::url($product->image_cover) }}" alt="{{ $product->name }}">
                </div>
                
                <!-- Info Produk -->
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-1.5 flex-wrap">
                        <h3 class="font-semibold text-[#4871AD] font-serif text-base truncate">{{ $product->name }}</h3>
                        
                        <!-- Admin Deletion Badge -->
                        @if($this->tab === 'deleted' && isset($product->deleted_by_admin) && $product->deleted_by_admin === 1)
                            <span class="inline-flex items-center px-1.5 py-0.5 rounded bg-red-100 text-red-600 text-xs font-serif font-medium">
                                <i class="fas fa-user-shield mr-1"></i>
                                Admin
                            </span>
                        @endif
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <p class="text-sm font-serif text-[#4871AD] font-medium">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="text-xs font-serif text-gray-600">Stok: {{ $product->stock }}</p>
                    </div>
                    <div class="flex flex-wrap mt-1 gap-1">
                        @foreach ($product->categories as $category)
                            <span class="bg-[#4871AD]/10 text-[#4871AD] text-xs font-serif px-1.5 py-0.5 rounded">
                                {{ $category->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Info Waktu + Foto -->
            <div class="grid grid-cols-2 gap-2 mb-2">
                <!-- Info Waktu + Status Produk -->
                <div class="text-xs font-serif text-[#4871AD]/70 space-y-1">
                    <p>Dibuat: {{ $product->created_at->format('d/m/Y') }}</p>
                    <p>Diperbarui: {{ $product->updated_at->diffForHumans() }}</p>
                    
                    <!-- Status Peringatan (Baru) -->
                    @if(count($product->warnings) > 0)
                        <div class="mt-1 relative z-20">
                            @if(count($product->warnings->where('status', 'UNRESOLVED')) > 0)
                                <span class="inline-flex items-center px-1.5 py-0.5 rounded bg-red-100 text-red-700 text-xs font-serif cursor-pointer" 
                                    onclick="toggleWarning_{{ $product->id }}()">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    Ada Peringatan ({{ $product->warnings->where('status', 'UNRESOLVED')->count() }})
                                    <i class="fas fa-chevron-down ml-1 text-xs"></i>
                                </span>
                            @else
                                <span class="inline-flex items-center px-1.5 py-0.5 rounded bg-green-100 text-green-700 text-xs font-serif cursor-pointer"
                                    onclick="toggleWarning_{{ $product->id }}()">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Terselesaikan
                                    <i class="fas fa-chevron-down ml-1 text-xs"></i>
                                </span>
                            @endif
                        </div>
                    @else
                        <div class="mt-1">
                            <span class="inline-flex items-center px-1.5 py-0.5 rounded bg-blue-100 text-blue-700 text-xs font-serif">
                                <i class="fas fa-shield-alt mr-1"></i>
                                Tidak Ada Peringatan
                            </span>
                        </div>
                    @endif
                </div>
                
                <!-- Foto Produk - Mini Gallery -->
                <div class="flex flex-col items-end">
                    <p class="text-xs text-[#4871AD] font-medium mb-1 font-serif">Foto Produk</p>
                    <div class="flex flex-wrap gap-1 justify-end">
                        @forelse ($product->images->count() <= 3 ? $product->images : $product->images->take(2) as $image)
                            <img src="{{ Storage::url($image->filepath) }}" alt="Product" class="w-10 h-10 object-cover rounded border border-[#4871AD]/20">
                        @empty
                            <p class="text-xs text-gray-500 italic font-serif">Belum ada foto</p>
                        @endforelse
                        @if($product->images->count() > 3)
                            <span class="w-10 h-10 flex items-center justify-center bg-[#4871AD]/10 text-[#4871AD] text-xs rounded">+{{ $product->images->count() - 2 }}</span>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Detail Peringatan -->
            @if(count($product->warnings) > 0)
                <div id="warning_{{ $product->id }}" class="mb-2 p-1.5 bg-[#4871AD]/5 rounded border-2 border-[#4871AD]/20 text-xs hidden relative z-20">
                    <p class="text-xs font-serif text-[#4871AD] mb-2 font-medium">Detail Peringatan:</p>
                    <div class="flex flex-col gap-1.5">
                        @foreach ($product->warnings as $warning)
                            <div class="flex items-start gap-2 p-1.5 rounded border-2 {{ $warning->status === 'RESOLVED' ? 'border-green-200 bg-green-50' : 'border-red-200 bg-red-50' }}">
                                <span class="mt-0.5">
                                    @if($warning->status === 'RESOLVED')
                                        <i class="fas fa-check-circle text-green-500"></i>
                                    @else
                                        <i class="fas fa-exclamation-circle text-red-500"></i>
                                    @endif
                                </span>
                                <div class="flex-1">
                                    <p class="font-serif {{ $warning->status === 'RESOLVED' ? 'text-green-700' : 'text-red-700' }} font-medium">
                                        {{ $warning->description }}
                                    </p>
                                    <div class="flex justify-between items-center mt-1">
                                        <span class="text-xs font-serif text-gray-500">
                                            {{ $warning->created_at->format('d M Y') }}
                                        </span>
                                        <span class="px-1.5 py-0.5 rounded text-xs font-serif border-2 
                                            {{ $warning->status === 'RESOLVED' ? 'border-green-100 bg-green-100 text-green-700' : 'border-red-100 bg-red-100 text-red-700' }}">
                                            {{ $warning->status }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Script untuk dropdown warning -->
                <script>
                    function toggleWarning_{{ $product->id }}() {
                        const warningEl = document.getElementById('warning_{{ $product->id }}');
                        if (warningEl.classList.contains('hidden')) {
                            warningEl.classList.remove('hidden');
                        } else {
                            warningEl.classList.add('hidden');
                        }
                        event.preventDefault(); // Prevent navigation
                    }
                </script>
            @endif

            <!-- Action Buttons -->
            @if($this->tab !== 'deleted')
                <div class="grid grid-cols-2 gap-3 text-sm relative z-20">
                    <a href="{{ route('seller.products.edit', compact('product')) }}"
                        class="border border-[#4871AD] text-[#4871AD] px-4 py-0.5 rounded-md font-serif hover:bg-[#4871AD]/5 transition-colors flex items-center justify-center">
                        <i class="fas fa-pen mr-2"></i> Edit
                    </a>
                    
                    <form method="POST" action="{{ route('seller.products.destroy', compact('product')) }}" class="block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="border border-[#4871AD] text-[#4871AD] px-4 py-0.5 rounded-md font-serif hover:bg-[#4871AD]/5 w-full transition-colors flex items-center justify-center"
                               onclick="return confirm('Yakin ingin menghapus produk ini?')">
                            <i class="fas fa-trash mr-2"></i> Hapus
                        </button>
                    </form>
                </div>
            @else
                <!-- Pesan informasi untuk produk yang dihapus -->
                <div class="p-1.5 {{ isset($product->deleted_by_admin) && $product->deleted_by_admin === 1 ? 'bg-red-100' : 'bg-red-50' }} text-xs rounded border border-[#4871AD]/20 font-serif relative z-20">
                    <i class="fas fa-info-circle mr-1 text-red-500"></i>
                    <span class="text-red-600">
                        {{ isset($product->deleted_by_admin) && $product->deleted_by_admin === 1 
                           ? 'Dihapus oleh Admin pada ' 
                           : 'Produk dihapus pada ' }}
                        {{ $product->deleted_at->format('d M Y') }}
                    </span>
                </div>
            @endif
        </div>
    @empty
        <div class="text-center py-6 bg-white rounded-lg">
            <div class="w-12 h-12 mx-auto text-[#4871AD]/60 mb-2">
                <i class="fas fa-box-open text-3xl"></i>
            </div>
            <p class="font-serif text-[#4871AD]">
                @if($this->tab === 'deleted')
                    Tidak ada produk yang dihapus oleh sistem.
                @elseif($this->tab === 'outofstock')
                    Tidak ada produk yang habis stok.
                @elseif($this->tab === 'live')
                    Belum ada produk aktif.
                @else
                    Tidak ada produk ditemukan.
                @endif
            </p>
        </div>
    @endforelse
</div>