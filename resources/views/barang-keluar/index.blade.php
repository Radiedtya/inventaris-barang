@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 pb-12 select-none space-y-6">

    {{-- Minimalist Floating Toast Notification (Success) --}}
    @if(session('success'))
        <div x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 4000)"
             x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-2 sm:translate-y-0 sm:translate-x-2"
             x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed bottom-5 right-5 z-[100] max-w-sm w-full bg-white border border-slate-200/80 rounded-xl shadow-md p-4 flex items-start gap-3">
            
            <div class="p-1 bg-emerald-50 text-emerald-600 rounded-md shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <div class="flex-1 min-w-0">
                <p class="text-xs font-semibold text-slate-900">Data Diperbarui</p>
                <p class="text-[11px] text-slate-500 mt-0.5 leading-relaxed">{{ session('success') }}</p>
            </div>

            <button @click="show = false" class="text-slate-400 hover:text-slate-600 transition-colors shrink-0">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    @endif

    {{-- Minimalist Floating Toast Notification (Error / Gagal Stok) --}}
    @if(session('error'))
        <div x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 5000)"
             x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-2 sm:translate-y-0 sm:translate-x-2"
             x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed bottom-5 right-5 z-[100] max-w-sm w-full bg-white border border-red-200 rounded-xl shadow-md p-4 flex items-start gap-3">
            
            <div class="p-1 bg-red-50 text-red-600 rounded-md shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>

            <div class="flex-1 min-w-0">
                <p class="text-xs font-semibold text-red-900">Transaksi Gagal</p>
                <p class="text-[11px] text-red-500 mt-0.5 leading-relaxed">{{ session('error') }}</p>
            </div>

            <button @click="show = false" class="text-slate-400 hover:text-red-600 transition-colors shrink-0">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    @endif

    {{-- Header Title & Action Controls --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 pb-5">
        <div>
            <h1 class="text-xl font-bold text-slate-900 tracking-tight">Manajemen Barang Keluar</h1>
            <p class="text-xs font-medium text-slate-400 mt-1">Pantau rincian pengeluaran logistik, distribusi, serta pengurangan kuantitas stok gudang.</p>
        </div>

        <div class="flex items-center gap-2">
            {{-- Tombol Export Excel --}}
            <a href="{{ route('barang-keluar.export', ['merek' => request('merek')]) }}" 
               class="h-9 px-3.5 bg-white border border-slate-200 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors text-xs font-semibold flex items-center gap-1.5 shadow-[0_1px_2px_rgba(0,0,0,0.01)]">
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Export Excel
            </a>

            {{-- Tombol Tambah Barang Keluar --}}
            <a href="{{ route('barang-keluar.create') }}"  
               class="h-9 px-3.5 bg-slate-900 text-white rounded-lg hover:bg-slate-800 transition-colors text-xs font-semibold flex items-center gap-1.5 shadow-sm">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path d="M12 4v16m8-8H4" stroke-linecap="round"/>
                </svg>
                Catat Barang Keluar
            </a>
        </div>
    </div>

    {{-- Filter Merek (Matte Design Section) --}}
    <div class="bg-slate-50/60 border border-slate-200/50 p-4 rounded-xl">
        <form action="{{ route('barang-keluar.index') }}" method="GET" class="flex flex-col sm:flex-row items-stretch sm:items-end gap-3">
            
            <div class="flex-1">
                <label for="merek" class="block text-[10px] font-semibold text-slate-400 uppercase tracking-wider mb-1.5 ml-0.5">Filter Berdasarkan Merek</label>
                <div class="relative">
                    <select name="merek" id="merek" 
                            class="w-full h-9 pl-3 pr-10 rounded-lg border border-slate-200 bg-white focus:border-slate-400 focus:ring-0 outline-none transition-all text-xs font-medium appearance-none text-slate-700">
                        <option value="">Semua Merek Dagang</option>
                        @foreach($daftarMerek as $m)
                            <option value="{{ $m }}" {{ request('merek') == $m ? 'selected' : '' }}>{{ $m }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center gap-2 shrink-0">
                <button type="submit" class="h-9 px-5 bg-white border border-slate-200 text-slate-700 rounded-lg text-xs font-semibold hover:bg-slate-50 transition-colors shadow-[0_1px_2px_rgba(0,0,0,0.01)] flex items-center justify-center">
                    Terapkan Filter
                </button>
                
                @if(request('merek'))
                    <a href="{{ route('barang-keluar.index') }}" class="h-9 px-4 bg-slate-200/70 text-slate-600 rounded-lg text-xs font-medium hover:bg-slate-200 transition-colors flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Table Data Area --}}
    <div class="bg-white border border-slate-100 rounded-xl shadow-[0_1px_2px_rgba(0,0,0,0.01)] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50/70 border-b border-slate-100">
                    <tr>
                        <th class="px-5 py-3 text-[10px] font-semibold text-slate-400 uppercase tracking-wider w-16">No</th>
                        <th class="px-5 py-3 text-[10px] font-semibold text-slate-400 uppercase tracking-wider w-24">Foto Bukti</th>
                        <th class="px-5 py-3 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Nama Barang</th>
                        <th class="px-5 py-3 text-[10px] font-semibold text-slate-400 uppercase tracking-wider w-32">Merek</th>
                        <th class="px-5 py-3 text-[10px] font-semibold text-slate-400 uppercase tracking-wider text-center w-28">Jumlah</th>
                        <th class="px-5 py-3 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Keterangan</th>
                        <th class="px-5 py-3 text-[10px] font-semibold text-slate-400 uppercase tracking-wider w-40">Tanggal Keluar</th>
                        <th class="px-5 py-3 text-[10px] font-semibold text-slate-400 uppercase tracking-wider text-center w-24">Aksi</th>
                    </tr>
                </thead>
                
                <tbody class="divide-y divide-slate-100">
                    @forelse($barangKeluars as $b)
                    <tr class="hover:bg-slate-50/30 transition-colors">
                        {{-- Nomor Iterasi --}}
                        <td class="px-5 py-3.5 text-xs text-slate-400 font-medium">
                            {{ $loop->iteration + ($barangKeluars->currentPage() - 1) * $barangKeluars->perPage() }}
                        </td>

                        {{-- Thumbnail Bukti Fisik --}}
                        <td class="px-5 py-3.5 whitespace-nowrap">
                            <div class="relative w-10 h-10 rounded-lg border border-slate-100 overflow-hidden bg-slate-50 flex items-center justify-center group">
                                @if($b->foto)
                                    <img src="{{ $b->foto_url }}" alt="Bukti" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200">
                                    <a href="{{ $b->foto_url }}" target="_blank" class="absolute inset-0 bg-slate-900/10 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                            <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                @else
                                    <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                @endif
                            </div>
                        </td>

                        {{-- Relasi Nama Barang --}}
                        <td class="px-5 py-3.5 text-xs font-semibold text-slate-700">
                            {{ $b->barang->nama_barang }}
                        </td>

                        {{-- Merek --}}
                        <td class="px-5 py-3.5 text-xs text-slate-500 font-medium">
                            {{ $b->barang->merek }}
                        </td>

                        {{-- Jumlah Unit Keluar --}}
                        <td class="px-5 py-3.5 text-xs text-center">
                            <span class="inline-flex items-center font-bold text-rose-600 bg-rose-50/60 px-2 py-0.5 rounded text-[11px] border border-rose-100/30">
                                -{{ $b->jumlah }} Unit
                            </span>
                        </td>

                        {{-- Keterangan Log --}}
                        <td class="px-5 py-3.5 text-xs text-slate-400 italic max-w-[160px] truncate" title="{{ $b->keterangan }}">
                            {{ $b->keterangan ?? 'Tanpa lampiran catatan' }}
                        </td>

                        {{-- Tanggal Registrasi Keluar --}}
                        <td class="px-5 py-3.5 text-xs font-semibold text-slate-600">
                            {{ \Carbon\Carbon::parse($b->tanggal_keluar)->translatedFormat('d M Y') }}
                        </td>

                        {{-- Blok Manajemen Aksi --}}
                        <td class="px-5 py-3.5">
                            <div class="flex justify-center items-center gap-1">
                                <a href="{{ route('barang-keluar.edit', $b->id) }}" class="p-1.5 text-slate-400 hover:text-amber-500 hover:bg-amber-50 rounded-md transition-all" title="Ubah Riwayat">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                                
                                <form action="{{ route('barang-keluar.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Hapus entri riwayat pengeluaran barang ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50/50 rounded-md transition-all" title="Eliminasi Data">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-5 py-16 text-center">
                            <div class="flex flex-col items-center justify-center gap-2 text-slate-300">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" stroke-linecap="round"/>
                                </svg>
                                <p class="text-xs font-medium text-slate-400">Belum ada riwayat pencatatan log distribusi barang keluar dari gudang.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination Block --}}
        @if($barangKeluars->hasPages())
        <div class="px-5 py-3 bg-slate-50/50 border-t border-slate-100 text-xs">
            {{ $barangKeluars->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
@endsection