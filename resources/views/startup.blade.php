<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris Barang | RynDev Smart Solution</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.3); }
        .text-gradient {
            background: linear-gradient(to right, #4f46e5, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
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
    <nav class="bg-white/70 backdrop-blur-xl sticky top-0 z-50 border-b border-gray-200/50" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="group flex items-center gap-4 transition-all duration-500">
                        <div class="relative">
                            <img src="{{ asset('logo.png') }}" alt="Logo" class="w-11 h-11 rounded-xl shadow-xl group-hover:rotate-6 transition-all duration-500">
                            <div class="absolute -inset-1 bg-indigo-500 rounded-xl blur opacity-0 group-hover:opacity-20 transition duration-500"></div>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xl font-black tracking-tight text-gray-900 leading-none">Ryn<span class="text-indigo-600">Dev</span></span>
                            <span class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] mt-1.5 opacity-80">Smart Inventory</span>
                        </div>
                    </a>
                </div>

                <div class="hidden sm:flex sm:items-center sm:gap-8">
                    <a href="#beranda" class="text-sm font-bold text-gray-500 hover:text-indigo-600 transition-colors">Beranda</a>
                    <a href="#fitur" class="text-sm font-bold text-gray-500 hover:text-indigo-600 transition-colors">Fitur</a>
                    <a href="#faq" class="text-sm font-bold text-gray-500 hover:text-indigo-600 transition-colors">Bantuan</a>
                    <div class="h-6 w-px bg-gray-200 mx-2"></div>
                    @guest
                        <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-indigo-600">Login</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-2.5 bg-gray-900 text-white text-sm font-bold rounded-xl hover:bg-indigo-600 transition-all shadow-md active:scale-95">Mulai Gratis</a>
                    @else
                        <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-2.5 bg-indigo-600 text-white text-sm font-bold rounded-xl hover:bg-indigo-700 transition-all shadow-lg">Dashboard</a>
                    @endguest
                </div>

                <div class="flex items-center sm:hidden">
                    <button @click="open = !open" class="p-2.5 rounded-xl bg-gray-50 text-gray-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <div x-show="open" x-transition class="sm:hidden bg-white border-t border-gray-100 px-4 py-6 space-y-4">
             @guest
                <a href="{{ route('login') }}" class="block w-full text-center py-3 font-bold text-gray-600">Login</a>
                <a href="{{ route('register') }}" class="block w-full text-center py-3 bg-indigo-600 text-white rounded-xl font-bold">Mulai Gratis</a>
             @else
                <a href="{{ route('home') }}" class="block w-full text-center py-3 bg-indigo-600 text-white rounded-xl font-bold">Dashboard</a>
             @endguest
        </div>
    </nav>

    {{-- HERO SECTION --}}
    <section class="relative pt-16 pb-20 overflow-hidden" id="beranda">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full -z-10">
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-indigo-100/40 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-[10%] right-[-5%] w-[30%] h-[30%] bg-blue-100/40 rounded-full blur-[100px]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-gray-100 shadow-sm mb-10">
                <span class="flex h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-[11px] font-bold text-gray-500 uppercase tracking-[0.2em]">Smart Inventory v1.0</span>
            </div>
            
            <h1 class="text-5xl lg:text-7xl font-extrabold text-slate-900 tracking-tight mb-8 leading-[1.1]">
                Kelola Stok Barang <br>
                <span class="text-gradient font-black">Tanpa Ribet.</span>
            </h1>
            
            <p class="text-lg text-slate-500 max-w-2xl mx-auto mb-12 leading-relaxed font-medium">
                Satu platform terpadu untuk mengontrol aset gudang secara digital. Dapatkan laporan akurat dan pantau pergerakan barang dalam satu genggaman.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-24">
                <a href="{{ route('register') }}" class="group w-full sm:w-auto px-10 py-4.5 bg-gray-900 text-white font-bold rounded-2xl hover:bg-indigo-600 transition-all duration-300 shadow-2xl flex items-center justify-center gap-3">
                    Mulai Sekarang
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 7l5 5m0 0l-5 5m5-5H6" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
                <a href="#fitur" class="w-full sm:w-auto px-10 py-4.5 bg-white text-gray-600 border border-gray-200 font-bold rounded-2xl hover:bg-gray-50 transition-all flex items-center justify-center">
                    Lihat Fitur
                </a>
            </div>

            {{-- Mockup --}}
            <div class="relative max-w-5xl mx-auto">
                <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-[3rem] blur opacity-10"></div>
                <div class="relative bg-white border border-gray-100 rounded-[2.8rem] shadow-2xl p-2.5">
                    <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&q=80&w=2000" alt="Warehouse" class="rounded-[2.5rem] w-full h-[300px] lg:h-[500px] object-cover">
                    
                    <div class="absolute -bottom-8 -right-8 hidden lg:block glass-card p-8 rounded-[2rem] shadow-2xl w-72 text-left animate-bounce-slow">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-indigo-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                            </div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none">Live Status<br><span class="text-indigo-600">Updated</span></p>
                        </div>
                        <p class="text-3xl font-black text-slate-900 italic">1,284 <span class="text-sm font-medium text-slate-400 not-italic uppercase">Pcs</span></p>
                        <div class="w-full bg-gray-100 h-2 rounded-full mt-5 overflow-hidden">
                            <div class="bg-indigo-500 w-3/4 h-full rounded-full"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- STATS SECTION --}}
    <section class="py-20 relative z-20">
        <div class="max-w-5xl mx-auto px-6">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white/60 backdrop-blur-md p-8 rounded-[2.5rem] border border-white shadow-xl shadow-indigo-100/20 text-center hover:-translate-y-2 transition-all duration-300">
                    <p class="text-4xl font-black text-indigo-600 mb-1 leading-none">99%</p>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-2">Akurasi</p>
                </div>
                <div class="bg-white/60 backdrop-blur-md p-8 rounded-[2.5rem] border border-white shadow-xl shadow-indigo-100/20 text-center hover:-translate-y-2 transition-all duration-300">
                    <p class="text-4xl font-black text-emerald-500 mb-1 leading-none">24/7</p>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-2">Real-time</p>
                </div>
                <div class="bg-white/60 backdrop-blur-md p-8 rounded-[2.5rem] border border-white shadow-xl shadow-indigo-100/20 text-center hover:-translate-y-2 transition-all duration-300">
                    <p class="text-4xl font-black text-rose-500 mb-1 leading-none">10k+</p>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-2">Items</p>
                </div>
                <div class="bg-white/60 backdrop-blur-md p-8 rounded-[2.5rem] border border-white shadow-xl shadow-indigo-100/20 text-center hover:-translate-y-2 transition-all duration-300">
                    <p class="text-4xl font-black text-amber-500 mb-1 leading-none">Secure</p>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-2">Cloud Data</p>
                </div>
            </div>
        </div>
    </section>

    {{-- FEATURES SECTION --}}
    <section id="fitur" class="py-32 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-24">
                <h2 class="text-xs font-black text-indigo-600 uppercase tracking-[0.4em] mb-4">Workflow Kami</h2>
                <p class="text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">Solusi All-in-One Untuk <br> Efisiensi Bisnis.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                {{-- Card 1 --}}
                <div class="group p-10 rounded-[3rem] bg-[#F8FAFF] border border-transparent hover:border-indigo-100 hover:bg-white hover:shadow-2xl transition-all duration-500">
                    <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-3xl mb-10 group-hover:bg-indigo-600 group-hover:text-white group-hover:rotate-6 transition-all duration-500">📦</div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4 italic">Master Data</h3>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium">Data barang, merek, dan kategori terorganisir sempurna tanpa duplikasi.</p>
                </div>
                {{-- Card 2 --}}
                <div class="group p-10 rounded-[3rem] bg-[#F8FAFF] border border-transparent hover:border-emerald-100 hover:bg-white hover:shadow-2xl transition-all duration-500">
                    <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-3xl mb-10 group-hover:bg-emerald-600 group-hover:text-white group-hover:rotate-6 transition-all duration-500">📥</div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4 italic">Barang Masuk</h3>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium">Catat setiap stok masuk dengan detail vendor dan waktu kedatangan otomatis.</p>
                </div>
                {{-- Card 3 --}}
                <div class="group p-10 rounded-[3rem] bg-[#F8FAFF] border border-transparent hover:border-rose-100 hover:bg-white hover:shadow-2xl transition-all duration-500">
                    <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-3xl mb-10 group-hover:bg-rose-600 group-hover:text-white group-hover:rotate-6 transition-all duration-500">📤</div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4 italic">Barang Keluar</h3>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium">Validasi pengeluaran barang dengan sistem otorisasi yang ketat dan aman.</p>
                </div>
                {{-- Card 4 --}}
                <div class="group p-10 rounded-[3rem] bg-[#F8FAFF] border border-transparent hover:border-amber-100 hover:bg-white hover:shadow-2xl transition-all duration-500">
                    <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-3xl mb-10 group-hover:bg-amber-500 group-hover:text-white group-hover:rotate-6 transition-all duration-500">📄</div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4 italic">Laporan PDF</h3>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium">Cetak laporan inventaris harian, mingguan, atau bulanan hanya dalam satu klik.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ SECTION --}}
    <section id="faq" class="py-32 bg-[#F8FAFF]">
        <div class="max-w-3xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-xs font-black text-indigo-600 uppercase tracking-[0.4em] mb-4">FAQ</h2>
                <p class="text-4xl font-extrabold text-slate-900 tracking-tight">Paling Sering Ditanyakan</p>
            </div>
            <div class="space-y-4" x-data="{ active: null }">
                <div class="bg-white rounded-[2rem] border border-gray-100 overflow-hidden shadow-sm transition-all duration-300">
                    <button @click="active = (active === 1 ? null : 1)" class="w-full px-8 py-6 text-left flex justify-between items-center font-bold text-slate-700 hover:bg-gray-50 transition-colors">
                        Gimana cara mulai pakai RynDev?
                        <svg class="w-5 h-5 transition-transform duration-300" :class="active === 1 ? 'rotate-180 text-indigo-600' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                    <div x-show="active === 1" x-collapse x-cloak class="px-8 pb-8 text-sm text-gray-500 leading-relaxed font-medium border-t border-gray-50 pt-4">
                        Mudah Sekali! Tinggal klik tombol <span class="text-indigo-600 font-bold">"Mulai Gratis"</span> di atas, isi formulir pendaftaran, dan kamu sudah bisa langsung akses dashboard untuk kelola gudangmu sendiri.
                    </div>
                </div>

                <div class="bg-white rounded-[2rem] border border-gray-100 overflow-hidden shadow-sm transition-all duration-300">
                    <button @click="active = (active === 2 ? null : 2)" class="w-full px-8 py-6 text-left flex justify-between items-center font-bold text-slate-700 hover:bg-gray-50 transition-colors">
                        Apakah datanya bisa diekspor ke PDF?
                        <svg class="w-5 h-5 transition-transform duration-300" :class="active === 2 ? 'rotate-180 text-indigo-600' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                    <div x-show="active === 2" x-collapse x-cloak class="px-8 pb-8 text-sm text-gray-500 leading-relaxed font-medium border-t border-gray-50 pt-4">
                        Tentu! RynDev mendukung ekspor data ke format PDF dan Excel di versi pro, memudahkan kamu buat bikin laporan fisik atau audit stok sewaktu-waktu.
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA SECTION --}}
    <section class="py-24 px-6">
        <div class="max-w-6xl mx-auto bg-indigo-600 rounded-[4rem] p-12 lg:p-24 text-center text-white relative overflow-hidden shadow-2xl shadow-indigo-200">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-indigo-400/20 rounded-full -ml-32 -mb-32 blur-3xl"></div>
            
            <div class="relative z-10">
                <h2 class="text-4xl lg:text-6xl font-black mb-8 italic">Siap Digitalisasi Gudangmu?</h2>
                <p class="text-indigo-100 text-lg mb-12 max-w-xl mx-auto font-medium">Gabung dengan RynDev dan rasakan kemudahan mengelola aset tanpa pusing pencatatan manual lagi.</p>
                <a href="{{ route('register') }}" class="inline-flex px-12 py-5 bg-white text-indigo-600 font-black rounded-[2rem] hover:bg-gray-100 transition-all shadow-2xl hover:scale-105 active:scale-95">
                    Daftar Sekarang - Gratis!
                </a>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-gray-900 pt-24 pb-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-12 pb-16 border-b border-white/5">
                <div class="flex flex-col items-center md:items-start gap-6">
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('logo.png') }}" alt="Logo" class="w-14 h-14 rounded-2xl shadow-xl border border-white/10 opacity-80">
                        <div class="text-left">
                            <p class="text-white font-black text-2xl tracking-tighter leading-none">Ryn<span class="text-indigo-400">Dev</span></p>
                            <p class="text-gray-500 text-[10px] mt-2 uppercase tracking-[0.4em] font-black">Inventaris System</p>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm max-w-xs text-center md:text-left leading-relaxed font-medium">Solusi manajemen stok paling fleksibel dan modern untuk bisnis masa kini.</p>
                    
                </div>
                {{-- https://www.tiktok.com/@rdietyyaa --}}
                
                <div class="flex flex-wrap justify-center gap-10">
                    <div class="flex flex-col gap-4 items-center md:items-start">
                        <p class="text-xs font-black text-white uppercase tracking-widest">Kontak</p>
                        <a href="https://www.instagram.com/rdiettyaa" class="group w-12 hover:w-44 h-12 bg-gradient-to-r from-purple-500 via-pink-500 to-orange-500 relative rounded text-white duration-700 font-bold flex justify-start gap-2 items-center p-2 pr-6 before:absolute before:-z-10 before:left-8 before:hover:left-40 before:w-6 before:h-6 before:bg-pink-600 before:hover:bg-pink-500 before:rotate-45 before:duration-700">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8 shrink-0 fill-white">
                                <path d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4H7.6m9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8 1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5 5 5 0 0 1-5 5 5 5 0 0 1-5-5 5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3 3 3 0 0 0 3 3 3 3 0 0 0 3-3 3 3 0 0 0-3-3z"/>
                            </svg>
                            <span class="origin-left inline-flex duration-100 group-hover:duration-300 group-hover:delay-500 opacity-0 group-hover:opacity-100 border-l-2 px-1 transform scale-x-0 group-hover:scale-x-100 transition-all">@rdiettyaa</span>
                        </a>
                        <a href="https://www.tiktok.com/@rdietyyaa" class="group w-12 hover:w-44 h-12 bg-black relative rounded text-white duration-700 font-bold flex justify-start gap-2 items-center p-2 pr-6 before:absolute before:-z-10 before:left-8 before:hover:left-40 before:w-6 before:h-6 before:bg-red-500 before:hover:bg-red-400 before:rotate-45 before:duration-700">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8 shrink-0 fill-white">
                                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                            </svg>
                            <span class="origin-left inline-flex duration-100 group-hover:duration-300 group-hover:delay-500 opacity-0 group-hover:opacity-100 border-l-2 px-1 transform scale-x-0 group-hover:scale-x-100 transition-all">@rdietyyaa</span>
                        </a>
                    </div>
                    <div class="flex flex-col gap-4 items-center md:items-start">
                        <p class="text-xs font-black text-white uppercase tracking-widest">Legal</p>
                        <div class="flex gap-6">
                            <a href="#" class="text-gray-500 hover:text-white transition text-xs font-bold uppercase tracking-widest leading-none">Privacy</a>
                            <a href="#" class="text-gray-500 hover:text-white transition text-xs font-bold uppercase tracking-widest leading-none">Terms</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-12 text-center">
                <p class="text-gray-600 text-[11px] font-bold uppercase tracking-[0.5em]">
                    &copy; {{ date('Y') }} Ryn Dev Studio. <span class="text-gray-500">Handcrafted in Indonesia.</span>
                </p>
            </div>
        </div>
    </footer>

</body>
</html>