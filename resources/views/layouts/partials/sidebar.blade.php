<aside :class="sidebarOpen ? 'w-64' : 'w-20'" 
       class="bg-white border-r border-slate-100 transition-all duration-300 ease-in-out flex flex-col sticky top-0 h-screen select-none">

    {{-- Header Section: Unified Logo, Brand, & Collapse Button Underneath --}}
    <div :class="sidebarOpen ? 'h-28 pt-4 pb-3 px-5' : 'h-24 pt-4 pb-2 px-3'" class="flex flex-col border-b border-slate-100 shrink-0 transition-all duration-300">
        {{-- Baris Atas: Logo & Nama Aplikasi --}}
        <div class="flex items-center" :class="!sidebarOpen ? 'justify-center' : ''">
            {{-- Logo Container --}}
            <div class="w-8 h-8 rounded-lg bg-slate-900 flex items-center justify-center shrink-0">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
            {{-- Teks Brand (Hanya muncul saat sidebar terbuka) --}}
            <span x-show="sidebarOpen" 
                  x-transition:enter="transition ease-out duration-200"
                  x-transition:enter-start="opacity-0 translate-x-[-10px]"
                  x-transition:enter-end="opacity-100 translate-x-0"
                  class="ml-3 text-sm font-bold text-slate-900 tracking-tight whitespace-nowrap">
                InventoryApp
            </span>
        </div>

        {{-- Baris Bawah: Tombol Collapse (Sekarang berada di bawah tulisan InventoryApp) --}}
        <div class="mt-auto flex" :class="sidebarOpen ? 'justify-start' : 'justify-center'">
            <button @click="sidebarOpen = !sidebarOpen" 
                    class="p-1.5 text-slate-400 hover:text-slate-900 hover:bg-slate-50 rounded-lg transition-all focus:outline-none flex items-center justify-center w-full max-w-[32px] h-8 border border-slate-100/70 shadow-[0_1px_2px_rgba(0,0,0,0.02)]">
                <svg :class="!sidebarOpen ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Navigation Area --}}
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1 custom-scrollbar">
        
        @php
            // Mengubah activeClass menjadi Hitam Pekat (bg-slate-900 text-white) dengan Font Bold yang disempurnakan
            $navClass = "flex items-center px-3 py-2.5 rounded-lg transition-all group text-xs tracking-wide ";
            $activeClass = "bg-slate-900 text-white font-bold shadow-sm shadow-slate-900/10";
            $inactiveClass = "text-slate-500 hover:bg-slate-50 hover:text-slate-900 font-semibold";
            $userRole = Auth::user()->role ?? 'guest';
        @endphp

        {{-- ================= MENU PETUGAS ================= --}}
        @if($userRole == 'petugas')
            
            <a href="/dashboard" class="{{ $navClass }} {{ Request::is('dashboard') ? $activeClass : $inactiveClass }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                <span x-show="sidebarOpen" class="ml-3">Dashboard</span>
            </a>

            <a href="/barang" class="{{ $navClass }} {{ Request::is('barang*') ? $activeClass : $inactiveClass }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <span x-show="sidebarOpen" class="ml-3">Gudang Barang</span>
            </a>

            <a href="/peminjaman" class="{{ $navClass }} {{ Request::is('peminjaman*') ? $activeClass : $inactiveClass }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span x-show="sidebarOpen" class="ml-3">Peminjaman</span>
            </a>

            {{-- Label Pembatas Minimalis --}}
            <div x-show="sidebarOpen" class="px-3 pt-4 pb-1">
                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Logistik</p>
            </div>

            <a href="/barang-masuk" class="{{ $navClass }} {{ Request::is('barang-masuk*') ? $activeClass : $inactiveClass }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span x-show="sidebarOpen" class="ml-3">Barang Masuk</span>
            </a>

            <a href="/barang-keluar" class="{{ $navClass }} {{ Request::is('barang-keluar*') ? $activeClass : $inactiveClass }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span x-show="sidebarOpen" class="ml-3">Barang Keluar</span>
            </a>

            <div class="h-px bg-slate-100 my-2 mx-2"></div>

            <a href="/laporan" class="{{ $navClass }} {{ Request::is('laporan*') ? $activeClass : $inactiveClass }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                <span x-show="sidebarOpen" class="ml-3">Laporan PDF</span>
            </a>
        @endif

        {{-- ================= MENU ADMIN ================= --}}
        @if($userRole == 'admin')
            <div x-show="sidebarOpen" class="px-3 pt-2 pb-1">
                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Manajemen Sistem</p>
            </div>

            {{-- Dashboard Utama Admin --}}
            <a href="/dashboard/admin" class="{{ $navClass }} {{ Request::is('dashboard/admin*') ? $activeClass : $inactiveClass }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                <span x-show="sidebarOpen" class="ml-3">Dashboard Admin</span>
            </a>

            {{-- Data Petugas --}}
            <a href="/petugas" class="{{ $navClass }} {{ Request::is('petugas*') ? $activeClass : $inactiveClass }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span x-show="sidebarOpen" class="ml-3">Data Petugas</span>
            </a>
        @endif

    </nav>

    {{-- Footer Section: User Profile Only --}}
    <div class="p-3 border-t border-slate-100 flex flex-col items-center shrink-0">
        <div class="w-full flex items-center px-2 py-2 rounded-lg bg-slate-50/50 border border-slate-100/50 overflow-hidden">
            {{-- User Avatar Initials --}}
            <div class="w-7 h-7 rounded-md bg-slate-900 flex items-center justify-center text-white font-medium text-xs shrink-0">
                {{ Auth::user() ? substr(Auth::user()->name, 0, 1) : '?' }}
            </div>
            
            <div x-show="sidebarOpen" 
                  x-transition:enter="transition ease-out duration-150"
                  class="ml-2.5 min-w-0 flex-1 flex items-center justify-between">
                <div class="min-w-0">
                    <p class="text-xs font-bold text-slate-900 truncate leading-tight">
                        {{ Auth::user()->name ?? 'Guest' }}
                    </p>
                    <p class="text-[10px] text-slate-400 font-semibold truncate mt-0.5 capitalize">
                        {{ Auth::user()->role ?? 'Guest' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</aside>