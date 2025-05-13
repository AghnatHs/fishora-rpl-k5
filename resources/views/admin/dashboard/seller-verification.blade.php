<x-app-layout>
    <div class="max-w-md mx-auto bg-white pb-16">
        {{-- Header with back button --}}
        <div class="fixed top-0 left-4 right-4 z-10 bg-white">
            <div class="max-w-md mx-auto flex items-center p-2.5">
                <a href="{{ route('admin.dashboard') }}" class="mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="#4871AD" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <h2 class="text-2xl font-serif font-medium text-[#4871AD]">Verifikasi Penjual</h2>
            </div>
        </div>

        <div class="h-10"></div>

        @include('components.modals.status')

        <div class="px-2">
            <ul role="list" class="space-y-4">
                @forelse ($sellers as $seller)
                    <li>
                        <div
                            class="bg-gradient-to-br from-white to-[#EBF1FA] rounded-lg p-4 shadow-sm border-2 border-[#4871AD]/10">
                            <div class="flex flex-col space-y-3">
                                <div class="flex justify-between items-start">
                                    <p class="text-lg font-serif font-medium text-[#4871AD]">{{ $seller->shop_name }}
                                    </p>
                                    @if ($seller->admin_verified_at)
                                        @if ($seller->admin_verified_accepted === 'approve')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Disetujui
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Ditolak
                                            </span>
                                        @endif
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Menunggu Verifikasi
                                        </span>
                                    @endif
                                </div>

                                <p class="text-sm text-gray-700 font-serif">Email : {{ $seller->email }}</p>
                                <p class="text-sm text-gray-700 font-serif">Register at : {{ $seller->created_at }}</p>
                                <p class="text-sm text-green-700 font-serif">Verified at :
                                    {{ $seller->admin_verified_at ?? '-' }}</p>

                                <div class="grid grid-cols-2 gap-2">
                                    <div class="flex flex-col">
                                        <span class="text-xs text-[#4871AD] font-serif mb-1">KTP</span>
                                        <img src="data:{{ $seller->ktp_mime }};base64,{{ base64_encode($seller->ktp) }}"
                                            alt="ID Card"
                                            class="w-full h-auto border border-[#4871AD]/20 rounded-md shadow-sm">
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs text-[#4871AD] font-serif mb-1">Bukti Usaha</span>
                                        <img src="data:{{ $seller->proof_of_business_mime }};base64,{{ base64_encode($seller->proof_of_business) }}"
                                            alt="Business Proof"
                                            class="w-full h-auto border border-[#4871AD]/20 rounded-md shadow-sm">
                                    </div>
                                </div>

                                @if (!$seller->admin_verified_at)
                                    <div class="flex space-x-3 pt-2">
                                        <form
                                            action="{{ route('admin.dashboard.seller-verification.post', ['seller' => $seller]) }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="action" value="approve">
                                            <button type="submit"
                                                class="w-max bg-[#4871AD] hover:bg-[#3a5a8a] text-white font-serif py-2 px-4 rounded-md shadow-sm transition duration-200 text-sm">
                                                Setuju
                                            </button>
                                        </form>
                                        <form
                                            action="{{ route('admin.dashboard.seller-verification.post', ['seller' => $seller]) }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="action" value="reject">
                                            <button type="submit"
                                                class="w-max bg-white border border-[#4871AD] text-[#4871AD] hover:bg-[#EBF1FA] font-serif py-2 px-4 rounded-md shadow-sm transition duration-200 text-sm">
                                                Tolak
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="py-6">
                        <div class="text-center">
                            <div class="w-16 h-16 mx-auto text-[#4871AD]/60 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-full h-full">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                </svg>
                            </div>
                            <p class="text-base font-serif text-[#4871AD]">Belum ada penjual mendaftar</p>
                        </div>
                    </li>
                @endforelse
            </ul>
            <!-- Pagination Info and Links -->
            <div class="flex flex-col items-center mt-8 space-y-2">
                <p class="text-sm text-gray-500">
                    Page {{ $sellers->currentPage() }} of {{ $sellers->lastPage() }}
                </p>
                {{ $sellers->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</x-app-layout>
