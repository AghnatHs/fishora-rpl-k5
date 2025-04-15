@if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-transition
        class="mb-4 flex items-center justify-between bg-green-100 border border-green-300 text-green-800 text-sm rounded p-3">
        <span>{{ session('success') }}</span>
        <button @click="show = false" class="text-green-700 hover:text-green-900 font-bold px-2">
            &times;
        </button>
    </div>
@endif

@if (session('error'))
    <div x-data="{ show: true }" x-show="show" x-transition
        class="mb-4 flex items-center justify-between bg-red-100 border border-red-300 text-red-800 text-sm rounded p-3">
        <span>{{ session('error') }}</span>
        <button @click="show = false" class="text-red-700 hover:text-red-900 font-bold px-2">
            &times;
        </button>
    </div>
@endif
