<nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100/80" x-data="{ open: false, isScrolled: false }" @scroll.window="isScrolled = (window.pageYOffset > 20)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            
            {{-- Brand Section --}}
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="group flex items-center gap-4 transition-all duration-500">
                    <div class="relative">
                        <img src="{{ asset('logo.png') }}" alt="" class="w-11 h-11 rounded-xl shadow-xl group-hover:rotate-6 transition-all duration-500">

                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-black tracking-tight text-gray-900 leading-none">
                            Ryn<span class="text-indigo-600">Dev</span>
                        </span>
                        <span class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] mt-1.5 opacity-80">smart inventory</span>
                    </div>
                </a>
            </div>

            {{-- Desktop Actions --}}
            <div class="hidden sm:flex sm:items-center sm:gap-6">
                @guest
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors">
                            {{ __('Login') }}
                        </a>
                    @endif
                    
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="relative group">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-indigo-600 to-violet-600 rounded-xl blur opacity-30 group-hover:opacity-60 transition duration-300"></div>
                            <button class="relative px-7 py-2.5 bg-gray-900 text-white text-sm font-bold rounded-xl transition-all active:scale-95">
                                {{ __('Register') }}
                            </button>
                        </a>
                    @endif
                @else
                    {{-- Notification Bell --}}
                    <button class="relative w-10 h-10 flex items-center justify-center text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all duration-300" title="Notifications">
                        <span class="absolute top-2.5 right-2.5 w-2 h-2 bg-rose-500 rounded-full border-2 border-white animate-pulse"></span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7c0-2.42-1.72-4.44-4.005-4.901a1 1 0 10-1.99 0A5.002 5.002 0 008 9v.7c0 2.012-.65 3.857-1.75 5.356a23.848 23.848 0 005.454 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>

                    <div class="h-8 w-px bg-gray-100 mx-1"></div>

                    {{-- User Dropdown --}}
                    <div class="relative" x-data="{ dropdownOpen: false }">
                        <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false" 
                                class="group flex items-center gap-3 pl-1 pr-3 py-1 rounded-2xl hover:bg-gray-50 transition-all duration-300">
                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6366f1&color=fff&bold=true" 
                                     class="w-9 h-9 rounded-xl object-cover shadow-md group-hover:shadow-indigo-100 transition-all" alt="Avatar">
                                <div class="absolute -bottom-1 -right-1 w-3.5 h-3.5 bg-emerald-500 border-2 border-white rounded-full"></div>
                            </div>
                            <div class="text-left hidden lg:block">
                                <p class="text-sm font-black text-gray-900 leading-none">{{ Auth::user()->name }}</p>
                                <p class="text-[10px] text-indigo-500 font-bold uppercase tracking-tighter mt-1">Admin</p>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-indigo-600 transition-transform duration-300" :class="dropdownOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </button>

                        {{-- Dropdown Menu --}}
                        <div x-show="dropdownOpen" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             class="absolute right-0 mt-3 w-64 bg-white border border-gray-100 rounded-[1.5rem] shadow-2xl shadow-indigo-100/50 py-3 z-50 overflow-hidden">
                            
                            <div class="px-5 py-4 bg-gray-50/50 border-b border-gray-50 mb-2">
                                <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest mb-1">Akun Terhubung</p>
                                <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->email }}</p>
                            </div>

                            {{-- <a href="#" class="flex items-center gap-3 px-5 py-3 text-sm text-gray-600 hover:bg-indigo-50 hover:text-indigo-700 transition-all font-medium">
                                <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2" /></svg>
                                Profil Saya
                            </a> --}}

                            <hr class="my-2 border-gray-50">

                            <a href="{{ route('logout') }}" 
                               class="flex items-center gap-3 px-5 py-3 text-sm text-rose-600 hover:bg-rose-50 font-bold transition-all"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                Keluar Aplikasi
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                        </div>
                    </div>
                @endguest
            </div>

            {{-- Mobile Toggle --}}
            <div class="flex items-center sm:hidden">
                <button @click="open = !open" class="p-2 w-11 h-11 flex items-center justify-center rounded-xl bg-gray-50 text-gray-900 hover:bg-indigo-600 hover:text-white transition-all duration-300 shadow-inner">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>