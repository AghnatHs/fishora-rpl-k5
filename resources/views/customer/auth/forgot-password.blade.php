<x-app-layout>
    {{-- Sticky Navbar with buttons at screen edges --}}
    <div class="fixed top-0 left-0 right-0 bg-white z-50">
        <div class="flex justify-between items-center px-4 sm:px-6 py-3 w-full">
            <a href="{{ route('customer.login') }}"
                class="text-[#4871AD] hover:text-[#ABCDFF] transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <a href="#" class="text-[#4871AD] hover:text-[#ABCDFF] transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </a>
        </div>
    </div>

    <div class="min-h-screen flex flex-col items-center justify-start pt-35 w-full max-w-md mx-auto">
        @include('components.modals.status')
        @include('components.modals.errors')

        <h2 class="text-3xl font-medium text-center mb-8" style="color: #4871AD; font-family: 'DM Serif Text', serif;">
            Request Reset Password (Pembeli)</h2>
        <form method="POST" action="{{ route('customer.password.send-email') }}" class="space-y-6 w-full">

            @csrf
            <div>
                <input type="email" name="email" id="email" placeholder="Email" required
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
                    Kirim Link Reset Password
                </button>
            </div>

        </form>
    </div>
</x-app-layout>
