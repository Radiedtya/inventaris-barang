<aside :class="sidebarOpen ? 'w-64' : 'w-20'" class="bg-white border-r border-gray-200 transition-all duration-300 ease-in-out flex flex-col sticky top-0 h-screen">

    <div class="h-20 flex items-center px-6 border-b border-gray-100">
        <span x-show="sidebarOpen" 
              x-transition:enter="transition ease-out duration-300"
              x-transition:enter-start="opacity-0 -translate-x-2"
              x-transition:enter-end="opacity-100 translate-x-0"
              class="text-sm font-black text-gray-900 uppercase tracking-[0.2em] mt-1.5 opacity-80">
            Inventaris Barang
        </span>
    </div>

    <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-2">
        
        {{-- Helper function untuk class aktif biar kode lebih bersih --}}
        @php
            $navClass = "flex items-center px-3 py-2.5 rounded-xl transition-all duration-200 group ";
            $activeClass = "bg-indigo-50 text-indigo-700 shadow-sm shadow-indigo-100/50";
            $inactiveClass = "text-gray-500 hover:bg-gray-50 hover:text-gray-900";
        @endphp

        <a href="/dashboard" class="{{ $navClass }} {{ Request::is('dashboard*') ? $activeClass : $inactiveClass }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span x-show="sidebarOpen" class="ml-3 text-sm {{ Request::is('dashboard*') ? 'font-bold' : 'font-medium' }}">Dashboard</span>
        </a>

        <a href="/barang" class="{{ $navClass }} {{ Request::is('barang') ? $activeClass : $inactiveClass }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            <span x-show="sidebarOpen" class="ml-3 text-sm {{ Request::is('barang') ? 'font-bold' : 'font-medium' }}">Data Barang</span>
        </a>

        <a href="/peminjaman" class="{{ $navClass }} {{ Request::is('peminjaman*') ? $activeClass : $inactiveClass }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            <span x-show="sidebarOpen" class="ml-3 text-sm {{ Request::is('peminjaman*') ? 'font-bold' : 'font-medium' }}">Peminjaman</span>
        </a>

        <a href="/barang-masuk" class="{{ $navClass }} {{ Request::is('barang-masuk*') ? $activeClass : $inactiveClass }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
            </svg>
            <span x-show="sidebarOpen" class="ml-3 text-sm {{ Request::is('barang-masuk*') ? 'font-bold' : 'font-medium' }}">Barang Masuk</span>
        </a>

        <a href="/barang-keluar" class="{{ $navClass }} {{ Request::is('barang-keluar*') ? $activeClass : $inactiveClass }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            <span x-show="sidebarOpen" class="ml-3 text-sm {{ Request::is('barang-keluar*') ? 'font-bold' : 'font-medium' }}">Barang Keluar</span>
        </a>

        <hr class="my-2 border-gray-700">

        <a href="/laporan" class="{{ $navClass }} {{ Request::is('laporan*') ? $activeClass : $inactiveClass }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span x-show="sidebarOpen" class="ml-3 text-sm {{ Request::is('laporan*') ? 'font-bold' : 'font-medium' }}">Laporan PDF</span>
        </a>

    </nav>

    <div class="p-4 border-t border-gray-100 bg-gray-50/50">
        <button @click="sidebarOpen = !sidebarOpen" class="w-full flex items-center p-2 text-gray-400 hover:text-indigo-600 hover:bg-white hover:shadow-sm rounded-xl transition-all duration-300 mb-4 group">
            <svg class="w-5 h-5 mx-auto transition-transform duration-500" :class="sidebarOpen ? '' : 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
            </svg>
        </button>

        <div class="flex items-center px-2 py-3 bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
            <div class="w-9 h-9 rounded-xl bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold text-sm shrink-0 shadow-inner">
                {{-- Menggunakan null coalescing dan substr aman --}}
                {{ Auth::user() ? substr(Auth::user()->name, 0, 1) : '?' }}
            </div>
            <div x-show="sidebarOpen" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-x-4"
                 x-transition:enter-end="opacity-100 translate-x-0"
                 class="ml-3 min-w-0">
                <p class="text-xs font-bold text-gray-900 truncate">
                    {{ Auth::user()->name ?? 'Guest' }}
                </p>
                <p class="text-[10px] text-gray-500 font-medium truncate uppercase tracking-wider">
                    {{ Auth::user() ? 'Administrator' : 'Not Logged In' }}
                </p>
            </div>
        </div>
    </div>
</aside>