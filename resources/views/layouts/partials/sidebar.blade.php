<aside :class="sidebarOpen ? 'w-64' : 'w-20'" class="bg-white border-r border-slate-100 transition-all duration-500 ease-in-out flex flex-col sticky top-0 h-screen shadow-sm">

    {{-- Logo / Brand Section --}}
    <div class="h-20 flex items-center px-6 border-b border-slate-50 overflow-hidden">
        <div class="bg-indigo-600 p-2 rounded-xl shrink-0 shadow-lg shadow-indigo-100">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
        </div>
        <span x-show="sidebarOpen" 
              x-transition:enter="transition delay-150 duration-300"
              x-transition:enter-start="opacity-0 -translate-x-4"
              x-transition:enter-end="opacity-100 translate-x-0"
              class="ml-3 text-xs font-black text-slate-800 uppercase tracking-[0.2em] whitespace-nowrap">
            Inventaris <span class="text-indigo-600">Pro</span>
        </span>
    </div>

    {{-- Navigasi --}}
    <nav class="flex-1 overflow-y-auto py-8 px-4 space-y-2 custom-scrollbar">
        
        @php
            $navClass = "flex items-center px-3 py-3 rounded-2xl transition-all duration-300 group ";
            $activeClass = "bg-indigo-600 text-white shadow-xl shadow-indigo-100 ring-4 ring-indigo-50";
            $inactiveClass = "text-slate-400 hover:bg-slate-50 hover:text-slate-900";
        @endphp

        {{-- Dashboard --}}
        <a href="/dashboard" class="{{ $navClass }} {{ Request::is('dashboard*') ? $activeClass : $inactiveClass }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg>
            <span x-show="sidebarOpen" class="ml-3 text-sm font-bold tracking-tight">Dashboard</span>
        </a>

        {{-- Data Barang --}}
        <a href="/barang" class="{{ $navClass }} {{ Request::is('barang') ? $activeClass : $inactiveClass }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
            <span x-show="sidebarOpen" class="ml-3 text-sm font-bold tracking-tight">Gudang Barang</span>
        </a>

        {{-- Peminjaman --}}
        <a href="/peminjaman" class="{{ $navClass }} {{ Request::is('peminjaman*') ? $activeClass : $inactiveClass }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span x-show="sidebarOpen" class="ml-3 text-sm font-bold tracking-tight">Peminjaman</span>
        </a>

        <div x-show="sidebarOpen" class="px-4 pt-6 pb-2">
            <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.2em]">Logistik</p>
        </div>

        {{-- Barang Masuk --}}
        <a href="/barang-masuk" class="{{ $navClass }} {{ Request::is('barang-masuk*') ? $activeClass : $inactiveClass }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span x-show="sidebarOpen" class="ml-3 text-sm font-bold tracking-tight">Barang Masuk</span>
        </a>

        {{-- Barang Keluar --}}
        <a href="/barang-keluar" class="{{ $navClass }} {{ Request::is('barang-keluar*') ? $activeClass : $inactiveClass }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span x-show="sidebarOpen" class="ml-3 text-sm font-bold tracking-tight">Barang Keluar</span>
        </a>

        <hr class="my-6 border-slate-50 mx-2">

        {{-- Laporan --}}
        <a href="/laporan" class="{{ $navClass }} {{ Request::is('laporan*') ? $activeClass : $inactiveClass }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            <span x-show="sidebarOpen" class="ml-3 text-sm font-bold tracking-tight">Laporan PDF</span>
        </a>

    </nav>

    {{-- User & Toggle Section --}}
    <div class="p-4 bg-slate-50/50">
        {{-- Profile Card --}}
        <div class="flex items-center px-2 py-3 bg-white border border-slate-100 rounded-[1.5rem] shadow-sm overflow-hidden mb-3">
            <div class="w-9 h-9 rounded-xl bg-indigo-600 flex items-center justify-center text-white font-black text-sm shrink-0 shadow-lg shadow-indigo-100">
                {{ Auth::user() ? substr(Auth::user()->name, 0, 1) : '?' }}
            </div>
            <div x-show="sidebarOpen" 
                 x-transition:enter="transition duration-300"
                 x-transition:enter-start="opacity-0 translate-x-4"
                 x-transition:enter-end="opacity-100 translate-x-0"
                 class="ml-3 min-w-0">
                <p class="text-xs font-black text-slate-800 truncate leading-none mb-1">
                    {{ Auth::user()->name ?? 'Guest' }}
                </p>
                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-wider truncate">
                    Administrator
                </p>
            </div>
        </div>

        <button @click="sidebarOpen = !sidebarOpen" class="w-full flex items-center justify-center p-3 text-slate-400 hover:text-indigo-600 bg-white border border-slate-100 rounded-xl transition-all duration-300 group shadow-sm">
            <svg class="w-5 h-5 transition-transform duration-500" :class="sidebarOpen ? '' : 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
            </svg>
        </button>
    </div>
</aside>