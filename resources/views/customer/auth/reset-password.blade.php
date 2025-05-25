<x-app-layout>
    <div class="min-h-screen flex flex-col items-center justify-start pt-35 w-full max-w-md mx-auto">
        @include('components.modals.status')
        @include('components.modals.errors')
        
        <form method="POST" action="{{ route('customer.password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">
            <input type="password" name="password" placeholder="New Password">
            <input type="password" name="password_confirmation" placeholder="Confirm Password">
            <button type="submit">Reset Password</button>
        </form>
    </div>
</x-app-layout>
