<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris Barang | RynDev Smart Solution</title>
    <link rel="shortcut icon" href="{{ asset('smart-inven-removebg-preview.png') }}" type="image/x-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.3); }
        .text-gradient {
            background: linear-gradient(to right, #4f46e5, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        @keyframes gradient-text {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .animate-gradient-text {
            background-size: 200% auto;
            animation: gradient-text 4s linear infinite;
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        .animate-float-delayed {
            animation: float 6s ease-in-out 3s infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        /* Custom scrollbar biar estetik */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-[#FAFBFF] text-slate-900 selection:bg-indigo-100 selection:text-indigo-700 overflow-x-hidden">

    {{-- NAVBAR --}}
    <nav class="bg-white/80 backdrop-blur-xl sticky top-0 z-50 border-b border-gray-100" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="group flex items-center gap-3 transition-all duration-500">
                        <div class="relative">
                            <img src="{{ asset('logo.png') }}" alt="Logo" class="w-10 h-10 rounded-xl shadow-lg group-hover:rotate-6 transition-all duration-500">
                            <div class="absolute -inset-1 bg-indigo-500 rounded-xl blur opacity-0 group-hover:opacity-20 transition duration-500"></div>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-lg font-black tracking-tight text-gray-900 leading-none">Ryn<span class="text-indigo-600">Dev</span></span>
                            <span class="text-[8px] font-black text-gray-400 uppercase tracking-[0.2em] mt-1 opacity-80">Smart Inventory</span>
                        </div>
                    </a>
                </div>

                <div class="hidden md:flex md:items-center md:gap-8">
                    <a href="#beranda" class="text-xs font-black uppercase tracking-widest text-gray-500 hover:text-indigo-600 transition-colors">Beranda</a>
                    <a href="#fitur" class="text-xs font-black uppercase tracking-widest text-gray-500 hover:text-indigo-600 transition-colors">Fitur</a>
                    <a href="#faq" class="text-xs font-black uppercase tracking-widest text-gray-500 hover:text-indigo-600 transition-colors">Bantuan</a>
                    
                    <div class="h-6 w-px bg-gray-200 mx-2"></div>

                    {{-- @guest
                        <a href="{{ route('login') }}" class="text-xs font-black uppercase tracking-widest text-gray-600 hover:text-indigo-600">Masuk</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 bg-gray-900 text-white text-xs font-black uppercase tracking-widest rounded-xl hover:bg-indigo-600 transition-all shadow-xl active:scale-95">Daftar</a>
                    @else
                        <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white text-xs font-black uppercase tracking-widest rounded-xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">Dashboard</a>
                    @endguest --}}

                    <div class="hidden sm:flex sm:items-center sm:gap-6">
                        @guest
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="text-sm font-bold text-gray-500 hover:text-indigo-600 transition-colors">
                                    Login
                                </a>
                            @endif
                            
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="relative group">
                                    <div class="absolute -inset-0.5 bg-gradient-to-r from-indigo-600 to-violet-600 rounded-xl blur opacity-30 group-hover:opacity-60 transition duration-300"></div>
                                    <button class="relative px-7 py-2.5 bg-gray-900 text-white text-sm font-bold rounded-xl transition-all active:scale-95 shadow-lg shadow-gray-200">
                                        Register
                                    </button>
                                </a>
                            @endif
                        @else

                            {{-- User Dropdown --}}
                            <div class="relative" x-data="{ dropdownOpen: false }">
                                <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false" 
                                        class="group flex items-center gap-3 pl-1 pr-3 py-1 rounded-2xl hover:bg-gray-50 transition-all duration-300">
                                    <div class="text-left hidden lg:block">
                                        <p class="text-sm font-black text-gray-900 leading-none">{{ Auth::user()->name }}</p>
                                    </div>
                                    <svg class="w-4 h-4 text-gray-400 group-hover:text-indigo-600 transition-transform duration-300" :class="dropdownOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </button>

                                {{-- Dropdown Menu --}}
                                <div x-show="dropdownOpen" 
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                    class="absolute right-0 mt-3 w-64 bg-white border border-gray-100 rounded-3xl shadow-2xl shadow-indigo-100/50 py-3 z-50 overflow-hidden">
                                    
                                    <a href="/dashboard" class="block px-5 py-3 text-sm text-indigo-600 hover:bg-indigo-50 font-bold transition-all">
                                        Dashboard
                                    </a>
                                    <a href="{{ route('logout') }}" class="flex items-center gap-3 px-5 py-3 text-sm text-rose-600 hover:bg-rose-50 font-bold transition-all" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Keluar
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                                </div>
                            </div>
                        @endguest
                    </div>

                    {{-- Mobile Toggle --}}
                    <div class="flex items-center sm:hidden">
                        <button @click="open = !open" class="p-2 w-11 h-11 flex items-center justify-center rounded-xl bg-gray-50 text-gray-900 hover:bg-indigo-600 hover:text-white transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                                <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                </div>
            </div>

            {{-- Mobile Menu Panel --}}
            <div x-show="open" 
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="sm:hidden bg-white border-b border-gray-100 shadow-xl overflow-hidden">
                <div class="px-4 pt-2 pb-6 space-y-2">
                    @guest
                        <a href="{{ route('login') }}" class="block px-4 py-3 text-base font-bold text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition-all">Login</a>
                        <a href="{{ route('register') }}" class="block px-4 py-3 text-base font-bold bg-indigo-600 text-white rounded-xl shadow-md shadow-indigo-100">Register</a>
                    @else
                        <div class="flex items-center gap-3 px-4 py-4 mb-2 bg-indigo-50/50 rounded-2xl">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6366f1&color=fff&bold=true" class="w-10 h-10 rounded-xl shadow-sm" alt="Avatar">
                            <div>
                                <p class="text-sm font-black text-gray-900 leading-none">{{ Auth::user()->name }}</p>
                                <p class="text-[10px] text-indigo-500 font-bold uppercase mt-1">Admin Account</p>
                            </div>
                        </div>
                        <a href="/dashboard" class="block px-4 py-3 text-sm font-bold text-gray-600 hover:bg-gray-50 rounded-xl transition-all">Dashboard</a>
                        <a href="{{ route('logout') }}" 
                        class="block px-4 py-3 text-sm font-bold text-rose-600 hover:bg-rose-50 rounded-xl transition-all"
                        onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                            Keluar
                        </a>
                        <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                    @endguest
                </div>
            </div>

                </div>

                <div class="flex items-center md:hidden">
                    <button @click="open = !open" class="p-2.5 rounded-xl bg-gray-50 text-gray-600 hover:bg-gray-100 transition-all active:scale-90">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" style="display: none;" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <div x-show="open" 
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4"
            class="md:hidden bg-white border-t border-gray-50 px-4 py-6 space-y-3 shadow-2xl"
            style="display: none;">
            
            <a href="#beranda" @click="open = false" class="block w-full py-3 px-4 text-sm font-bold text-gray-600 hover:bg-gray-50 rounded-xl">Beranda</a>
            <a href="#fitur" @click="open = false" class="block w-full py-3 px-4 text-sm font-bold text-gray-600 hover:bg-gray-50 rounded-xl">Fitur</a>
            <a href="#faq" @click="open = false" class="block w-full py-3 px-4 text-sm font-bold text-gray-600 hover:bg-gray-50 rounded-xl">Bantuan</a>
            
            <hr class="border-gray-50 my-2">

            @guest
                <a href="{{ route('login') }}" class="block w-full text-center py-4 font-black text-xs uppercase tracking-widest text-gray-600 border border-gray-100 rounded-xl">Masuk</a>
                <a href="{{ route('register') }}" class="block w-full text-center py-4 bg-gray-900 text-white rounded-xl font-black text-xs uppercase tracking-widest">Daftar</a>
            @else
                <a href="{{ route('home') }}" class="block w-full text-center py-4 bg-indigo-600 text-white rounded-xl font-black text-xs uppercase tracking-widest shadow-lg shadow-indigo-100">Dashboard</a>
            @endguest
        </div>
    </nav>

    {{-- NOTIF LOGIN DENGAN GOOGLE --}}
    @if(session('success'))
        <div id="alert-success" class="fixed top-5 right-5 z-[100] transform transition-all duration-500 ease-in-out translate-y-0 opacity-100">
            <div class="rounded-[2rem] border border-emerald-100 bg-white p-4 shadow-2xl shadow-emerald-100/50 flex items-center gap-4 min-w-[300px]">
                {{-- Icon --}}
                <div class="flex-shrink-0 w-10 h-10 bg-emerald-50 rounded-full flex items-center justify-center">
                    <svg class="h-6 w-6 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                
                {{-- Text --}}
                <div>
                    <h3 class="text-sm font-black text-slate-800 uppercase tracking-tight">Success!</h3>
                    <p class="text-xs text-slate-500 font-medium">{{ session('success') }}</p>
                </div>

                {{-- Close Button (Opsional) --}}
                <button onclick="dismissAlert()" class="ml-auto text-slate-300 hover:text-slate-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
            </div>
        </div>

        <script>
            // Fungsi untuk menghilangkan alert
            function dismissAlert() {
                const alert = document.getElementById('alert-success');
                if(alert) {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-20px)';
                    setTimeout(() => {
                        alert.remove();
                    }, 500); // Tunggu animasi transisi selesai (500ms)
                }
            }

            // Set waktu otomatis hilang (3 detik)
            setTimeout(() => {
                dismissAlert();
            }, 3000);
        </script>
    @endif

    {{-- HERO SECTION --}}
    <section class="relative pt-24 pb-32 bg-white overflow-hidden" id="beranda">
        {{-- Decorative Ambient Background --}}
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full -z-10 overflow-hidden">
            <div class="absolute top-[-15%] left-[-5%] w-[50%] h-[50%] bg-indigo-200/30 rounded-full blur-[140px] animate-pulse"></div>
            <div class="absolute bottom-[20%] right-[-10%] w-[40%] h-[40%] bg-blue-200/20 rounded-full blur-[120px]"></div>
            {{-- Grid Background Overlay --}}
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-[0.03]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center relative">
            {{-- Badge --}}
            <div class="inline-flex items-center gap-3 px-5 py-2 rounded-full bg-white/80 backdrop-blur-md border border-indigo-50 shadow-sm mb-12 animate-fade-in-down">
                <span class="flex h-2 w-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                <span class="text-[11px] font-black text-indigo-600 uppercase tracking-[0.3em]">Smart Inventory v1.0 — 2026 Edition</span>
            </div>
            
            {{-- Main Headline --}}
            <h1 class="text-6xl lg:text-8xl font-black text-slate-900 tracking-tight mb-8 leading-[1]">
                Kelola Stok Barang <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-violet-600 to-indigo-600 bg-[length:200%_auto] animate-gradient-text italic">Tanpa Ribet.</span>
            </h1>
            
            {{-- Sub Headline --}}
            <p class="text-xl text-slate-500 max-w-3xl mx-auto mb-16 leading-relaxed font-medium">
                Satu platform terpadu untuk mengontrol aset gudang secara digital. Dapatkan laporan <span class="text-slate-900 font-bold underline decoration-indigo-500/30">akurat secara real-time</span> dan pantau pergerakan barang dalam satu genggaman.
            </p>

            {{-- Action Buttons --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6 mb-28">
                <a href="{{ route('register') }}" class="group relative w-full sm:w-auto px-12 py-5 bg-gray-900 text-white font-black rounded-2xl transition-all duration-300 hover:scale-105 active:scale-95 shadow-2xl shadow-indigo-200/50 flex items-center justify-center gap-3 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-violet-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <span class="relative z-10">Mulai Sekarang — Gratis</span>
                    <svg class="relative z-10 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 7l5 5m0 0l-5 5m5-5H6" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
                <a href="#fitur" class="w-full sm:w-auto px-12 py-5 bg-white text-gray-700 border border-gray-100 font-black rounded-2xl hover:bg-gray-50 transition-all shadow-sm flex items-center justify-center gap-2">
                    Lihat Demo Fitur
                </a>
            </div>

            {{-- Mockup Preview --}}
            <div class="relative max-w-6xl mx-auto">
                {{-- Decorative Elements --}}
                <div class="absolute -top-12 -left-12 w-32 h-32 bg-indigo-500/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-12 -right-12 w-48 h-48 bg-violet-500/10 rounded-full blur-3xl"></div>

                {{-- Main Image Frame --}}
                <div class="relative p-3 bg-white/50 backdrop-blur-sm border border-white/80 rounded-[3.5rem] shadow-[0_50px_100px_-20px_rgba(79,70,229,0.15)]">
                    <div class="relative overflow-hidden rounded-[2.8rem] bg-slate-900 border border-slate-800">
                        <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&q=80&w=2000" alt="Warehouse" class="w-full h-[350px] lg:h-[600px] object-cover opacity-90 hover:scale-105 transition-transform duration-700">
                        
                        {{-- Overlay Gradient on Image --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
                    </div>

                    {{-- Floating Card 1: Live Status --}}
                    <div class="absolute -bottom-10 -right-4 lg:-right-10 glass-card p-8 rounded-[2.5rem] shadow-[0_25px_50px_-12px_rgba(0,0,0,0.15)] w-80 text-left border border-white/50 animate-float">
                        <div class="flex items-center gap-4 mb-5">
                            <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-indigo-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">Stock Status</p>
                                <p class="text-sm font-bold text-indigo-600">Updated Just Now</p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex justify-between items-end">
                                <p class="text-4xl font-black text-slate-900 tracking-tighter">1,284 <span class="text-xs font-bold text-slate-400 uppercase">Pcs</span></p>
                                <span class="text-emerald-500 font-bold text-sm">+12%</span>
                            </div>
                            <div class="w-full bg-gray-100 h-2.5 rounded-full overflow-hidden">
                                <div class="bg-indigo-600 w-3/4 h-full rounded-full transition-all duration-1000"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Floating Card 2: Quick Action (Optional addition for beauty) --}}
                    <div class="absolute -top-10 -left-6 lg:-left-12 bg-white/90 backdrop-blur-md p-6 rounded-[2rem] shadow-xl border border-white hidden lg:flex items-center gap-4 animate-float-delayed">
                        <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                        </div>
                        <p class="text-sm font-black text-slate-800 tracking-tight">System Secure & Encrypted</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- STATS SECTION --}}
    <section class="py-24 relative bg-indigo-100 overflow-hidden">
        {{-- Background Ambient Glow --}}
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full max-w-4xl bg-indigo-100/30 blur-[120px] rounded-full -z-10"></div>

        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-8">
                
                {{-- Stat 1 --}}
                <div class="group relative bg-white/70 backdrop-blur-xl p-8 rounded-[3rem] border border-white/80 shadow-[0_20px_50px_rgba(79,70,229,0.05)] text-center transition-all duration-500 hover:shadow-indigo-200/40 hover:-translate-y-2">
                    <div class="absolute top-4 right-6 text-indigo-100 opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4V7z"/></svg>
                    </div>
                    <div class="relative">
                        <p class="text-5xl font-black text-indigo-600 mb-2 tracking-tighter transition-transform duration-500 group-hover:scale-110">99<span class="text-2xl text-indigo-400">%</span></p>
                        <div class="h-1 w-8 bg-indigo-100 mx-auto rounded-full mb-3 group-hover:w-12 transition-all"></div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Akurasi Data</p>
                    </div>
                </div>

                {{-- Stat 2 --}}
                <div class="group relative bg-white/70 backdrop-blur-xl p-8 rounded-[3rem] border border-white/80 shadow-[0_20px_50px_rgba(16,185,129,0.05)] text-center transition-all duration-500 hover:shadow-emerald-200/40 hover:-translate-y-2">
                    <div class="absolute top-4 right-6 text-emerald-100 opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                    </div>
                    <div class="relative">
                        <p class="text-5xl font-black text-emerald-500 mb-2 tracking-tighter transition-transform duration-500 group-hover:scale-110">24<span class="text-2xl text-emerald-300">/</span>7</p>
                        <div class="h-1 w-8 bg-emerald-100 mx-auto rounded-full mb-3 group-hover:w-12 transition-all"></div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Real-time Sync</p>
                    </div>
                </div>

                {{-- Stat 3 --}}
                <div class="group relative bg-white/70 backdrop-blur-xl p-8 rounded-[3rem] border border-white/80 shadow-[0_20px_50px_rgba(244,63,94,0.05)] text-center transition-all duration-500 hover:shadow-rose-200/40 hover:-translate-y-2">
                    <div class="absolute top-4 right-6 text-rose-100 opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l-5.5 9h11L12 2zm0 3.84L13.93 9h-3.87L12 5.84zM17.5 13c-2.49 0-4.5 2.01-4.5 4.5s2.01 4.5 4.5 4.5 4.5-2.01 4.5-4.5-2.01-4.5-4.5-4.5zm0 7a2.5 2.5 0 110-5 2.5 2.5 0 010 5zM5 13c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 6c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/></svg>
                    </div>
                    <div class="relative">
                        <p class="text-5xl font-black text-rose-500 mb-2 tracking-tighter transition-transform duration-500 group-hover:scale-110">10k<span class="text-2xl text-rose-300">+</span></p>
                        <div class="h-1 w-8 bg-rose-100 mx-auto rounded-full mb-3 group-hover:w-12 transition-all"></div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Items Managed</p>
                    </div>
                </div>

                {{-- Stat 4 --}}
                <div class="group relative bg-white/70 backdrop-blur-xl p-8 rounded-[3rem] border border-white/80 shadow-[0_20px_50px_rgba(245,158,11,0.05)] text-center transition-all duration-500 hover:shadow-amber-200/40 hover:-translate-y-2">
                    <div class="absolute top-4 right-6 text-amber-100 opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/></svg>
                    </div>
                    <div class="relative">
                        <p class="text-5xl font-black text-amber-500 mb-2 tracking-tighter transition-transform duration-500 group-hover:scale-110">Full</p>
                        <div class="h-1 w-8 bg-amber-100 mx-auto rounded-full mb-3 group-hover:w-12 transition-all"></div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Secure Cloud</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Content --}}
    <section class="w-full bg-[#F8FAFF] pt-7 pb-7 md:pt-20 md:pb-24">
        <div class="box-border flex flex-col items-center content-center px-8 mx-auto leading-6 text-black border-0 border-gray-300 border-solid md:flex-row max-w-7xl lg:px-16">

            <!-- Image -->
            <div class="box-border relative w-full max-w-md px-4 mt-5 mb-4 -ml-5 text-center bg-no-repeat bg-contain border-solid md:ml-0 md:mt-0 md:max-w-none lg:mb-0 md:w-1/2 xl:pl-10">
                <img src="https://cdn.devdojo.com/images/december2020/productivity.png" class="p-2 pl-6 pr-5 xl:pl-16 xl:pr-20 " />
            </div>

            <!-- Content -->
            <div class="box-border order-first w-full text-black border-solid md:w-1/2 md:pl-10 md:order-none">
                <h2 class="m-0 text-xl font-semibold leading-tight border-0 border-gray-300 lg:text-3xl md:text-2xl">
                    Boost Productivity
                </h2>
                <p class="pt-4 pb-8 m-0 leading-7 text-gray-700 border-0 border-gray-300 sm:pr-12 xl:pr-32 lg:text-lg">
                    Build an atmosphere that creates productivity in your organization and your company culture.
                </p>
                <ul class="p-0 m-0 leading-6 border-0 border-gray-300">
                    <li class="box-border relative py-1 pl-0 text-left text-gray-500 border-solid">
                        <span class="inline-flex items-center justify-center w-6 h-6 mr-2 text-white bg-yellow-300 rounded-full" data-primary="yellow-400"><span class="text-sm font-bold">✓</span></span> Maximize productivity and growth
                    </li>
                    <li class="box-border relative py-1 pl-0 text-left text-gray-500 border-solid">
                        <span class="inline-flex items-center justify-center w-6 h-6 mr-2 text-white bg-yellow-300 rounded-full" data-primary="yellow-400"><span class="text-sm font-bold">✓</span></span> Speed past your competition
                    </li>
                    <li class="box-border relative py-1 pl-0 text-left text-gray-500 border-solid">
                        <span class="inline-flex items-center justify-center w-6 h-6 mr-2 text-white bg-yellow-300 rounded-full" data-primary="yellow-400"><span class="text-sm font-bold">✓</span></span> Learn the top techniques
                    </li>
                </ul>
            </div>
            <!-- End  Content -->
        </div>
        <div class="box-border flex flex-col items-center content-center px-8 mx-auto mt-2 leading-6 text-black border-0 border-gray-300 border-solid md:mt-20 xl:mt-0 md:flex-row max-w-7xl lg:px-16">

            <!-- Content -->
            <div class="box-border w-full text-black border-solid md:w-1/2 md:pl-6 xl:pl-32">
                <h2 class="m-0 text-xl font-semibold leading-tight border-0 border-gray-300 lg:text-3xl md:text-2xl">
                    Automated Tasks
                </h2>
                <p class="pt-4 pb-8 m-0 leading-7 text-gray-700 border-0 border-gray-300 sm:pr-10 lg:text-lg">
                    Save time and money with our revolutionary services. We are the leaders in the industry.
                </p>
                <ul class="p-0 m-0 leading-6 border-0 border-gray-300">
                    <li class="box-border relative py-1 pl-0 text-left text-gray-500 border-solid">
                        <span class="inline-flex items-center justify-center w-6 h-6 mr-2 text-white bg-yellow-300 rounded-full" data-primary="yellow-400"><span class="text-sm font-bold">✓</span></span> Automated task management workflow
                    </li>
                    <li class="box-border relative py-1 pl-0 text-left text-gray-500 border-solid">
                        <span class="inline-flex items-center justify-center w-6 h-6 mr-2 text-white bg-yellow-300 rounded-full" data-primary="yellow-400"><span class="text-sm font-bold">✓</span></span> Detailed analytics for your data
                    </li>
                    <li class="box-border relative py-1 pl-0 text-left text-gray-500 border-solid">
                        <span class="inline-flex items-center justify-center w-6 h-6 mr-2 text-white bg-yellow-300 rounded-full" data-primary="yellow-400"><span class="text-sm font-bold">✓</span></span> Some awesome integrations
                    </li>
                </ul>
            </div>
            <!-- End  Content -->

            <!-- Image -->
            <div class="box-border relative w-full max-w-md px-4 mt-10 mb-4 text-center bg-no-repeat bg-contain border-solid md:mt-0 md:max-w-none lg:mb-0 md:w-1/2">
                <img src="https://cdn.devdojo.com/images/december2020/settings.png" class="pl-4 sm:pr-10 xl:pl-10 lg:pr-32" />
            </div>
        </div>
    </section>


    {{-- FEATURES SECTION --}}
    <section id="fitur" class="py-32 relative overflow-hidden bg-white">
        {{-- Decorative Background Elements --}}
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-[radial-gradient(#6366f1_1px,transparent_1px)] [background-size:40px_40px] opacity-[0.02]"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            {{-- Section Header --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-20 gap-6">
                <div class="max-w-2xl">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-50 text-indigo-600 mb-6">
                        <span class="w-1.5 h-1.5 rounded-full bg-indigo-600 animate-pulse"></span>
                        <span class="text-[10px] font-black uppercase tracking-[0.3em]">Workflow Kami</span>
                    </div>
                    <h2 class="text-4xl lg:text-5xl font-black text-slate-900 tracking-tighter leading-[1.1]">
                        Solusi All-in-One Untuk <br> 
                        <span class="text-indigo-600">Efisiensi</span> Inventaris Anda.
                    </h2>
                </div>
                <p class="text-slate-500 font-medium max-w-xs leading-relaxed border-l-2 border-indigo-100 pl-6">
                    Kami merancang sistem yang kompleks menjadi antarmuka yang sangat sederhana untuk digunakan.
                </p>
            </div>

            <div class="relative">
                {{-- Vertical Line (Desktop Only) --}}
                <div class="hidden md:block absolute left-1/2 -translate-x-1/2 top-0 bottom-0 w-[2px] bg-gradient-to-b from-transparent via-indigo-100 to-transparent"></div>

                <div class="space-y-32">
                    {{-- Step 01 --}}
                    <div class="relative flex flex-col md:flex-row items-center justify-between gap-12 lg:gap-24 group">
                        {{-- Number Circle --}}
                        <div class="hidden md:flex absolute left-1/2 -translate-x-1/2 items-center justify-center w-14 h-14 bg-white border-4 border-indigo-50 rounded-full z-20 transition-all duration-500 group-hover:border-indigo-600 group-hover:scale-110">
                            <span class="text-indigo-600 font-black">01</span>
                        </div>

                        <div class="flex-1 w-full order-2 md:order-1 text-center md:text-right">
                            <h3 class="text-3xl font-black text-slate-900 mb-6 tracking-tight">Input Master Data</h3>
                            <p class="text-slate-500 text-lg leading-relaxed mb-8 font-medium">
                                Daftarkan merek, dan data barang kamu. Kami akan secara otomatis mengatur struktur database yang optimal untuk pencarian cepat.
                            </p>
                            <a href="#" class="inline-flex items-center gap-2 text-indigo-600 font-bold hover:gap-4 transition-all uppercase text-xs tracking-widest">
                                Pelajari Selengkapnya 
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                        </div>

                        <div class="flex-1 w-full order-1 md:order-2">
                            <div class="relative p-2 bg-indigo-50/50 rounded-[3rem] overflow-hidden group-hover:rotate-2 transition-transform duration-500 shadow-2xl shadow-indigo-100/20">
                                <img src="{{ asset('genesis/assets/workflow1.png') }}" alt="step 1" class="rounded-[2.5rem] w-full h-auto object-cover border border-white shadow-sm" />
                            </div>
                        </div>
                    </div>

                    {{-- Step 02 --}}
                    <div class="relative flex flex-col md:flex-row items-center justify-between gap-12 lg:gap-24 group">
                        {{-- Number Circle --}}
                        <div class="hidden md:flex absolute left-1/2 -translate-x-1/2 items-center justify-center w-14 h-14 bg-white border-4 border-indigo-50 rounded-full z-20 transition-all duration-500 group-hover:border-emerald-500 group-hover:scale-110">
                            <span class="text-emerald-500 font-black">02</span>
                        </div>

                        <div class="flex-1 w-full">
                            <div class="relative p-2 bg-emerald-50/50 rounded-[3rem] overflow-hidden group-hover:-rotate-2 transition-transform duration-500 shadow-2xl shadow-emerald-100/20">
                                <img src="{{ asset('genesis/assets/workflow1.png') }}" alt="step 2" class="rounded-[2.5rem] w-full h-auto object-cover border border-white shadow-sm" />
                            </div>
                        </div>

                        <div class="flex-1 w-full text-center md:text-left">
                            <h3 class="text-3xl font-black text-slate-900 mb-6 tracking-tight">Transaksi Real-Time</h3>
                            <p class="text-slate-500 text-lg leading-relaxed mb-8 font-medium">
                                Catat barang masuk dan keluar dengan mudah. Sistem kami memperbarui stok secara otomatis sehingga kamu selalu memiliki data terkini.
                            </p>
                            <a href="#" class="inline-flex items-center gap-2 text-emerald-600 font-bold hover:gap-4 transition-all uppercase text-xs tracking-widest">
                                Pelajari Selengkapnya
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                        </div>
                    </div>

                    {{-- Step 03 --}}
                    <div class="relative flex flex-col md:flex-row items-center justify-between gap-12 lg:gap-24 group">
                        {{-- Number Circle --}}
                        <div class="hidden md:flex absolute left-1/2 -translate-x-1/2 items-center justify-center w-14 h-14 bg-white border-4 border-indigo-50 rounded-full z-20 transition-all duration-500 group-hover:border-amber-500 group-hover:scale-110">
                            <span class="text-amber-500 font-black">03</span>
                        </div>

                        <div class="flex-1 w-full order-2 md:order-1 text-center md:text-right">
                            <h3 class="text-3xl font-black text-slate-900 mb-6 tracking-tight">Generate Laporan Otomatis</h3>
                            <p class="text-slate-500 text-lg leading-relaxed mb-8 font-medium">
                                Selesai! Sekarang kamu bisa mendownload laporan stok dalam format PDF atau Excel kapanpun kamu butuhkan untuk kebutuhan audit.
                            </p>
                            <a href="#" class="inline-flex items-center gap-2 text-amber-600 font-bold hover:gap-4 transition-all uppercase text-xs tracking-widest">
                                Lihat Contoh Laporan 
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                        </div>

                        <div class="flex-1 w-full order-1 md:order-2">
                            <div class="relative p-2 bg-amber-50/50 rounded-[3rem] overflow-hidden group-hover:rotate-2 transition-transform duration-500 shadow-2xl shadow-amber-100/20">
                                <img src="{{ asset('genesis/assets/workflow1.png') }}" alt="step 3" class="rounded-[2.5rem] w-full h-auto object-cover border border-white shadow-sm" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- TESTIMONIALS SECTION --}}
    <section id="testimoni" class="py-32 bg-[#F8FAFF] relative overflow-hidden">
        {{-- Decorative Background --}}
        <div class="absolute top-0 right-0 w-[300px] h-[300px] bg-indigo-100/50 rounded-full blur-[100px] -z-10"></div>
        <div class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-blue-100/50 rounded-full blur-[100px] -z-10"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            {{-- Header --}}
            <div class="text-center mb-20">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-indigo-100 shadow-sm mb-6">
                    <span class="text-indigo-600">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </span>
                    <span class="text-[10px] font-black text-slate-600 uppercase tracking-[0.3em]">Testimoni Pengguna</span>
                </div>
                <h2 class="text-4xl lg:text-5xl font-black text-slate-900 tracking-tight mb-4">
                    Apa Kata <span class="text-indigo-600 italic">Mereka?</span>
                </h2>
                <p class="text-slate-500 font-medium max-w-lg mx-auto">Telah dipercaya oleh berbagai institusi untuk mengelola aset mereka secara profesional.</p>
            </div>

            <div class="items-center justify-center w-full mt-12 mb-4 lg:flex">
                <div class="flex flex-col items-start justify-start w-full h-auto mb-12 lg:w-1/3 lg:mb-0">
                    <div class="flex items-center justify-center">
                        <div class="w-16 h-16 mr-4 overflow-hidden bg-gray-200 rounded-full">
                            <img src="https://images.unsplash.com/photo-1527980965255-d3b416303d12?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1700&q=80"
                                class="object-cover w-full h-full">
                        </div>
                        <div class="flex flex-col items-start justify-center">
                            <h4 class="font-bold text-gray-800">John Doe</h4>
                            <p class="text-gray-600">CEO of Something</p>
                        </div>
                    </div>
                    <blockquote class="mt-8 text-lg text-gray-500">"This is a no-brainer if you want to take your business to the next level. If you are looking for the ultimate toolset, this is it!"</blockquote>
                </div>
                <div
                    class="flex flex-col items-start justify-start w-full h-auto px-0 mx-0 mb-12 border-l border-r border-transparent lg:w-1/3 lg:mb-0 lg:px-8 lg:mx-8 lg:border-gray-200">
                    <div class="flex items-center justify-center">
                        <div class="w-16 h-16 mr-4 overflow-hidden bg-gray-200 rounded-full">
                            <img src="https://images.unsplash.com/photo-1544725176-7c40e5a71c5e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2547&q=80"
                                class="object-cover w-full h-full">
                        </div>
                        <div class="flex flex-col items-start justify-center">
                            <h4 class="font-bold text-gray-800">Jane Doe</h4>
                            <p class="text-gray-600">CTO of Business</p>
                        </div>
                    </div>
                    <blockquote class="mt-8 text-lg text-gray-500">"Thanks for creating this service. My life is so much
                        easier.
                        Thanks for making such a great product."</blockquote>
                </div>
                <div class="flex flex-col items-start justify-start w-full h-auto lg:w-1/3">
                    <div class="flex items-center justify-center">
                        <div class="w-16 h-16 mr-4 overflow-hidden bg-gray-200 rounded-full">
                            <img src="https://images.unsplash.com/photo-1545167622-3a6ac756afa4?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1256&q=80"
                                class="object-cover w-full h-full">
                        </div>
                        <div class="flex flex-col items-start justify-center">
                            <h4 class="font-bold text-gray-800">John Smith</h4>
                            <p class="text-gray-600">Creator of Stuff</p>
                        </div>
                    </div>
                    <blockquote class="mt-8 text-lg text-gray-500">"Packed with awesome content and exactly what I was
                        looking
                        for. I would highly recommend this to anyone."</blockquote>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ SECTION --}}
    <section id="faq" class="py-32 bg-white relative overflow-hidden">
        {{-- Decorative Background --}}
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-[radial-gradient(#6366f1_1px,transparent_1px)] [background-size:40px_40px] opacity-[0.03]"></div>

        <div class="max-w-4xl mx-auto px-6 relative z-10">
            {{-- Header --}}
            <div class="text-center mb-20">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-indigo-50 border border-indigo-100 mb-6">
                    <span class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.3em]">Bantuan & Dukungan</span>
                </div>
                <h2 class="text-4xl lg:text-5xl font-black text-slate-900 tracking-tight mb-4">
                    Paling Sering <span class="text-indigo-600">Ditanyakan</span>
                </h2>
                <p class="text-slate-500 font-medium">Masih bingung? Mungkin jawaban di bawah bisa membantu kamu.</p>
            </div>

            {{-- FAQ Accordion --}}
            <div class="space-y-4" x-data="{ active: null }">
                
                {{-- Item 1 --}}
                <div class="group bg-white rounded-[2.5rem] border border-gray-100 shadow-sm transition-all duration-500"
                    :class="active === 1 ? 'ring-2 ring-indigo-500/10 shadow-xl shadow-indigo-100/50' : 'hover:border-indigo-200'">
                    <button @click="active = (active === 1 ? null : 1)" 
                            class="w-full px-10 py-7 text-left flex justify-between items-center group">
                        <div class="flex items-center gap-5">
                            <span class="flex-shrink-0 w-10 h-10 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-black text-sm transition-colors group-hover:bg-indigo-600 group-hover:text-white"
                                :class="active === 1 ? 'bg-indigo-600 text-white' : ''">01</span>
                            <span class="font-bold text-lg text-slate-800 tracking-tight">Gimana cara mulai pakai RynDev Smart Invenroty?</span>
                        </div>
                        <div class="w-8 h-8 rounded-full border border-gray-100 flex items-center justify-center transition-all duration-300"
                            :class="active === 1 ? 'rotate-180 bg-indigo-600 border-indigo-600 text-white' : 'text-gray-400'">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                    </button>
                    <div x-show="active === 1" x-collapse x-cloak>
                        <div class="px-10 pb-10 ml-15 text-slate-500 leading-relaxed font-medium">
                            Mudah Sekali! Tinggal klik tombol <span class="text-indigo-600 font-bold underline decoration-2 underline-offset-4">"Mulai Gratis"</span>, isi formulir pendaftaran, dan kamu sudah bisa langsung akses dashboard untuk kelola gudangmu sendiri tanpa perlu instalasi tambahan.
                        </div>
                    </div>
                </div>

                {{-- Item 2 --}}
                <div class="group bg-white rounded-[2.5rem] border border-gray-100 shadow-sm transition-all duration-500"
                    :class="active === 2 ? 'ring-2 ring-indigo-500/10 shadow-xl shadow-indigo-100/50' : 'hover:border-indigo-200'">
                    <button @click="active = (active === 2 ? null : 2)" class="w-full px-10 py-7 text-left flex justify-between items-center group">
                        <div class="flex items-center gap-5">
                            <span class="flex-shrink-0 w-10 h-10 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-black text-sm transition-colors group-hover:bg-indigo-600 group-hover:text-white"
                                :class="active === 2 ? 'bg-indigo-600 text-white' : ''">02</span>
                            <span class="font-bold text-lg text-slate-800 tracking-tight">Apakah datanya bisa diekspor ke PDF/Excel?</span>
                        </div>
                        <div class="w-8 h-8 rounded-full border border-gray-100 flex items-center justify-center transition-all duration-300"
                            :class="active === 2 ? 'rotate-180 bg-indigo-600 border-indigo-600 text-white' : 'text-gray-400'">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                    </button>
                    <div x-show="active === 2" x-collapse x-cloak>
                        <div class="px-10 pb-10 ml-15 text-slate-500 leading-relaxed font-medium">
                            Tentu! RynDev Smart Inventory mendukung ekspor data otomatis. Kamu bisa generate laporan stok bulanan, riwayat barang masuk/keluar, ke format <span class="text-emerald-600 font-bold">Excel</span> atau <span class="text-rose-600 font-bold">PDF</span> hanya dengan satu klik.
                        </div>
                    </div>
                </div>

                {{-- Item 3 --}}
                <div class="group bg-white rounded-[2.5rem] border border-gray-100 shadow-sm transition-all duration-500"
                    :class="active === 3 ? 'ring-2 ring-indigo-500/10 shadow-xl shadow-indigo-100/50' : 'hover:border-indigo-200'">
                    <button @click="active = (active === 3 ? null : 3)" class="w-full px-10 py-7 text-left flex justify-between items-center group">
                        <div class="flex items-center gap-5">
                            <span class="flex-shrink-0 w-10 h-10 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-black text-sm transition-colors group-hover:bg-indigo-600 group-hover:text-white"
                                :class="active === 3 ? 'bg-indigo-600 text-white' : ''">03</span>
                            <span class="font-bold text-lg text-slate-800 tracking-tight">Apakah aman untuk data sekolah?</span>
                        </div>
                        <div class="w-8 h-8 rounded-full border border-gray-100 flex items-center justify-center transition-all duration-300"
                            :class="active === 3 ? 'rotate-180 bg-indigo-600 border-indigo-600 text-white' : 'text-gray-400'">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                    </button>
                    <div x-show="active === 3" x-collapse x-cloak>
                        <div class="px-10 pb-10 ml-15 text-slate-500 leading-relaxed font-medium">
                            Sangat aman. Kami menggunakan enkripsi standar industri dan sistem backup berkala. Data inventaris sekolah kamu terjaga kerahasiaannya dan hanya bisa diakses oleh akun admin yang terdaftar.
                        </div>
                    </div>
                </div>

            </div>

            {{-- Footer FAQ --}}
            <div class="mt-16 text-center">
                <p class="text-slate-500 text-sm font-medium">
                    Punya pertanyaan lain? 
                    <a href="https://wa.me/+6288222150964" class="text-indigo-600 font-bold hover:underline">Hubungi kami di WhatsApp</a>
                </p>
            </div>
        </div>
    </section>

    {{-- CTA SECTION --}}
    <section class="py-24 px-6 relative overflow-hidden">
        <div class="max-w-6xl mx-auto relative">
            {{-- Floating Ornament --}}
            <div class="absolute -top-10 -left-10 w-20 h-20 bg-indigo-500 rounded-2xl rotate-12 opacity-20 blur-xl animate-pulse"></div>
            
            <div class="bg-gray-900 rounded-[3rem] lg:rounded-[4rem] p-8 lg:p-20 text-center text-white relative overflow-hidden shadow-[0_32px_64px_-16px_rgba(79,70,229,0.2)]">
                
                {{-- Background Elements --}}
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-600 via-indigo-700 to-violet-800 opacity-95"></div>
                <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full -mr-48 -mt-48 blur-[100px]"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-indigo-400/20 rounded-full -ml-48 -mb-48 blur-[80px]"></div>
                
                {{-- Grid Pattern Overlay --}}
                <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 30px 30px;"></div>

                <div class="relative z-10">
                    {{-- Badge --}}
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-8">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-100">Trusted by 100+ Schools</span>
                    </div>

                    <h2 class="text-4xl lg:text-7xl font-black mb-8 leading-[1.1] tracking-tight">
                        Siap Digitalisasi <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-200 to-white italic">Gudangmu?</span>
                    </h2>

                    <p class="text-indigo-100/80 text-lg lg:text-xl mb-12 max-w-2xl mx-auto font-medium leading-relaxed">
                        Gabung dengan <span class="text-white font-bold">RynDev</span> dan rasakan kemudahan mengelola aset tanpa pusing pencatatan manual lagi. Efisien, Akurat, dan Modern.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                        <a href="{{ route('register') }}" 
                        class="group relative inline-flex items-center gap-3 px-10 py-5 bg-white text-indigo-900 font-black rounded-2xl transition-all hover:bg-indigo-50 shadow-[0_20px_40px_-15px_rgba(255,255,255,0.3)] hover:scale-105 active:scale-95">
                            Daftar Sekarang — Gratis!
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                        
                        <a href="#fitur" class="text-sm font-bold text-white/80 hover:text-white transition-colors border-b border-white/20 hover:border-white pb-1">
                            Lihat Cara Kerja
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-[#0B0F1A] pt-32 pb-16 relative overflow-hidden">
        {{-- Background Glow --}}
        <div class="absolute top-0 left-1/4 w-64 h-64 bg-indigo-600/10 rounded-full blur-[120px] -z-10"></div>
        
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 pb-20 border-b border-white/5">
                
                {{-- Brand Section --}}
                <div class="lg:col-span-5 flex flex-col items-center md:items-start gap-8">
                    <div class="flex items-center gap-5">
                        <div class="relative group">
                            <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                            <img src="{{ asset('logo.png') }}" alt="Logo" class="relative w-16 h-16 rounded-2xl border border-white/10 shadow-2xl">
                        </div>
                        <div class="text-left">
                            <p class="text-white font-black text-3xl tracking-tighter leading-none">Ryn<span class="text-indigo-500">Dev</span></p>
                            <p class="text-indigo-400/60 text-[10px] mt-2 uppercase tracking-[0.4em] font-black">Modern Warehouse Solution</p>
                        </div>
                    </div>
                    <p class="text-gray-400 text-lg max-w-sm text-center md:text-left leading-relaxed font-medium">
                        Membantu sekolah dan UMKM mendigitalisasi aset mereka dengan sistem manajemen stok yang <span class="text-white font-bold italic">presisi & efisien.</span>
                    </p>
                </div>
                
                {{-- Navigation/Links Section --}}
                <div class="lg:col-span-4 grid grid-cols-2 gap-8 w-full">
                    <div class="flex flex-col gap-6 items-center md:items-start">
                        <p class="text-xs font-black text-white uppercase tracking-[0.3em] opacity-50">Quick Links</p>
                        <ul class="space-y-4">
                            <li><a href="#beranda" class="text-gray-400 hover:text-indigo-400 transition-colors text-sm font-bold">Beranda</a></li>
                            <li><a href="#fitur" class="text-gray-400 hover:text-indigo-400 transition-colors text-sm font-bold">Fitur Utama</a></li>
                            <li><a href="#faq" class="text-gray-400 hover:text-indigo-400 transition-colors text-sm font-bold">FAQ</a></li>
                        </ul>
                    </div>
                    <div class="flex flex-col gap-6 items-center md:items-start">
                        <p class="text-xs font-black text-white uppercase tracking-[0.3em] opacity-50">Legal</p>
                        <ul class="space-y-4">
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors text-sm font-bold">Privacy Policy</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors text-sm font-bold">Terms of Service</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors text-sm font-bold">Cookie Policy</a></li>
                        </ul>
                    </div>
                </div>

                {{-- Social/Contact Section --}}
                <div class="lg:col-span-3 flex flex-col gap-8 items-center md:items-start">
                    <p class="text-xs font-black text-white uppercase tracking-[0.3em] opacity-50">Stay Connected</p>
                    <div class="flex flex-col gap-5">
                        {{-- Social Buttons (Keep as requested) --}}
                        <a href="https://www.instagram.com/rdiettyaa" class="group w-12 hover:w-48 h-12 bg-gradient-to-r from-purple-500 via-pink-500 to-orange-500 relative rounded-2xl text-white duration-700 font-bold flex justify-start gap-2 items-center p-2 pr-6 before:absolute before:-z-10 before:left-8 before:hover:left-40 before:w-6 before:h-6 before:bg-pink-600 before:hover:bg-pink-500 before:rotate-45 before:duration-700">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8 shrink-0 fill-white">
                                <path d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4H7.6m9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8 1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5 5 5 0 0 1-5 5 5 5 0 0 1-5-5 5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3 3 3 0 0 0 3 3 3 3 0 0 0 3-3 3 3 0 0 0-3-3z"/>
                            </svg>
                            <span class="origin-left inline-flex duration-100 group-hover:duration-300 group-hover:delay-500 opacity-0 group-hover:opacity-100 border-l border-white/30 px-2 transform scale-x-0 group-hover:scale-x-100 transition-all">Instagram</span>
                        </a>
                        
                        <a href="https://www.tiktok.com/@rdietyyaa" class="group w-12 hover:w-48 h-12 bg-black relative rounded-2xl text-white duration-700 font-bold flex justify-start gap-2 items-center p-2 pr-6 before:absolute before:-z-10 before:left-8 before:hover:left-40 before:w-6 before:h-6 before:bg-red-500 before:hover:bg-red-400 before:rotate-45 before:duration-700 border border-white/10">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8 shrink-0 fill-white">
                                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                            </svg>
                            <span class="origin-left inline-flex duration-100 group-hover:duration-300 group-hover:delay-500 opacity-0 group-hover:opacity-100 border-l border-white/30 px-2 transform scale-x-0 group-hover:scale-x-100 transition-all tracking-tight">TikTok</span>
                        </a>
                    </div>
                </div>
            </div>
            
            {{-- Bottom Copyright --}}
            <div class="mt-12 flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-gray-500 text-[11px] font-bold uppercase tracking-[0.5em] text-center md:text-left">
                    &copy; {{ date('Y') }} Ryn Dev Studio. <span class="text-indigo-500/50">Indonesia.</span>
                </p>
                <div class="flex items-center gap-2">
                    <span class="text-gray-600 text-[10px] font-black uppercase tracking-widest">Powered by</span>
                    <span class="text-white text-[10px] font-black uppercase tracking-widest bg-white/5 px-3 py-1 rounded-full border border-white/10">Laravel 12 x Tailwind</span>
                </div>
            </div>
            
        </div>
    </footer>

</body>
</html>