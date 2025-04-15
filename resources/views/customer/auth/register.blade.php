<x-guest-layout>
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Customer Register</h2>

    @include('components.modals.errors')

    <form method="POST" action="{{ route('customer.register') }}" class="space-y-6">
        @csrf

        {{-- Full Name --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
            <input type="text" name="name" id="name" placeholder="John Doe" required
                class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                value="{{ old('name') }}">
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" placeholder="you@example.com" required
                class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                value="{{ old('email') }}">
        </div>

        {{-- Telephone --}}
        <div>
            <label for="telephone" class="block text-sm font-medium text-gray-700">Phone</label>
            <input type="text" name="telephone" id="telephone" placeholder="e.g. 081234567890" required
                class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                value="{{ old('telephone') }}">
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

        {{-- Confirmation Password --}}
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <div class="relative">
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="********"
                    required
                    class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">

                <button type="button" id="toggle-password-confirm"
                    class="absolute right-3 top-3 text-blue-600 hover:text-blue-800 text-sm">
                    Show
                </button>
            </div>
        </div>

        {{-- Submit Button --}}
        <div>
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition duration-200">
                Register
            </button>
        </div>
    </form>

    <p class="mt-3 text-center text-sm text-gray-600">
        Already have an account?
        <a href="{{ route('customer.login') }}" class="text-blue-600 hover:underline font-medium">Login here</a>
    </p>
    <p class="mt-3 text-center text-sm text-gray-600">
        Login as seller?
        <a href="{{ route('seller.login') }}" class="text-blue-600 hover:underline font-medium">Here</a>
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

        $('#toggle-password-confirm').click(function() {
            const passwordConfirmField = $('#password_confirmation');
            const buttonConfirm = $('#toggle-password-confirm');

            if (passwordConfirmField.attr('type') === 'password') {
                passwordConfirmField.attr('type', 'text');
                buttonConfirm.text('Hide');
            } else {
                passwordConfirmField.attr('type', 'password');
                buttonConfirm.text('Show');
            }
        });
    });
</script>
