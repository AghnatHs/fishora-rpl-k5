{{-- resources/views/components/bottom-nav.blade.php --}}
@props(['active' => '', 'inboxRoute' => '#', 'transactionRoute' => '#'])

<!-- Bottom Navigation Bar -->
<div class="fixed bottom-0 left-0 right-0 bg-[#4871AD] text-white flex justify-around items-center py-2">
    <!-- Home Tab -->
    <a href="{{ route('homepage.index') }}" 
       class="flex flex-col items-center px-3 py-1 {{ $active === 'home' ? 'bg-[#3A5A8C] rounded-lg' : '' }}">
        <i class="fas fa-home text-xl"></i>
        <span class="text-xs mt-1">Beranda</span>
    </a>
    
    <!-- Transaction Tab -->
    <a href="{{ $transactionRoute }}" 
       class="flex flex-col items-center px-3 py-1 {{ $active === 'transactions' ? 'bg-[#3A5A8C] rounded-lg' : '' }}">
        <i class="fas fa-receipt text-xl"></i>
        <span class="text-xs mt-1">Transaksi</span>
    </a>
    
    <!-- Inbox Tab -->
    <a href="{{ $inboxRoute }}"
       class="flex flex-col items-center px-3 py-1 {{ $active === 'inbox' ? 'bg-[#3A5A8C] rounded-lg' : '' }}">
        <i class="fas fa-inbox text-xl"></i>
        <span class="text-xs mt-1">Pesan</span>
    </a>
    
    <!-- Account Tab -->
    <a href="{{ route('customer.dashboard') }}" 
       class="flex flex-col items-center px-3 py-1 {{ $active === 'account' ? 'bg-[#3A5A8C] rounded-lg' : '' }}">
        <i class="fas fa-user text-xl"></i>
        <span class="text-xs mt-1">Akun</span>
    </a>
</div>

<!-- Spacer untuk bottom navigation -->
<div class="h-16"></div>