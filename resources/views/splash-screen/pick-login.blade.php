<x-splash-layout>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text&display=swap" rel="stylesheet">

    {{-- Splash Screen --}}
    <div id="splash-screen" class="flex items-center justify-center min-h-screen bg-[#FAFAFA]">
        <div class="w-full max-w-md mx-auto flex flex-col items-center justify-center">
            <img src="{{ asset('images/fishora_logo.png') }}" alt="Fishora Logo"
                class="w-full max-w-[600px] h-auto object-contain">
        </div>
    </div>

    {{-- Role Selection --}}
    <div id="role-selection" class="hidden min-h-screen flex items-center justify-center bg-[#FAFAFA]">
        <div class="w-full max-w-md mx-auto px-4 flex flex-col items-center justify-center">
            <img src="{{ asset('images/fishora_logo.png') }}" alt="Fishora Logo" class="w-80 md:w-80 h-auto mb-[0px]">

            <div class="space-y-4 w-full mt-0">
                <a href="{{ route('customer.login') }}"
                    class="block w-5/6 mx-auto font-serif text-[20px] font-normal py-3 px-4 rounded-lg text-center transition duration-200 text-white bg-[#ABCDFF] hover:bg-[#4871AD]">
                    Log in as Customer
                </a>
                <a href="{{ route('seller.login') }}"
                    class="block w-5/6 mx-auto font-serif text-[20px] font-normal py-3 px-4 rounded-lg text-center transition duration-200 text-white bg-[#ABCDFF] hover:bg-[#4871AD]">
                    Log in as Seller
                </a>
                <a href="{{ route('admin.login') }}"
                    class="block w-5/6 mx-auto font-serif text-[20px] font-normal py-3 px-4 rounded-lg text-center transition duration-200 text-white bg-[#ABCDFF] hover:bg-[#4871AD]">
                    Log in as Admin
                </a>
            </div>
        </div>
    </div>

    <script defer>
        setTimeout(() => {
            const splash = document.getElementById('splash-screen');
            splash.classList.add('opacity-0', 'transition-opacity', 'duration-500');
            setTimeout(() => {
                splash.classList.add('hidden');
                document.getElementById('role-selection').classList.remove('hidden');
            }, 500);
        }, 1500);
    </script>
</x-splash-layout>
