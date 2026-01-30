@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="space-y-6">

        {{-- Bagian Tombol (Di bawah judul) --}}
        <div class="flex flex-wrap items-center gap-3">
            {{-- Tombol Tambah --}}
            <a href="{{ route('barang.create') }}"  
            class="px-5 py-2.5 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition shadow-lg shadow-gray-100 font-bold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round"/>
                </svg>
                Tambah Barang
            </a>

            {{-- Tombol Export --}}
            <a href="{{ route('barang.export', ['merek' => request('merek')]) }}" 
            class="px-5 py-2.5 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition shadow-lg shadow-emerald-100 font-bold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Export Excel
            </a>
        </div>

        {{-- Form Filter Merek --}}
        <div class="bg-white p-5 rounded-3xl border border-gray-100 shadow-sm mb-6 mt-4">
            <form action="{{ route('barang.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
                
                {{-- Pilihan Dropdown --}}
                <div class="flex-1 min-w-[250px]">
                    <label for="merek" class="block text-xs font-black text-indigo-400 uppercase tracking-widest mb-2 ml-1">Filter Berdasarkan Merek</label>
                    <select name="merek" id="merek" class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm font-medium appearance-none bg-no-repeat bg-[right_1rem_center]" style="background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%236366f1%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C%2Fpolyline%3E%3C%2Fsvg%3E'); background-size: 1.2em;">
                        <option value="">Semua Merek</option>
                        @foreach($daftarMerek as $m)
                            <option value="{{ $m }}" {{ request('merek') == $m ? 'selected' : '' }}>{{ $m }}</option>
                        @endforeach
                    </select>
                </div>
                
                {{-- Tombol Aksi --}}
                <div class="flex gap-2">
                    <button type="submit" class="px-8 py-3 bg-indigo-600 text-white rounded-2xl font-bold text-sm hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">
                        Filter
                    </button>
                    
                    {{-- Tombol Reset (Cuma muncul kalau lagi nge-filter) --}}
                    @if(request('merek'))
                        <a href="{{ route('barang.index') }}" class="px-8 py-3 bg-gray-100 text-gray-500 rounded-2xl font-bold text-sm hover:bg-gray-200 transition">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- Alert Success dengan Alpine.js --}}
    @if (session('success'))
        <div 
            x-data="{ show: true }" 
            x-init="setTimeout(() => show = false, 3000)" 
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-2"
            class="px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg shadow-sm flex justify-between items-center"
        >
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
            
            <button @click="show = false" class="text-emerald-500 hover:text-emerald-700 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50/50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">No</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Foto</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Nama Barang</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Merek</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Stok</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase text-center">Aksi</th>
                </tr>
            </thead>
            
            <tbody class="divide-y divide-gray-50">
                @forelse($barangs as $b)
                <tr class="hover:bg-gray-50/50 transition">
                    {{-- Pakai iteration biar nomor urutnya rapi --}}
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $loop->iteration + ($barangs->currentPage() - 1) * $barangs->perPage() }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            @if ($b->foto)
                                <img src="{{ $b->foto_url }}" class="w-10 h-10 rounded-lg object-cover shadow-sm">
                                {{-- <div class="flex flex-col">
                                    <span class="font-bold text-slate-700">{{ $b->nama_barang }}</span>
                                    <span class="text-[10px] text-gray-400 uppercase tracking-tight">{{ $b->id }}</span>
                                </div> --}}
                            @else
                                <div class="w-12 h-12 bg-gray-50 rounded-xl border border-dashed border-gray-200 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-700">{{ $b->nama_barang }}</td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-700">{{ $b->merek }}</td>
                    <td class="px-6 py-4 text-sm">
                        {{-- Logika warna stok: Merah kalau < 10, Emerald kalau banyak --}}
                        <span class="px-2.5 py-1 {{ $b->stok < 10 ? 'bg-red-50 text-red-700' : 'bg-emerald-50 text-emerald-700' }} rounded-lg font-bold">
                            {{ $b->stok }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-2">
                            <a class="p-2 text-amber-500 hover:bg-amber-50 rounded-lg transition" href="{{ route('barang.edit', $b->id) }}" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" stroke-width="2" stroke-linecap="round"/></svg>
                            </a>
                            <form action="{{ route('barang.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus data ini, Sayang?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2" stroke-linecap="round"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center gap-2 text-gray-400">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" stroke-width="2" stroke-linecap="round"/></svg>
                            <p class="text-sm">Belum ada barang di gudang kita.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination bar --}}
        @if($barangs->hasPages())
            <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-100">
                {{ $barangs->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>
@endsection