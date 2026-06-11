@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 pb-16 select-none space-y-8">
    
    <div class="border-b border-slate-100 pb-5">
        <h1 class="text-xl font-bold text-slate-900 tracking-tight">Pusat Dokumen & Laporan</h1>
        <p class="text-xs font-medium text-slate-400 mt-1">Pilih dan tentukan rentang parameter data untuk men-generate dokumen resmi cetak PDF.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <div class="bg-white rounded-xl border border-slate-100 p-6 shadow-[0_1px_2px_rgba(0,0,0,0.01)] flex flex-col justify-between group">
            <div>
                <div class="w-10 h-10 bg-slate-50 text-slate-700 rounded-lg flex items-center justify-center mb-4 border border-slate-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-slate-800 tracking-tight">Laporan Stok Manunggal</h3>
                <p class="text-xs text-slate-400 mt-1 mb-6 leading-relaxed">Mencetak akumulasi seluruh daftar aset inventaris beserta sisa kuantitas stok terbaru saat ini secara real-time.</p>
            </div>
            
            <a href="{{ route('laporan.barang') }}" target="_blank" 
               class="h-10 w-full bg-slate-900 text-white rounded-lg font-semibold text-xs transition-colors hover:bg-slate-800 flex items-center justify-center gap-2 shadow-sm">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Cetak Dokumen Stok
            </a>
        </div>

        <div class="bg-white rounded-xl border border-slate-100 p-6 shadow-[0_1px_2px_rgba(0,0,0,0.01)] flex flex-col justify-between">
            <div>
                <div class="w-10 h-10 bg-slate-50 text-slate-700 rounded-lg flex items-center justify-center mb-4 border border-slate-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-slate-800 tracking-tight">Laporan Rekap Peminjaman</h3>
                <p class="text-xs text-slate-400 mt-1 mb-5 leading-relaxed">Menyaring rekam data sirkulasi pinjam pakai barang inventaris sekolah berdasarkan klaster tanggal tertentu.</p>
            </div>
            
            <form action="{{ route('laporan.peminjaman') }}" method="GET" target="_blank" class="space-y-3">
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider block mb-1">Tanggal Awal</label>
                        <input type="date" name="tgl_awal" required 
                               class="w-full h-9 px-3 border border-slate-200 rounded-lg text-xs font-medium focus:border-slate-400 focus:ring-0 bg-white text-slate-700 outline-none transition-all">
                    </div>
                    <div>
                        <label class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider block mb-1">Tanggal Akhir</label>
                        <input type="date" name="tgl_akhir" required 
                               class="w-full h-9 px-3 border border-slate-200 rounded-lg text-xs font-medium focus:border-slate-400 focus:ring-0 bg-white text-slate-700 outline-none transition-all">
                    </div>
                </div>
                <button type="submit" class="h-10 w-full bg-slate-100 text-slate-700 border border-slate-200/60 rounded-lg font-semibold text-xs hover:bg-slate-200/60 transition-colors flex items-center justify-center gap-1.5">
                    Export PDF Peminjaman
                </button>
            </form>
        </div>

        <div class="bg-white rounded-xl border border-slate-100 p-6 shadow-[0_1px_2px_rgba(0,0,0,0.01)] flex flex-col justify-between">
            <div>
                <div class="w-10 h-10 bg-slate-50 text-slate-700 rounded-lg flex items-center justify-center mb-4 border border-slate-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-slate-800 tracking-tight">Laporan Mutasi Barang Masuk</h3>
                <p class="text-xs text-slate-400 mt-1 mb-5 leading-relaxed">Menyusun log dokumentasi pasokan barang atau sarana prasarana baru yang masuk ke dalam sistem inventaris.</p>
            </div>
            
            <form action="{{ route('laporan.masuk') }}" method="GET" target="_blank" class="space-y-3">
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider block mb-1">Tanggal Awal</label>
                        <input type="date" name="tgl_awal" required 
                               class="w-full h-9 px-3 border border-slate-200 rounded-lg text-xs font-medium focus:border-slate-400 focus:ring-0 bg-white text-slate-700 outline-none transition-all">
                    </div>
                    <div>
                        <label class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider block mb-1">Tanggal Akhir</label>
                        <input type="date" name="tgl_akhir" required 
                               class="w-full h-9 px-3 border border-slate-200 rounded-lg text-xs font-medium focus:border-slate-400 focus:ring-0 bg-white text-slate-700 outline-none transition-all">
                    </div>
                </div>
                <button type="submit" class="h-10 w-full bg-slate-100 text-slate-700 border border-slate-200/60 rounded-lg font-semibold text-xs hover:bg-slate-200/60 transition-colors flex items-center justify-center gap-1.5">
                    Export PDF Barang Masuk
                </button>
            </form>
        </div>

        <div class="bg-white rounded-xl border border-slate-100 p-6 shadow-[0_1px_2px_rgba(0,0,0,0.01)] flex flex-col justify-between">
            <div>
                <div class="w-10 h-10 bg-slate-50 text-slate-700 rounded-lg flex items-center justify-center mb-4 border border-slate-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-slate-800 tracking-tight">Laporan Mutasi Barang Keluar</h3>
                <p class="text-xs text-slate-400 mt-1 mb-5 leading-relaxed">Menyusun ringkasan berkas pengeluaran logistik, penyusutan aset, maupun alokasi distribusi komoditas luar.</p>
            </div>
            
            <form action="{{ route('laporan.keluar') }}" method="GET" target="_blank" class="space-y-3">
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider block mb-1">Tanggal Awal</label>
                        <input type="date" name="tgl_awal" required 
                               class="w-full h-9 px-3 border border-slate-200 rounded-lg text-xs font-medium focus:border-slate-400 focus:ring-0 bg-white text-slate-700 outline-none transition-all">
                    </div>
                    <div>
                        <label class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider block mb-1">Tanggal Akhir</label>
                        <input type="date" name="tgl_akhir" required 
                               class="w-full h-9 px-3 border border-slate-200 rounded-lg text-xs font-medium focus:border-slate-400 focus:ring-0 bg-white text-slate-700 outline-none transition-all">
                    </div>
                </div>
                <button type="submit" class="h-10 w-full bg-slate-100 text-slate-700 border border-slate-200/60 rounded-lg font-semibold text-xs hover:bg-slate-200/60 transition-colors flex items-center justify-center gap-1.5">
                    Export PDF Barang Keluar
                </button>
            </form>
        </div>

    </div>
</div>
@endsection