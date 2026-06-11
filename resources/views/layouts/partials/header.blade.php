<header class="h-16 bg-white/80 backdrop-blur-md border-b border-slate-200/60 flex items-center justify-between px-6 sm:px-8 sticky top-0 z-40 select-none">
    {{-- Left Block: Breadcrumb & Page Identification Title --}}
    <div class="flex flex-col">
        <div class="flex items-center gap-1.5 text-[10px] font-semibold text-slate-400 uppercase tracking-wider mb-0.5">
            <svg class="w-2.5 h-2.5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span class="text-slate-600 font-bold">
                @if (Request::is('dashboard'))
                    Ringkasan
                @elseif (Request::is('barang*') && ! Request::is('barang-masuk*') && ! Request::is('barang-keluar*'))
                    Logistik Utama
                @elseif (Request::is('barang-masuk*') || Request::is('barang-keluar*') || Request::is('peminjaman*'))
                    Sirkulasi Mutasi
                @elseif (Request::is('laporan*'))
                    Berkas Dokumen
                @else
                    Navigasi
                @endif
            </span>
        </div>

        <h2 class="font-bold text-slate-800 text-base sm:text-lg tracking-tight">
            @if (Request::is('dashboard'))
                Dashboard Utama
            @elseif (Request::is('barang') || Request::is('barang/*'))
                Data Master Barang
            @elseif (Request::is('barang-masuk*'))
                Riwayat Barang Masuk
            @elseif (Request::is('barang-keluar*'))
                Riwayat Barang Keluar
            @elseif (Request::is('laporan*'))
                Pusat Cetak Laporan
            @elseif (Request::is('peminjaman*'))
                Sirkulasi Peminjaman Aset
            @elseif (Request::is('petugas*'))
                Konfigurasi Operator
            @else
                Dashboard Aplikasi
            @endif
        </h2>
    </div>

    {{-- Right Block: Real-time Live Widget Info --}}
    <div class="flex items-center gap-4">
        <div class="hidden md:flex flex-col items-end pl-4 border-l border-slate-100">
            <span class="text-xs font-bold text-slate-800 tracking-wider" id="live-clock">--:--:--</span>
            <span class="text-[10px] text-slate-400 font-semibold mt-0.5">
                {{ \Carbon\Carbon::now()->translatedFormat('d M Y') }}
            </span>
        </div>
    </div>
</header>

<script>
    // Penanganan Jam Dinamis dengan proteksi Null Pointer checking
    document.addEventListener('DOMContentLoaded', () => {
        const clockContainer = document.getElementById('live-clock');
        if (clockContainer) {
            const updateClock = () => {
                const timeNow = new Date();
                clockContainer.textContent = timeNow.toLocaleTimeString('en-GB', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
            };
            updateClock(); // Jalankan sekali di awal agar tidak delay kosong
            setInterval(updateClock, 1000);
        }
    });
</script>
