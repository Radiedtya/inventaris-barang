@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6 pb-12">
    {{-- Header Section --}}
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Peminjaman Barang</h1>
            <p class="text-sm text-slate-500 mt-1 uppercase tracking-widest font-bold italic">Log Transaksi Peminjaman</p>
        </div>
        <a href="{{ route('peminjaman.create') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold text-sm hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Pinjam Barang
        </a>
    </div>

    {{-- Notifikasi --}}
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

    {{-- Filter Merek --}}
    <div class="bg-white p-5 rounded-3xl border border-slate-100 shadow-sm mb-6">
        <form action="{{ route('peminjaman.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Filter Merek Barang</label>
                <select name="merek" class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm font-medium">
                    <option value="">Semua Merek</option>
                    @foreach($daftarMerek as $m)
                        <option value="{{ $m }}" {{ request('merek') == $m ? 'selected' : '' }}>{{ $m }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="px-8 py-3 bg-slate-900 text-white rounded-2xl font-bold text-sm hover:bg-slate-800 transition">Filter</button>
            @if(request('merek'))
                <a href="{{ route('peminjaman.index') }}" class="px-8 py-3 bg-slate-100 text-slate-500 rounded-2xl font-bold text-sm hover:bg-slate-200 transition">Reset</a>
            @endif
        </form>
    </div>

    {{-- Table Card --}}
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Peminjam</th>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Barang</th>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Jumlah</th>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal Pinjam</th>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($peminjamans as $p)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-5">
                            <p class="font-bold text-slate-800">{{ $p->nama_peminjam }}</p>
                            <p class="text-[10px] text-slate-400 italic">{{ $p->keterangan ?? 'Tanpa keterangan' }}</p>
                        </td>
                        <td class="px-6 py-5">
                            <img src="{{ $p->barang->foto_url }}" alt="" class="w-14 h-14 object-cover rounded-xl mb-2 border border-slate-200 shadow-sm">
                            <p class="font-bold text-slate-700">{{ $p->barang->nama_barang }}</p>
                            <p class="text-[10px] font-black text-indigo-500 uppercase">{{ $p->barang->merek }}</p>
                        </td>
                        <td class="px-6 py-5">
                            <span class="px-3 py-1 bg-slate-100 rounded-full text-xs font-black text-slate-600">{{ $p->jumlah }} Unit</span>
                        </td>
                        <td class="px-6 py-5">
                            @if($p->status == 'dipinjam')
                                <span class="px-3 py-1 bg-amber-50 text-amber-600 rounded-full text-[10px] font-black uppercase tracking-tighter">Sedang Dipinjam</span>
                            @else
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black uppercase tracking-tighter">Sudah Kembali</span>
                            @endif
                        </td>
                        <td class="px-6 py-5">
                            <p class="text-xs font-bold text-slate-600">{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}</p>
                            @if($p->tanggal_kembali)
                                <p class="text-[9px] text-emerald-500 font-medium italic">Kembali: {{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d M Y') }}</p>
                            @endif
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex justify-center gap-2">
                                {{-- Tombol Kembalikan (Hanya muncul jika status dipinjam) --}}
                                @if($p->status == 'dipinjam')
                                <form action="{{ route('peminjaman.kembalikan', $p->id) }}" method="POST" onsubmit="return confirm('Kembalikan?')">
                                    @csrf
                                    <button type="submit" class="p-2 bg-emerald-50 text-emerald-600 rounded-xl hover:bg-emerald-600 hover:text-white transition-all shadow-sm" title="Kembalikan Barang">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </button>
                                </form>
                                @endif

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('peminjaman.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition-all shadow-sm" title="Hapus Data">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </button>
                                    {{-- <button title="Hapus Data" type="submit" class="group relative flex w-9 h-9 flex-col items-center justify-center overflow-hidden rounded-xl border-2 border-red-800 bg-red-400 hover:bg-red-600">
                                        <svg viewBox="0 0 1.625 1.625" class="absolute -top-7 fill-white delay-100 group-hover:top-6 group-hover:animate-[spin_1.4s] group-hover:duration-1000" height="15" width="15">
                                            <path d="M.471 1.024v-.52a.1.1 0 0 0-.098.098v.618c0 .054.044.098.098.098h.487a.1.1 0 0 0 .098-.099h-.39c-.107 0-.195 0-.195-.195"/>
                                            <path d="M1.219.601h-.163A.1.1 0 0 1 .959.504V.341A.033.033 0 0 0 .926.309h-.26a.1.1 0 0 0-.098.098v.618c0 .054.044.098.098.098h.487a.1.1 0 0 0 .098-.099v-.39a.033.033 0 0 0-.032-.033"/>
                                            <path d="m1.245.465-.15-.15a.02.02 0 0 0-.016-.006.023.023 0 0 0-.023.022v.108c0 .036.029.065.065.065h.107a.023.023 0 0 0 .023-.023.02.02 0 0 0-.007-.016"/>
                                        </svg>
                                        <svg width="16" fill="none" viewBox="0 0 39 7" class="origin-right duration-500 group-hover:rotate-90">
                                            <line stroke-width="4" stroke="white" y2="5" x2="39" y1="5"></line>
                                            <line stroke-width="3" stroke="white" y2="1.5" x2="26.0357" y1="1.5" x1="12"></line>
                                        </svg>
                                        <svg width="16" fill="none" viewBox="0 0 33 39" class="">
                                            <mask fill="white" id="path-1-inside-1_8_19">
                                                <path d="M0 0H33V35C33 37.2091 31.2091 39 29 39H4C1.79086 39 0 37.2091 0 35V0Z"/>
                                            </mask>
                                            <path mask="url(#path-1-inside-1_8_19)" fill="white" d="M0 0H33H0ZM37 35C37 39.4183 33.4183 43 29 43H4C-0.418278 43 -4 39.4183 -4 35H4H29H37ZM4 43C-0.418278 43 -4 39.4183 -4 35V0H4V35V43ZM37 0V35C37 39.4183 33.4183 43 29 43V35V0H37Z"/>
                                            <path stroke-width="4" stroke="white" d="M12 6L12 29"/>
                                            <path stroke-width="4" stroke="white" d="M21 6V29"/>
                                        </svg>
                                    </button> --}}
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-slate-400 italic text-sm">Belum ada data peminjaman nih...</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination --}}
        @if($peminjamans->hasPages())
        <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100">
            {{ $peminjamans->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
@endsection