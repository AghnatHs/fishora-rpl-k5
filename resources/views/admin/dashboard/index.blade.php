<x-app-layout>
    <div class="max-w-md mx-auto mt-10 bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Welcome, {{ Auth::guard('admin')->user()->name }}!</h2>

        <div class="space-y-2 text-gray-700">
            <p><span class="font-medium">Email:</span> {{ Auth::guard('admin')->user()->email }}</p>
            <p><span class="font-medium">Phone:</span> {{ Auth::guard('admin')->user()->telephone }}</p>
        </div>

        <form action="{{ route('admin.logout') }}" method="POST" class="mt-6">
            @csrf
            <button type="submit"
                class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition duration-200">
                Logout
            </button>
        </form>
    </div>
</x-app-layout>
