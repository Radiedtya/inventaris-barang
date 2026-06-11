@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 pb-12 select-none space-y-6">

    {{-- Minimalist Floating Toast Notification --}}
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
                <p class="text-xs font-semibold text-slate-900">Aksi Berhasil</p>
                <p class="text-[11px] text-slate-500 mt-0.5 leading-relaxed">{{ session('success') }}</p>
            </div>

            <button @click="show = false" class="text-slate-400 hover:text-slate-600 transition-colors shrink-0">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    @endif

    {{-- Header Title & Action Controls --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 pb-5">
        <div>
            <h1 class="text-xl font-bold text-slate-900 tracking-tight">Katalog Stok Barang</h1>
            <p class="text-xs font-medium text-slate-400 mt-1">Kelola data komoditas barang, klasifikasi merek, dan kuantitas ketersediaan.</p>
        </div>

        <div class="flex items-center gap-2">
            {{-- Tombol Export Excel --}}
            <a href="{{ route('barang.export', ['merek' => request('merek')]) }}" 
               class="h-9 px-3.5 bg-white border border-slate-200 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors text-xs font-semibold flex items-center gap-1.5 shadow-[0_1px_2px_rgba(0,0,0,0.01)]">
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Export Excel
            </a>

            {{-- Tombol Tambah Barang --}}
            <a href="{{ route('barang.create') }}"  
               class="h-9 px-3.5 bg-slate-900 text-white rounded-lg hover:bg-slate-800 transition-colors text-xs font-semibold flex items-center gap-1.5 shadow-sm">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path d="M12 4v16m8-8H4" stroke-linecap="round"/>
                </svg>
                Tambah Item
            </a>
        </div>
    </div>

    {{-- Filter Merek (Matte Design Section) --}}
    <div class="bg-slate-50/60 border border-slate-200/50 p-4 rounded-xl">
        <form action="{{ route('barang.index') }}" method="GET" class="flex flex-col sm:flex-row items-stretch sm:items-end gap-3">
            
            <div class="flex-1">
                <label for="merek" class="block text-[10px] font-semibold text-slate-400 uppercase tracking-wider mb-1.5 ml-0.5">Klasifikasi Merek</label>
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
                    <a href="{{ route('barang.index') }}" class="h-9 px-4 bg-slate-200/70 text-slate-600 rounded-lg text-xs font-medium hover:bg-slate-200 transition-colors flex items-center justify-center">
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
                        <th class="px-5 py-3 text-[10px] font-semibold text-slate-400 uppercase tracking-wider w-20">Visual</th>
                        <th class="px-5 py-3 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Nama Komoditas</th>
                        <th class="px-5 py-3 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Merek</th>
                        <th class="px-5 py-3 text-[10px] font-semibold text-slate-400 uppercase tracking-wider w-28">Stok Gudang</th>
                        <th class="px-5 py-3 text-[10px] font-semibold text-slate-400 uppercase tracking-wider text-center w-24">Aksi</th>
                    </tr>
                </thead>
                
                <tbody class="divide-y divide-slate-100">
                    @forelse($barangs as $b)
                    <tr class="hover:bg-slate-50/30 transition-colors">
                        <td class="px-5 py-3.5 text-xs text-slate-400 font-medium">
                            {{ $loop->iteration + ($barangs->currentPage() - 1) * $barangs->perPage() }}
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="w-9 h-9 rounded-lg border border-slate-100 overflow-hidden bg-slate-50 flex items-center justify-center shrink-0">
                                @if ($b->foto)
                                    <img src="{{ $b->foto_url }}" class="w-full h-full object-cover">
                                @else
                                    <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                @endif
                            </div>
                        </td>
                        <td class="px-5 py-3.5 text-xs font-semibold text-slate-800">{{ $b->nama_barang }}</td>
                        <td class="px-5 py-3.5 text-xs font-medium text-slate-500">{{ $b->merek }}</td>
                        <td class="px-5 py-3.5 text-xs">
                            {{-- Logic Badge Kuantitas Stok --}}
                            @if($b->stok < 10)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold bg-rose-50 text-rose-600 border border-rose-100">
                                    {{ $b->stok }} <span class="text-[9px] font-normal ml-1">Kritis</span>
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold bg-emerald-50 text-emerald-600 border border-emerald-100">
                                    {{ $b->stok }} <span class="text-[9px] font-normal ml-1">Aman</span>
                                </span>
                            @endif
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex justify-center items-center gap-1.5">
                                <a class="p-1.5 text-slate-400 hover:text-slate-700 hover:bg-slate-50 rounded-md transition-all" href="{{ route('barang.edit', $b->id) }}" title="Edit Item">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" stroke-linecap="round"/></svg>
                                </a>
                                <form action="{{ route('barang.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data komoditas ini secara permanen?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50/50 rounded-md transition-all" title="Hapus Item">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-linecap="round"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-5 py-16 text-center">
                            <div class="flex flex-col items-center justify-center gap-2 text-slate-300">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" stroke-linecap="round"/>
                                </svg>
                                <p class="text-xs font-medium text-slate-400">Tidak ada data barang yang memenuhi kriteria filter.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Block --}}
        @if($barangs->hasPages())
            <div class="px-5 py-3 bg-slate-50/50 border-t border-slate-100 text-xs">
                {{ $barangs->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>
@endsection