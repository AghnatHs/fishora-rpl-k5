<x-app-layout>
    <div class="max-w-md mx-auto mt-10 p-6">
        <h2 class="text-2xl font-semibold mb-4 text-center">Verify Your Email First!</h2>

        @include('components.modals.status')

        <p class="mb-4 text-gray-700">
            Thanks for signing up! Before getting started, please verify your email address by clicking on the link we
            just
            sent to your email.
            If you didn't receive the email, we can send you another.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                A new verification link has been sent to your email address.
            </div>
        @endif

        <form method="POST" action="{{ route('customer.verification.resend') }}">
            @csrf
            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
                Resend Verification Email
            </button>
        </form>

        <form method="POST" action="{{ route('customer.logout') }}" class="mt-4">
            @csrf
            <button type="submit" class="w-full text-sm text-gray-600 hover:underline">
                Log Out
            </button>
        </form>
    </div>
</x-app-layout>
