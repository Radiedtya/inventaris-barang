<nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-100 transition-all duration-200" 
     x-data="{ open: false, isScrolled: false }" 
     @scroll.window="isScrolled = (window.pageYOffset > 10)"
     :class="isScrolled ? 'py-0 border-slate-200/60 shadow-[0_1px_2px_rgba(0,0,0,0.01)]' : 'py-0.5'">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="flex items-center gap-2.5 select-none group">
                    <div class="relative w-8 h-8 rounded-lg overflow-hidden border border-slate-200/60 shrink-0">
                        <img src="{{ asset('logo.png') }}" alt="Logo" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                    </div>
                    <div class="flex flex-col">
                        <span class="text-sm font-semibold tracking-tight text-slate-900 leading-none">
                            Ryn<span class="text-slate-500 font-normal">Dev</span>
                        </span>
                        <span class="text-[9px] font-medium text-slate-400 uppercase tracking-wider mt-0.5">
                            Smart Inventory
                        </span>
                    </div>
                </a>
            </div>

            <div class="hidden sm:flex sm:items-center sm:gap-3">
                @guest
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="text-xs font-medium text-slate-600 hover:text-slate-900 px-3 py-2 rounded-lg hover:bg-slate-50 transition-colors">
                            Login
                        </a>
                    @endif
                    
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-xs font-semibold text-white bg-slate-900 hover:bg-slate-800 px-3.5 py-2 rounded-lg transition-colors shadow-sm">
                            Register
                        </a>
                    @endif
                @else
                    <a href="{{ url('/') }}" class="text-xs font-medium text-slate-600 hover:text-slate-900 px-3 py-2 rounded-lg hover:bg-slate-50 transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Home
                    </a>

                    <button class="relative w-8 h-8 flex items-center justify-center text-slate-400 hover:text-slate-900 hover:bg-slate-50 rounded-lg transition-colors">
                        <span class="absolute top-1.5 right-1.5 w-1.5 h-1.5 bg-slate-900 rounded-full ring-2 ring-white"></span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7c0-2.42-1.72-4.44-4.005-4.901a1 1 0 10-1.99 0A5.002 5.002 0 008 9v.7c0 2.012-.65 3.857-1.75 5.356a23.848 23.848 0 005.454 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>

                    <div class="h-4 w-px bg-slate-200 mx-1"></div>

                    <div class="relative" x-data="{ dropdownOpen: false }">
                        <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false" 
                                class="flex items-center gap-2 p-1 rounded-lg hover:bg-slate-50 transition-colors">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=F1F5F9&color=0F172A&bold=true" 
                                 class="w-7 h-7 rounded-md bg-slate-100 object-cover border border-slate-200/50" alt="Avatar">
                            <svg class="w-3.5 h-3.5 text-slate-400 transition-transform duration-150" :class="dropdownOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>

                        <div x-show="dropdownOpen" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             class="absolute right-0 mt-2 w-52 bg-white border border-slate-200/70 rounded-lg shadow-md py-1 z-50">
                            
                            <div class="px-3.5 py-2 border-b border-slate-100 mb-1">
                                <p class="text-[9px] text-slate-400 font-semibold uppercase tracking-wider mb-0.5">Otoritas</p>
                                <p class="text-xs font-semibold text-slate-900 capitalize mb-1">{{ Auth::user()->role }}</p>
                                <p class="text-[11px] text-slate-500 truncate">{{ Auth::user()->email }}</p>
                            </div>

                            <a href="{{ route('logout') }}" 
                               class="flex items-center gap-2 px-3.5 py-2 text-xs font-medium text-rose-600 hover:bg-rose-50/50 transition-colors"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <svg class="w-3.5 h-3.5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Keluar Aplikasi
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                        </div>
                    </div>
                @endguest
            </div>

            <div class="flex items-center sm:hidden">
                <button @click="open = !open" class="p-1.5 text-slate-500 hover:bg-slate-50 rounded-md transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" 
         x-transition:enter="transition duration-100 ease-out"
         class="sm:hidden bg-white border-b border-slate-200/80 shadow-sm overflow-hidden">
        <div class="px-4 pt-2 pb-3 space-y-1">
            @guest
                <a href="{{ route('login') }}" class="block px-3 py-2 text-xs font-medium text-slate-600 hover:bg-slate-50 rounded-lg">Login</a>
                <a href="{{ route('register') }}" class="block px-3 py-2 text-xs font-semibold bg-slate-900 text-white text-center rounded-lg shadow-sm">Register</a>
            @else
                <div class="flex items-center gap-2.5 px-3 py-2.5 mb-2 bg-slate-50 rounded-lg">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=F1F5F9&color=0F172A&bold=true" class="w-8 h-8 rounded-md" alt="Avatar">
                    <div class="min-w-0">
                        <p class="text-xs font-semibold text-slate-900 truncate leading-none">{{ Auth::user()->name }}</p>
                        <p class="text-[9px] text-slate-400 font-medium capitalize mt-1">{{ Auth::user()->role }} Account</p>
                    </div>
                </div>
                <a href="{{ url('/') }}" class="block px-3 py-2 text-xs font-medium text-slate-600 hover:bg-slate-50 rounded-lg">Home</a>
                <a href="{{ route('logout') }}" 
                   class="block px-3 py-2 text-xs font-medium text-rose-600 hover:bg-rose-50 rounded-lg"
                   onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                    Keluar Aplikasi
                </a>
                <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
            @endguest
        </div>
    </div>
</nav>