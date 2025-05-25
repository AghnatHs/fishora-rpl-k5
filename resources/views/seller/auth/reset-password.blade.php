<x-app-layout>
    <div class="min-h-screen flex flex-col items-center justify-start pt-35 w-full max-w-md mx-auto">
        @include('components.modals.status')
        @include('components.modals.errors')

        <h2 class="text-3xl font-medium text-center mb-8" style="color: #4871AD; font-family: 'DM Serif Text', serif;">
            Password Baru (Penjual) untuk {{ $email }}</h2>
        <form method="POST" action="{{ route('seller.password.update') }}" class="space-y-6 w-full">

            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">
            <div>
                <input type="password" name="password" id="password" placeholder="New Password" required
                    class="mt-1 block w-full rounded-lg border border-[#4871AD] shadow-sm px-3 py-2"
                    style="--tw-ring-color: rgba(72, 113, 173, 0.5); --tw-ring-opacity: 0.5; --tw-border-opacity: 1; --focus-border-color: #4871AD;font-family: 'DM Serif Text', serif; color: #9E9595; font-size: 1.2rem;"
                    onfocus="this.style.borderColor='#4871AD'; this.style.boxShadow='0 0 0 3px rgba(72, 113, 173, 0.25)';"
                    onblur="this.style.boxShadow='';">
            </div>
            <div>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    placeholder="Confirm Password" required
                    class="mt-1 block w-full rounded-lg border border-[#4871AD] shadow-sm px-3 py-2"
                    style="--tw-ring-color: rgba(72, 113, 173, 0.5); --tw-ring-opacity: 0.5; --tw-border-opacity: 1; --focus-border-color: #4871AD;font-family: 'DM Serif Text', serif; color: #9E9595; font-size: 1.2rem;"
                    onfocus="this.style.borderColor='#4871AD'; this.style.boxShadow='0 0 0 3px rgba(72, 113, 173, 0.25)';"
                    onblur="this.style.boxShadow='';">
            </div>

            {{-- Submit Button --}}
            <div>
                <button type="submit"
                    class="w-full text-white font-medium text-xl py-2 px-3 rounded-lg uppercase bg-[#4871AD] hover:bg-[#ABCDFF] transition-colors duration-200"
                    style="font-family: 'DM Serif Text', serif;">
                    Ubah Password
                </button>
            </div>

        </form>
    </div>
</x-app-layout>
