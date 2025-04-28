<x-app-layout>
    <div class="max-w-md mx-auto p-4 sm:max-w-3xl">
        <!-- Back button -->
        <div class="p-4">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
        </div>

        <h2 class="text-2xl font-semibold text-gray-800 mb-4">
            Welcome, {{ Auth::guard('admin')->user()->name }}!
        </h2>

        <div class="space-y-2 text-gray-700 mb-6">
            <p><span class="font-medium">Email:</span> {{ Auth::guard('admin')->user()->email }}
            <form action="{{ route('admin.logout') }}" method="POST" class="mt-6">
                @csrf
                <button type="submit"
                    class="w-max bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition duration-200">
                    Logout
                </button>
            </form>
            </p>
        </div>
    </div>

    
</x-app-layout>
