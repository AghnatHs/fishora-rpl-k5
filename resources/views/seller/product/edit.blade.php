<x-full-layout>
    <!-- Handle x-cloak properly -->
    <style>
        [x-cloak] { display: none !important; }
    </style>
    
    <div class="flex flex-col min-h-screen bg-white">
        <!-- Header -->
        <div class="fixed -top-1 left-0 right-0 bg-white z-30">
            <div class="w-full max-w-md mx-auto px-0 sm:px-4 flex items-center py-3">
                <a href="{{ route('seller.products.index') }}" class="ml-2 mr-4 sm:ml-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="#4871AD" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <h1 class="text-2xl font-serif font-medium text-[#4871AD]">Edit Produk</h1>
            </div>
        </div>

        <div class="pt-12"></div>

        <!-- Content  -->
        <div class="w-full max-w-md mx-auto px-0 sm:px-4 pb-14">
            @include('components.modals.status')
            @include('components.modals.errors')

            <!-- Product Form -->
            <form id="product-form" action="{{ route('seller.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-0">
                @method('PUT')
                @csrf

                <!-- PHOTO SECTION-->
                <div class="bg-[#4871AD] py-2 px-2 sm:px-4 text-white">
                    <h2 class="font-serif text-lg mb-2 ml-2 sm:ml-0">Foto</h2>
                    
                    <div class="mb-2 ml-2 sm:ml-0">
                        <div class="flex flex-row flex-wrap gap-1 mb-2" 
                             x-data="productImageManager('{{ Storage::url($product->image_cover) }}')"
                             x-init="init()">
                            
                            <!-- Cover Preview -->
                            <div x-show="coverUrl" x-cloak class="relative inline-block mr-1 mb-1">
                                <img :src="coverUrl" class="w-20 h-20 object-cover rounded bg-white" />
                                <span class="absolute bottom-0 left-0 right-0 bg-white/80 text-xs font-serif text-[#4871AD] text-center py-0.5">Cover</span>
                                <button type="button" @click="removeCover()" 
                                    class="absolute -top-1 -right-1 bg-white text-red-500 rounded-full w-5 h-5 flex items-center justify-center">
                                    <i class="fas fa-times text-xs"></i>
                                </button>
                            </div>
                            
                            <!-- Existing Product Photos -->
                            @foreach ($product->images as $image)
                            <div class="relative inline-block mr-1 mb-1" id="image-container-{{ $image->id }}">
                                <img src="{{ Storage::url($image->filepath) }}" class="w-20 h-20 object-cover rounded bg-white" />
                                <button type="button" 
                                    onclick="toggleImageDeletion('{{ $image->id }}')"
                                    class="absolute -top-1 -right-1 bg-white text-red-500 rounded-full w-5 h-5 flex items-center justify-center">
                                    <i class="fas fa-times text-xs"></i>
                                </button>
                                <input type="hidden" name="delete_images[]" id="delete-image-{{ $image->id }}" disabled>
                            </div>
                            @endforeach
                            
                            <!-- New photo previews -->
                            <template x-for="(url, index) in photoUrls" :key="index">
                                <div class="relative inline-block mr-1 mb-1">
                                    <img :src="url" class="w-20 h-20 object-cover rounded bg-white" />
                                    <button type="button" @click="removePhoto(index)" 
                                        class="absolute -top-1 -right-1 bg-white text-red-500 rounded-full w-5 h-5 flex items-center justify-center">
                                        <i class="fas fa-times text-xs"></i>
                                    </button>
                                </div>
                            </template>
                            
                            <!-- Cover Upload Button -->
                            <div x-show="!coverUrl" x-cloak class="inline-block mr-1 mb-1">
                                <label for="image_cover" 
                                    class="inline-flex flex-col items-center justify-center w-20 h-20 bg-white text-[#4871AD] rounded cursor-pointer">
                                    <span class="text-2xl mb-1">+</span>
                                    <span class="text-xs font-serif">Cover</span>
                                </label>
                            </div>
                            
                            <!-- Add COver Button -->
                            <div x-ref="defaultCoverButton" class="inline-block mr-1 mb-1">
                                <div class="inline-flex flex-col items-center justify-center w-20 h-20 bg-white text-[#4871AD] rounded">
                                    <span class="text-2xl mb-1">+</span>
                                    <span class="text-xs font-serif">Cover</span>
                                </div>
                            </div>
                            
                            <!-- Hidden Cover Input -->
                            <input type="file" name="image_cover" id="image_cover" 
                                class="hidden" @change="handleCoverSelected" accept="image/*">
                                
                            <!-- Product Photos Upload Button  -->
                            <label for="product_images" 
                                class="inline-flex flex-col items-center justify-center w-20 h-20 bg-white text-[#4871AD] rounded cursor-pointer mr-1 mb-1">
                                <span class="text-2xl mb-1">+</span>
                                <span class="text-xs font-serif">Foto</span>
                            </label>
                            
                            <!-- Hidden product images input -->
                            <input type="file" name="product_images" id="product_images" multiple 
                                class="hidden" @change="handlePhotosSelected" accept="image/*">
                            
                            <!-- Container for dynamically added file inputs -->
                            <div id="selected_images_container" class="hidden"></div>
                        </div>
                    </div>
                </div>

                <!-- Spacing between sections -->
                <div class="h-1 bg-white"></div>

                <!-- Nama Produk -->
                <div class="bg-[#4871AD] py-3 px-4 text-white">
                    <label for="name" class="block font-serif text-lg mb-1.5">Nama Produk</label>
                    <input type="text" name="name" id="name" 
                        placeholder="Masukkan Nama Produk"
                        class="w-full p-1.5 rounded bg-white border border-white text-[#4871AD] font-serif text-base" 
                        value="{{ old('name', $product->name) }}" required>
                </div>

                <!-- Spacing between sections -->
                <div class="h-1 bg-white"></div>

                <!-- Deskripsi -->
                <div class="bg-[#4871AD] py-2 px-4 text-white">
                    <label for="description" class="block font-serif text-lg mb-1.5">Deskripsi Produk</label>
                    <textarea name="description" id="description" rows="2" 
                        placeholder="Masukkan Deskripsi Produk"
                        class="w-full p-1.5 rounded bg-white border border-white text-[#4871AD] font-serif text-base" required>{{ old('description', $product->description) }} </textarea>
                </div>

                <!-- Spacing between sections -->
                <div class="h-1 bg-white"></div>

                <!-- Harga -->
                <div class="bg-[#4871AD] py-2 px-4 text-white">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="mr-2.5 p-1.5 rounded-full bg-white/10">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                </svg>
                            </div>
                            <span class="font-serif text-lg">Harga</span>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="flex items-center bg-white px-2 py-1 rounded">
                                <span class="text-[#4871AD] font-serif mr-1">Rp</span>
                                <input type="text" name="price" id="price" 
                                    placeholder="Harga"
                                    class="w-24 p-1 bg-white text-[#4871AD] font-serif text-base border-0 focus:ring-0 focus:outline-none placeholder-gray-400 text-center placeholder:text-center" 
                                    value="{{ old('price', $product->price) }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Spacing between sections -->
                <div class="h-0 bg-white"></div>

                <!-- Stok -->
                <div class="bg-[#4871AD] py-2 px-4 text-white">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="mr-2.5 p-1.5 rounded-full bg-white/10">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                </svg>
                            </div>
                            <span class="font-serif text-lg">Stok</span>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="number" name="stock" id="stock" 
                                placeholder="Stok"
                                min="0"
                                class="w-16 p-1.5 rounded bg-white text-[#4871AD] font-serif text-base border-0 focus:ring-0 focus:outline-none placeholder-gray-400 text-center placeholder:text-center" 
                                value="{{ old('stock', $product->stock) }}" required>
                        </div>
                    </div>
                </div>

                <!-- Spacing between sections -->
                <div class="h-1 bg-white"></div>

                <!-- Kategori -->
                <div class="bg-[#4871AD] py-2 px-4 text-white" x-data="{ showAll: false }">
                    <label class="block font-serif text-lg mb-2">Kategori</label>
                    <div class="grid grid-cols-2 gap-2.5">
                        @foreach ($categories as $i => $category)
                            <label class="flex items-center space-x-2.5 font-serif text-base" x-show="showAll || {{ $i }} < 4">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                    {{ in_array($category->id, old('categories', $product->categories->pluck('id')->toArray())) ? 'checked' : '' }}
                                    class="rounded text-[#4871AD] bg-white border-white focus:ring-0 w-4 h-4 checked:bg-[#4871AD]">
                                <span>{{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    @if(count($categories) > 4)
                        <button type="button" class="mt-2 text-base font-semibold flex items-center gap-1 text-white/90 hover:text-white transition px-4 py-2 font-serif rounded-md" @click="showAll = !showAll">
                            <span x-show="!showAll">
                                Lihat semua
                                <svg class="inline w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.584l3.71-3.354a.75.75 0 111.02 1.1l-4.25 3.85a.75.75 0 01-1.02 0l-4.25-3.85a.75.75 0 01.02-1.06z" clip-rule="evenodd" /></svg>
                            </span>
                            <span x-show="showAll">
                                Tutup
                                <svg class="inline w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M14.77 12.79a.75.75 0 01-1.06-.02L10 9.416l-3.71 3.354a.75.75 0 11-1.02-1.1l4.25-3.85a.75.75 0 011.02 0l4.25 3.85a.75.75 0 01-.02 1.06z" clip-rule="evenodd" /></svg>
                            </span>
                        </button>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="fixed bottom-0 left-0 right-0 bg-[#4871AD] py-2.5 px-0 sm:px-4 border-t border-t-white">
                    <div class="w-full max-w-md mx-auto flex justify-center">
                        <button type="submit"
                            class="w-5/6 sm:w-5/6 bg-white text-[#4871AD] font-serif text-center py-0.5 rounded-md text-base hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-white/50">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-full-layout>

<script>
    // Combined product image manager
    function productImageManager(existingCoverUrl = null) {
        return {
            coverUrl: existingCoverUrl,
            photoUrls: [],
            selectedFiles: [],
            
            init() {
                try {
                    // Hide default cover button once Alpine initializes
                    if (this.$refs.defaultCoverButton) {
                        this.$refs.defaultCoverButton.style.display = 'none';
                    }
                } catch (err) {
                    console.error('Error in init:', err);
                }
            },
            
            handleCoverSelected(event) {
                try {
                    const file = event.target.files[0];
                    if (!file) return;
                    
                    this.coverUrl = URL.createObjectURL(file);
                } catch (err) {
                    console.error('Error selecting cover:', err);
                }
            },
            
            removeCover() {
                try {
                    if (this.coverUrl && this.coverUrl.startsWith('blob:')) {
                        URL.revokeObjectURL(this.coverUrl);
                    }
                    
                    this.coverUrl = null;
                    const coverInput = document.getElementById('image_cover');
                    if (coverInput) coverInput.value = '';
                    
                    // Add hidden input to indicate cover should be removed
                    const form = document.getElementById('product-form');
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'remove_cover';
                    input.value = '1';
                    form.appendChild(input);
                } catch (err) {
                    console.error('Error removing cover:', err);
                }
            },
            
            handlePhotosSelected(event) {
                try {
                    const newFiles = event.target.files;
                    if (!newFiles.length) return;
                    
                    // Process each selected file
                    for (let i = 0; i < newFiles.length; i++) {
                        const file = newFiles[i];
                        const url = URL.createObjectURL(file);
                        this.photoUrls.push(url);
                        this.selectedFiles.push(file);
                    }
                    
                    this.updateHiddenInputs();
                    
                    // Reset the input so the change event fires again even if the same file is selected
                    event.target.value = '';
                } catch (err) {
                    console.error('Error selecting photos:', err);
                }
            },
            
            removePhoto(index) {
                try {
                    // Release the object URL to avoid memory leaks
                    URL.revokeObjectURL(this.photoUrls[index]);
                    
                    this.photoUrls.splice(index, 1);
                    this.selectedFiles.splice(index, 1);
                    this.updateHiddenInputs();
                } catch (err) {
                    console.error('Error removing photo:', err);
                }
            },
            
            updateHiddenInputs() {
                try {
                    // Clear previous inputs
                    const container = document.getElementById('selected_images_container');
                    container.innerHTML = '';
                    
                    // Create hidden inputs for each file using document fragment for performance
                    if (this.selectedFiles.length > 0) {
                        const fragment = document.createDocumentFragment();
                        
                        this.selectedFiles.forEach((file, index) => {
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(file);
                            
                            const input = document.createElement('input');
                            input.type = 'file';
                            input.name = 'images[]';
                            input.style.display = 'none';
                            input.files = dataTransfer.files;
                            
                            fragment.appendChild(input);
                        });
                        
                        container.appendChild(fragment);
                    }
                } catch (err) {
                    console.error('Error updating hidden inputs:', err);
                }
            }
        }
    }

    // Price formatting
    document.addEventListener('DOMContentLoaded', function() {
        try {
            const priceInput = document.getElementById('price');
            
            if (priceInput) {
                if (priceInput.value) {
                    formatPriceDisplay(priceInput);
                }
    
                priceInput.addEventListener('input', function(e) {
                    formatPriceDisplay(this);
                });
            }
    
            const form = document.getElementById('product-form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    if (priceInput) {
                        priceInput.value = priceInput.value.replace(/\./g, '');
                    }
                });
            }
        } catch (err) {
            console.error('Error setting up price formatting:', err);
        }
        
        function formatPriceDisplay(input) {
            try {
                let value = input.value.replace(/\D/g, '');
                
                if (value) {
                    input.value = new Intl.NumberFormat('id-ID').format(value);
                }
            } catch (err) {
                console.error('Error formatting price:', err);
            }
        }
    });

    // Image deletion handling 
    function toggleImageDeletion(imageId) {
        try {
            const container = document.getElementById('image-container-' + imageId);
            const input = document.getElementById('delete-image-' + imageId);
            const button = container.querySelector('button');
            const img = container.querySelector('img');
            const icon = button.querySelector('i');
            
            // Check if image is currently marked for deletion
            const isDeleting = input.disabled === false;
            
            if (isDeleting) {
                // Restore appearance
                container.classList.remove('opacity-50');
                img.classList.remove('grayscale');
                button.classList.add('bg-white');
                button.classList.remove('bg-red-500');
                icon.classList.remove('text-white');
                
                // Disable hidden input
                input.disabled = true;
            } else {
                // Mark as deleted
                container.classList.add('opacity-50');
                img.classList.add('grayscale');
                button.classList.remove('bg-white');
                button.classList.add('bg-red-500');
                button.classList.remove('bg-red-500');
                icon.classList.add('text-white');
                
                // Enable hidden input
                input.disabled = false;
                input.value = imageId;
            }
        } catch (err) {
            console.error('Error toggling image deletion:', err);
        }
    }
    
    // Clean up object URLs when leaving the page to prevent memory leaks
    window.addEventListener('beforeunload', function() {
        try {
            const component = document.querySelector('[x-data]').__x;
            if (component && component.$data.photoUrls) {
                component.$data.photoUrls.forEach(url => {
                    if (url.startsWith('blob:')) {
                        URL.revokeObjectURL(url);
                    }
                });
            }
        } catch (err) {
        }
    });
</script>