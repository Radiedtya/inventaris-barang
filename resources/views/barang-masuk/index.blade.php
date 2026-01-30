@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="space-y-6">

        {{-- Buttons Row --}}
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('barang-masuk.create') }}"  
            class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 font-bold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round"/></svg>
                Tambah Barang Masuk
            </a>

            <a href="{{ route('barang-masuk.export', ['merek' => request('merek')]) }}" 
            class="px-5 py-2.5 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition shadow-lg shadow-emerald-100 font-bold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Export Excel
            </a>
        </div>
    </div>
    {{-- Form Filter --}}
    <div class="bg-white p-5 rounded-3xl border border-gray-100 shadow-sm mb-6 mt-4">
        <form action="{{ route('barang-masuk.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
            <div class="flex-1 min-w-[250px]">
                <label class="block text-xs font-black text-emerald-500 uppercase tracking-widest mb-2 ml-1">Filter Merek</label>
                <select name="merek" class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-emerald-500 outline-none transition text-sm">
                    <option value="">Semua Merek</option>
                    @foreach($daftarMerek as $m)
                        <option value="{{ $m }}" {{ request('merek') == $m ? 'selected' : '' }}>{{ $m }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-8 py-3 bg-emerald-600 text-white rounded-2xl font-bold text-sm hover:bg-emerald-700 transition">Filter</button>
                @if(request('merek'))
                    <a href="{{ route('barang-masuk.index') }}" class="px-8 py-3 bg-gray-100 text-gray-500 rounded-2xl font-bold text-sm hover:bg-gray-200 transition">Reset</a>
                @endif
            </div>
        </form>
    </div>

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
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Foto Bukti</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Nama Barang</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Merek</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Jumlah</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Keterangan</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Tanggal Masuk</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase text-center">Aksi</th>
                </tr>
            </thead>
            {{-- Ganti bagian <tbody> kamu dengan ini biar lebih mantap --}}
            <tbody class="divide-y divide-gray-50">
                @forelse($barangMasuks as $b)
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $loop->iteration + ($barangMasuks->currentPage() - 1) * $barangMasuks->perPage() }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            @if($b->foto)
                                {{-- Kalau ada foto, tampilkan thumbnail --}}
                                <div class="relative group">
                                    <img src="{{ $b->foto_url }}" 
                                        alt="Bukti" 
                                        class="w-12 h-12 object-cover rounded-xl border border-gray-100 shadow-sm group-hover:scale-110 transition-transform duration-300">
                                    
                                    {{-- Overlay tipis saat di-hover --}}
                                    <a href="{{ $b->foto_url }}" target="_blank" 
                                    class="absolute inset-0 flex items-center justify-center bg-black/20 opacity-0 group-hover:opacity-100 rounded-xl transition-opacity">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                </div>
                            @else
                                {{-- Kalau foto kosong, pakai placeholder dari Accessor --}}
                                <div class="w-12 h-12 bg-gray-50 rounded-xl border border-dashed border-gray-200 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-700">{{ $b->barang->nama_barang }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $b->barang->merek }}</td>
                    <td class="px-6 py-4 text-sm">
                        <span class="px-2.5 py-1 bg-indigo-50 text-indigo-700 rounded-lg font-bold">+{{ $b->jumlah }}</span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500 italic">{{ $b->keterangan ?? '-' }}</td>
                    {{-- Kita bikin tanggalnya lebih rapi pakau format d M Y --}}
                    <td class="px-6 py-4 text-sm text-gray-600 font-medium">
                        {{ \Carbon\Carbon::parse($b->tanggal_masuk)->translatedFormat('d F Y') }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-2">
                            <a class="p-2 text-amber-500 hover:bg-amber-50 rounded-lg transition" href="{{ route('barang-masuk.edit', $b->id) }}" title="edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" stroke-width="2" stroke-linecap="round"/></svg>
                            </a>
                            <form action="{{ route('barang-masuk.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Yakin hapus? Stok barang akan otomatis berkurang!')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition">
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
                            <p class="text-sm">Belum ada barang masuk di gudang kita.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>


        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $barangMasuks->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection