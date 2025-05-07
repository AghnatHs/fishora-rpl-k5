<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text&display=swap" rel="stylesheet">
    
    <style>
        /* This specifically targets and hides the browser's password reveal button */
        input::-ms-reveal,
        input::-ms-clear,
        input::-webkit-contacts-auto-fill-button,
        input::-webkit-credentials-auto-fill-button {
            display: none !important;
            visibility: hidden;
            pointer-events: none;
        }
    </style>

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

    <div class="min-h-screen flex flex-col items-center justify-start pt-35 w-full max-w-md mx-auto">
        <h2 class="text-3xl font-medium text-center mb-8" style="color: #4871AD; font-family: 'DM Serif Text', serif;">Masuk sebagai Penjual</h2>

        @include('components.modals.status')
        @include('components.modals.errors')

        <form method="POST" action="{{ route('seller.login') }}" class="space-y-6 w-full">
            @csrf

            {{-- Email --}}
            <div>
                <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}"
                    required
                    class="mt-1 block w-full rounded-lg border border-[#4871AD] shadow-sm px-3 py-2" 
                    style="--tw-ring-color: rgba(72, 113, 173, 0.5); --tw-ring-opacity: 0.5; --tw-border-opacity: 1; --focus-border-color: #4871AD;font-family: 'DM Serif Text', serif; color: #9E9595; font-size: 1.2rem;"
                    onfocus="this.style.borderColor='#4871AD'; this.style.boxShadow='0 0 0 3px rgba(72, 113, 173, 0.25)';"
                    onblur="this.style.boxShadow='';">
            </div>

            {{-- Password --}}
            <div>
                <div class="relative">
                    <input type="password" name="password" id="password" placeholder="Kata Sandi" required
                        autocomplete="new-password"
                        aria-label = "Password"
                        class="mt-1 block w-full rounded-lg border border-[#4871AD] shadow-sm px-3 py-2 pr-10" 
                        style="--tw-ring-color: rgba(72, 113, 173, 0.5); --tw-ring-opacity: 0.5; font-family: 'DM Serif Text', serif; color: #9E9595;font-size: 1.2rem;"
                        onfocus="this.style.borderColor='#4871AD'; this.style.boxShadow='0 0 0 3px rgba(72, 113, 173, 0.25)';"
                        onblur="this.style.boxShadow='';">

                    <button type="button" id="toggle-password" class="absolute right-3 top-3 hidden" style="color: #4871AD;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" id="password-eye-show" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" id="password-eye-hide" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                            <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                        </svg>
                    </button>
                </div>
                
                {{-- Forgot Password Link --}}
                <div class="mt-2 text-right">
                    <a href=# class="text-lg font-medium text-[#4871AD] hover:text-[#ABCDFF] transition-colors duration-200" style="font-family: 'DM Serif Text', serif;">Lupa Kata Sandi?</a>
                </div>
            </div>

            {{-- Submit Button --}}
            <div>
                <button type="submit"
                    class="w-full text-white font-medium text-xl py-2 px-3 rounded-lg uppercase bg-[#4871AD] hover:bg-[#ABCDFF] transition-colors duration-200"
                    style="font-family: 'DM Serif Text', serif;">
                    MASUK
                </button>
            </div>
        </form>

        {{-- Sign In Link --}}
        <p class="mt-20 text-center text-gray-400 text-lg" style="font-family: 'DM Serif Text', serif;">
            Baru di Toko Fishora? 
            <a href="{{ route('seller.register') }}" class="font-medium text-[#4871AD] hover:text-[#ABCDFF] transition-colors duration-200" style="font-family: 'DM Serif Text', serif;">Daftar</a>
        </p>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('toggle-password');
    const passwordField = document.getElementById('password');
    const eyeShow = document.getElementById('password-eye-show');
    const eyeHide = document.getElementById('password-eye-hide');
            
        passwordField.addEventListener('input', function() {
            if (this.value.length > 0) {
                toggleButton.classList.remove('hidden');
            } else {
                toggleButton.classList.add('hidden');
            }
        });
        toggleButton.addEventListener('click', function() {
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeShow.classList.add('hidden');
                eyeHide.classList.remove('hidden');
            } else {
                passwordField.type = 'password';
                eyeShow.classList.remove('hidden');
                eyeHide.classList.add('hidden');
            }
        });
    });
</script>