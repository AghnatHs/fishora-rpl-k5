<x-app-layout>
    <div class="min-h-screen flex flex-col justify-between">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">
                Welcome, {{ Auth::guard('admin')->user()->name }}!
            </h2>

            <div class="space-y-2 text-gray-700 mb-6">
                <p><span class="font-medium">Email:</span> {{ Auth::guard('admin')->user()->email }}
                <form action="{{ route('admin.logout') }}" method="POST" class="mt-6">
                    @csrf
                    <button type="submit"
                        class="w-max bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition duration-200">
                        Logout
                    </button>
                </form>
                </p>
            </div>

            @include('components.modals.status')

            <ul role="list" class="divide-y divide-gray-100">
                @forelse ($sellers as $seller)
                    <li class="flex justify-between gap-x-6 py-5">
                        <div class="flex min-w-0 gap-x-4">
                            <div class="min-w-0 flex-auto space-y-1">
                                <img src="data:{{ $seller->ktp_mime }};base64,{{ base64_encode($seller->ktp) }}"
                                    alt="ID Card" class="inline-block w-32 h-auto border rounded">
                                <img src="data:{{ $seller->proof_of_business_mime }};base64,{{ base64_encode($seller->proof_of_business) }}"
                                    alt="ID Card" class="inline-block w-32 h-auto border rounded">
                                <p class="text-sm font-semibold text-gray-900">{{ $seller->shop_name }}</p>
                                <p class="mt-1 truncate text-xs text-gray-500">{{ $seller->email }}</p>
                                @if (!$seller->admin_verified_at)
                                    <div class="flex space-x-4">
                                        <form
                                            action="{{ route('admin.dashboard.seller-verification.post', ['seller' => $seller]) }}"
                                            method="POST" class="mt-2">
                                            @csrf
                                            <input type="hidden" name="action" value="approve">
                                            <button type="submit"
                                                class="w-max bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition duration-200 text-sm">
                                                Setuju
                                            </button>
                                        </form>
                                        <form
                                            action="{{ route('admin.dashboard.seller-verification.post', ['seller' => $seller]) }}"
                                            method="POST" class="mt-2">
                                            @csrf
                                            <input type="hidden" name="action" value="reject">
                                            <button type="submit"
                                                class="w-max bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition duration-200 text-sm">
                                                Tolak
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    @if ($seller->admin_verified_accepted === 'approve')
                                        <span
                                            class="inline-flex items-center rounded-md bg-green-50 text-green-700 ring-green-600/10px-2 py-1 text-xs font-medium ring-1 ring-inset p-1">
                                            Disetujui
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center rounded-md bg-green-50 text-red-700 ring-red-600/10px-2 py-1 text-xs font-medium ring-1 ring-inset p-1">
                                            Ditolak
                                        </span>
                                    @endif
                                @endif

                            </div>
                        </div>
                    </li>
                    <hr class="border-t border-gray-200">
                @empty
                    <li class="flex justify-between gap-x-6 py-5">
                        <div class="flex min-w-0 gap-x-4">
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm font-semibold text-gray-900">Belum ada penjual mendaftar.</p>
                            </div>
                        </div>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</x-app-layout>
