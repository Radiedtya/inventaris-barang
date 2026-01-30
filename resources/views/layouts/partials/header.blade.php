<header class="h-20 bg-white/70 backdrop-blur-md border-b border-gray-200/50 flex items-center justify-between px-8 sticky top-0 z-40">
    
    <div class="flex flex-col">
        <div class="flex items-center gap-2 text-xs font-medium text-gray-400 mb-0.5">
            <span>AdminPanel</span>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <span class="text-indigo-600/80">
                {{ Request::is('dashboard') ? 'Overview' : (Request::is('barang*') ? 'Inventory' : 'Transaction') }}
            </span>
        </div>
        <h2 class="font-bold text-gray-900 text-xl tracking-tight">
            @if(Request::is('dashboard')) Dashboard Utama
            @elseif(Request::is('barang')) Data Master Barang
            @elseif(Request::is('barang-masuk*')) Log Barang Masuk
            @elseif(Request::is('barang-keluar*')) Log Barang Keluar
            @elseif(Request::is('laporan*')) Pusat Laporan
            @elseif(Request::is('peminjaman*')) Peminjaman Barang
            @else Halaman Utama
            @endif
        </h2>
    </div>

    <div class="flex items-center gap-3">
        <div class="hidden md:flex flex-col items-end mr-4 pr-4 border-r border-gray-100">
            <span class="text-xs font-bold text-gray-900 uppercase tracking-widest" id="live-clock">00:00:00</span>
            <span class="text-[10px] text-gray-400 font-medium">{{ date('d M Y') }}</span>
        </div>

    </div>
</header>

<script>
    // Script sederhana untuk jam dinamis
    setInterval(() => {
        const now = new Date();
        document.getElementById('live-clock').innerText = now.toLocaleTimeString('en-GB');
    }, 1000);
</script>