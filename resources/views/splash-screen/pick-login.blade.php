<x-splash-layout>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text&display=swap" rel="stylesheet">
    
    {{-- Splash Screen --}}
    <div id="splash-screen" class="fixed top-0 left-0 right-0 bottom-0 flex items-center justify-center" style="background-color: #FAFAFA;">
        <div class="w-full max-w-md mx-auto flex flex-col items-center justify-center">
            <img src="{{ asset('images/fishora_logo.png') }}" alt="Fishora Logo" class="w-[350px] h-[350px] md:w-[400px] md:h-[400px] lg:w-[500px] lg:h-[500px] object-contain">
        </div>
    </div>

    {{-- Role Selection --}}
    <div id="role-selection" class="hidden min-h-screen flex items-center justify-center" style="background-color: #FAFAFA;">
        <div class="w-full max-w-md mx-auto px-4 flex flex-col items-center justify-center">
            <img src="{{ asset('images/fishora_logo.png') }}" alt="Fishora Logo" class="w-80 md:w-80 h-auto mb-[0px]">
            
            
            <div class="space-y-4 w-full mt-0">
                <a href="{{ route('customer.login') }}" 
                   class="block w-5/6 mx-auto font-serif text-[20px] font-normal py-3 px-4 rounded-lg text-center transition duration-200 text-white bg-[#ABCDFF] hover:bg-[#4871AD]">
                    Masuk sebagai Pembeli
                </a>
                <a href="{{ route('seller.login') }}" 
                   class="block w-5/6 mx-auto font-serif text-[20px] font-normal py-3 px-4 rounded-lg text-center transition duration-200 text-white bg-[#ABCDFF] hover:bg-[#4871AD]">
                    Masuk sebagai Penjual
                </a>
                <a href="{{ route('admin.login') }}" 
                   class="block w-5/6 mx-auto font-serif text-[20px] font-normal py-3 px-4 rounded-lg text-center transition duration-200 text-white bg-[#ABCDFF] hover:bg-[#4871AD]">
                    Masuk sebagai Admin
                </a>
            </div>
        </div>
    </div>

    <script>
        // Splash 1,5 detik
        setTimeout(() => {
            document.getElementById('splash-screen').classList.add('hidden');
            document.getElementById('role-selection').classList.remove('hidden');
        }, 1500);
    </script>
</x-splash-layout>