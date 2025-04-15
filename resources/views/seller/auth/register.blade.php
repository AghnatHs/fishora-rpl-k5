<x-guest-layout>
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Seller Register</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ $errors->first() }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('seller.register') }}" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Left Column --}}
            <div class="space-y-6">
                {{-- Shop Name --}}
                <div>
                    <label for="shop_name" class="block text-sm font-medium text-gray-700">Shop name</label>
                    <input type="text" name="shop_name" id="shop_name" placeholder="Toko Mas Jaya" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        value="{{ old('shop_name') }}">
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" placeholder="you@example.com" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        value="{{ old('email') }}">
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

                {{-- Confirm Password --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                        Password</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="********" required
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">

                        <button type="button" id="toggle-password-confirm"
                            class="absolute right-3 top-3 text-blue-600 hover:text-blue-800 text-sm">
                            Show
                        </button>
                    </div>
                </div>

                {{-- Telephone --}}
                <div>
                    <label for="telephone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" name="telephone" id="telephone" placeholder="e.g. 081234567890" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        value="{{ old('telephone') }}">
                </div>
            </div>

            {{-- Right Column - Address Fields --}}
            <div class="space-y-6">
                {{-- Street --}}
                <div>
                    <label for="address_street" class="block text-sm font-medium text-gray-700">Street Address</label>
                    <input type="text" name="address_street" id="address_street"
                        placeholder="e.g. Jl. Merdeka No.123" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        value="{{ old('address_street') }}">
                </div>

                {{-- City --}}
                <div>
                    <label for="address_city" class="block text-sm font-medium text-gray-700">City</label>
                    <input type="text" name="address_city" id="address_city" placeholder="e.g. Jakarta" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        value="{{ old('address_city') }}">
                </div>

                {{-- Province --}}
                <div>
                    <label for="address_province" class="block text-sm font-medium text-gray-700">Province</label>
                    <input type="text" name="address_province" id="address_province" placeholder="e.g. DKI Jakarta"
                        required
                        class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        value="{{ old('address_province') }}">
                </div>

                {{-- Zipcode --}}
                <div>
                    <label for="address_zipcode" class="block text-sm font-medium text-gray-700">Zip Code</label>
                    <input type="number" name="address_zipcode" id="address_zipcode" placeholder="e.g. 12345" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        value="{{ old('address_zipcode') }}">
                </div>
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
        <a href="{{ route('seller.login') }}" class="text-blue-600 hover:underline font-medium">Login here</a>
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
