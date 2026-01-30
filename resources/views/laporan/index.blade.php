@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 pb-20">
    {{-- Header Section --}}
    <div class="mb-12">
        <h1 class="text-4xl font-black text-slate-900 tracking-tight italic">PUSAT LAPORAN <span class="text-indigo-600">.</span></h1>
        <p class="text-slate-500 font-medium mt-2 uppercase tracking-widest text-xs">Pilih jenis dokumen untuk di-generate menjadi PDF</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        
        {{-- Card 1: Stok Barang (Static) --}}
        <div class="group bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm hover:shadow-2xl hover:shadow-indigo-100 transition-all duration-500">
            <div class="w-16 h-16 bg-indigo-50 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
            <h3 class="text-xl font-black text-slate-800 uppercase tracking-tighter">Stok Barang</h3>
            <p class="text-sm text-slate-400 mt-2 mb-8 leading-relaxed">Mencetak seluruh daftar inventaris beserta jumlah sisa stok terbaru saat ini secara real-time.</p>
            
            <a href="{{ route('laporan.barang') }}" target="_blank" 
               class="flex items-center justify-center gap-3 w-full py-4 bg-slate-900 text-white rounded-2xl font-black text-xs uppercase tracking-[0.2em] hover:bg-indigo-600 transition-all shadow-xl shadow-slate-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Cetak Stok Sekarang
            </a>
        </div>

        {{-- Card 2: Peminjaman (Filter) --}}
        <div class="group bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm hover:shadow-2xl hover:shadow-violet-100 transition-all duration-500 border-t-4 border-t-violet-500">
            <div class="w-16 h-16 bg-violet-50 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                <svg class="w-8 h-8 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
            <h3 class="text-xl font-black text-slate-800 uppercase tracking-tighter">Laporan Peminjaman</h3>
            <p class="text-sm text-slate-400 mt-2 mb-6">Filter data peminjaman berdasarkan tanggal pinjam untuk laporan bulanan/mingguan.</p>
            
            <form action="{{ route('laporan.peminjaman') }}" method="GET" target="_blank" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase ml-1">Dari</label>
                        <input type="date" name="tgl_awal" required class="w-full mt-1 px-4 py-3 bg-slate-50 border-none rounded-xl text-xs font-bold focus:ring-2 focus:ring-violet-500 outline-none">
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase ml-1">Sampai</label>
                        <input type="date" name="tgl_akhir" required class="w-full mt-1 px-4 py-3 bg-slate-50 border-none rounded-xl text-xs font-bold focus:ring-2 focus:ring-violet-500 outline-none">
                    </div>
                </div>
                <button type="submit" class="w-full py-4 bg-violet-600 text-white rounded-2xl font-black text-xs uppercase tracking-[0.2em] hover:bg-violet-700 transition-all shadow-xl shadow-violet-100">
                    Export Peminjaman
                </button>
            </form>
        </div>

        {{-- Card 3: Barang Masuk (Filter) --}}
        <div class="group bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm hover:shadow-2xl hover:shadow-emerald-100 transition-all duration-500 border-t-4 border-t-emerald-500">
            <div class="w-16 h-16 bg-emerald-50 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
            <h3 class="text-xl font-black text-slate-800 uppercase tracking-tighter">Barang Masuk</h3>
            <form action="{{ route('laporan.masuk') }}" method="GET" target="_blank" class="space-y-4 mt-8">
                <div class="grid grid-cols-2 gap-4">
                    <input type="date" name="tgl_awal" required class="w-full px-4 py-3 bg-slate-50 border-none rounded-xl text-xs font-bold focus:ring-2 focus:ring-emerald-500">
                    <input type="date" name="tgl_akhir" required class="w-full px-4 py-3 bg-slate-50 border-none rounded-xl text-xs font-bold focus:ring-2 focus:ring-emerald-500">
                </div>
                <button type="submit" class="w-full py-4 bg-emerald-600 text-white rounded-2xl font-black text-xs uppercase tracking-[0.2em] hover:bg-emerald-700 transition-all">
                    Export Barang Masuk
                </button>
            </form>
        </div>

        {{-- Card 4: Barang Keluar (Filter) --}}
        <div class="group bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm hover:shadow-2xl hover:shadow-rose-100 transition-all duration-500 border-t-4 border-t-rose-500">
            <div class="w-16 h-16 bg-rose-50 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                <svg class="w-8 h-8 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
            <h3 class="text-xl font-black text-slate-800 uppercase tracking-tighter">Barang Keluar</h3>
            <form action="{{ route('laporan.keluar') }}" method="GET" target="_blank" class="space-y-4 mt-8">
                <div class="grid grid-cols-2 gap-4">
                    <input type="date" name="tgl_awal" required class="w-full px-4 py-3 bg-slate-50 border-none rounded-xl text-xs font-bold focus:ring-2 focus:ring-rose-500">
                    <input type="date" name="tgl_akhir" required class="w-full px-4 py-3 bg-slate-50 border-none rounded-xl text-xs font-bold focus:ring-2 focus:ring-rose-500">
                </div>
                <button type="submit" class="w-full py-4 bg-rose-600 text-white rounded-2xl font-black text-xs uppercase tracking-[0.2em] hover:bg-rose-700 transition-all">
                    Export Barang Keluar
                </button>
            </form>
        </div>

    </div>

    {{-- Footer Info --}}
    <div class="mt-16 p-8 bg-slate-900 rounded-[3rem] text-center shadow-2xl shadow-slate-300">
        <p class="text-slate-400 text-sm font-medium tracking-wide">
            Sistem Dokumen Otomatis v1.0 • <span class="text-white font-black italic">Generated for {{ Auth::user()->name }}</span>
        </p>
    </div>
</div>
@endsection