<x-guest-layout>
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Seller Login</h2>

    @include('components.modals.status')

    @include('components.modals.errors')


    <form method="POST" action="{{ route('seller.login') }}" class="space-y-6">
        @csrf

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" placeholder="you@example.com" value="{{ old('email') }}"
                required
                class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 px-4 py-2">
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <div class="relative">
                <input type="password" name="password" id="password" placeholder="********" required
                    class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">

                <button type="button" id="toggle-password"
                    class="absolute right-3 top-3 text-blue-600 hover:text-blue-800 text-sm">
                    Show
                </button>
            </div>
        </div>

        {{-- Remember Me --}}
        <div class="flex items-center">
            <input id="remember" name="remember" type="checkbox"
                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
            <label for="remember" class="ml-2 block text-sm text-gray-900">
                Remember Me
            </label>
        </div>

        {{-- Submit Button --}}
        <div>
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition duration-200">
                Login
            </button>
        </div>
    </form>

    <p class="mt-3 text-center text-sm text-gray-600">
        Don’t have an account?
        <a href="{{ route('seller.register') }}" class="text-blue-600 hover:underline font-medium">Register here</a>
    </p>
    <p class="mt-3 text-center text-sm text-gray-600">
        Not a seller?
        <a href="{{ route('customer.login') }}" class="text-blue-600 hover:underline font-medium">Login as Customer</a>
    </p>
</x-guest-layout>

<script>
    $(document).ready(function() {
        $('#toggle-password').click(function() {
            const passwordField = $('#password');
            const button = $('#toggle-password');

            if (passwordField.attr('type') === 'password') {
                passwordField.attr('type', 'text');
                button.text('Hide');
            } else {
                passwordField.attr('type', 'password');
                button.text('Show');
            }
        });
    });
</script>
