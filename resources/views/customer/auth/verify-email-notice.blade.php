<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text&display=swap" rel="stylesheet">

    {{-- Sticky Navbar with buttons at screen edges --}}
    <div class="fixed top-0 left-0 right-0 bg-white z-50">
        <div class="flex justify-between items-center px-4 sm:px-6 py-3 w-full">
            <a href="{{ route('pick-login') }}" class="text-[#4871AD] hover:text-[#ABCDFF] transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <a href="#" class="text-[#4871AD] hover:text-[#ABCDFF] transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </a>
        </div>
    </div>

    <div class="min-h-screen flex flex-col items-center justify-start pt-24 w-full max-w-md mx-auto px-4">
        <h2 class="text-3xl font-medium text-center mb-6" style="color: #4871AD; font-family: 'DM Serif Text', serif;">Verifikasi Email Anda</h2>

        @include('components.modals.status')
        @include('components.modals.errors')

        <div class="w-full rounded-lg border border-[#4871AD] px-6 py-6 mb-6">
            <p class="mb-6 text-gray-600 text-center" style="font-family: 'DM Serif Text', serif;">
                Terima kasih telah mendaftar! Sebelum memulai, mohon verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirim ke email Anda. Jika Anda tidak menerima email tersebut, kami dapat mengirimkan yang baru.
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-6 font-medium text-sm text-center text-green-600 p-3 bg-green-50 rounded-lg">
                    Tautan verifikasi baru telah dikirim ke alamat email Anda.
                </div>
            @endif

            <form method="POST" action="{{ route('customer.verification.resend') }}">
                @csrf
                <button type="submit" 
                    class="w-full text-white font-medium text-xl py-2 px-3 rounded-lg bg-[#4871AD] hover:bg-[#ABCDFF] transition-colors duration-200"
                    style="font-family: 'DM Serif Text', serif;">
                    KIRIM ULANG EMAIL
                </button>
            </form>

            <form method="POST" action="{{ route('customer.logout') }}" class="mt-6">
                @csrf
                <button type="submit" 
                    class="w-full text-[#4871AD] font-medium text-lg border border-[#4871AD] py-2 px-3 rounded-lg hover:bg-gray-50 transition-colors duration-200"
                    style="font-family: 'DM Serif Text', serif;">
                    KELUAR
                </button>
            </form>
        </div>
    </div>
</x-app-layout>