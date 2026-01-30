@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 pb-12">
    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('peminjaman.index') }}" class="text-indigo-600 font-bold text-sm flex items-center gap-2 mb-4 hover:underline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Kembali ke Daftar
        </a>
        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Form Peminjaman</h1>
        <p class="text-sm text-slate-500 mt-1 uppercase tracking-widest font-bold italic">Input Data Peminjaman Baru</p>
    </div>

    {{-- Notifikasi Error (Contoh: Stok Kurang) --}}
    @if(session('error'))
        <div id="alert-error" class="fixed top-5 right-5 z-[100] transform transition-all duration-500 ease-in-out translate-y-0 opacity-100">
            <div class="rounded-[2rem] border border-rose-100 bg-white p-4 shadow-2xl shadow-rose-100/50 flex items-center gap-4 min-w-[320px]">
                {{-- Icon Warning --}}
                <div class="flex-shrink-0 w-10 h-10 bg-rose-50 rounded-full flex items-center justify-center">
                    <svg class="h-6 w-6 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                
                {{-- Text --}}
                <div class="pr-4">
                    <h3 class="text-sm font-black text-slate-800 uppercase tracking-tight">Waduh, Gagal!</h3>
                    <p class="text-xs text-slate-500 font-medium">{{ session('error') }}</p>
                </div>

                {{-- Close Button --}}
                <button onclick="dismissError()" class="ml-auto text-slate-300 hover:text-slate-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
            </div>
        </div>

        <script>
            function dismissError() {
                const errorAlert = document.getElementById('alert-error');
                if(errorAlert) {
                    errorAlert.style.opacity = '0';
                    errorAlert.style.transform = 'translateY(-20px)';
                    setTimeout(() => {
                        errorAlert.remove();
                    }, 500);
                }
            }

            // Error dikasih waktu lebih lama dikit (5 detik) biar user sempet baca
            setTimeout(() => {
                dismissError();
            }, 5000);
        </script>
    @endif

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl overflow-hidden">
        <form action="{{ route('peminjaman.store') }}" method="POST" class="p-8 md:p-12">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Pilih Barang --}}
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Pilih Barang yang Dipinjam</label>
                    <select name="barang_id" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all text-sm font-bold bg-slate-50" required>
                        <option value="">-- Cari Barang --</option>
                        @foreach($barangs as $b)
                            <option value="{{ $b->id }}">
                                {{ $b->nama_barang }} (Merek: {{ $b->merek }} | Stok: {{ $b->stok }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Nama Peminjam --}}
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1 ml-1">Nama Peminjam</label>
                    <input type="text" name="nama_peminjam" placeholder="Contoh: Radit / Ryn" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all text-sm font-bold" required>
                </div>

                {{-- Jumlah --}}
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1 ml-1">Jumlah Pinjam</label>
                    <input type="number" name="jumlah" min="1" placeholder="0" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all text-sm font-bold" required>
                </div>

                {{-- Tanggal Pinjam --}}
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1 ml-1">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" value="{{ date('Y-m-d') }}" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all text-sm font-bold" required>
                </div>

                {{-- Keterangan --}}
                <div class="md:col-span-2 space-y-2">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1 ml-1">Keterangan / Keperluan</label>
                    <textarea name="keterangan" rows="3" placeholder="Misal: Untuk praktek di lab RPL" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all text-sm font-bold"></textarea>
                </div>
            </div>

            <div class="mt-10 flex gap-3">
                {{-- <button type="submit" class="flex-1 bg-indigo-600 text-white py-4 rounded-2xl font-black text-sm hover:bg-indigo-700 hover:shadow-lg hover:shadow-indigo-200 transition-all uppercase tracking-widest">
                    Simpan Data Peminjaman
                </button> --}}
                {{-- <button  type="submit" class="px-5 py-2.5 bg-yellow-400 text-black font-black text-lg border-4 border-black rounded-lg shadow-[0.1em_0.1em_0px_0px_black] hover:shadow-[0.15em_0.15em_0px_0px_black] hover:-translate-x-0.5 hover:-translate-y-0.5 active:shadow-[0.05em_0.05em_0px_0px_black] active:translate-x-0.5 active:translate-y-0.5 transition-all duration-150 cursor-pointer dark:bg-yellow-300 dark:text-gray-900">
                    Retro Button
                </button> --}}
                <button type="submit" class="relative px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-lg shadow-lg overflow-hidden group focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-all duration-300 hover:shadow-xl hover:scale-105 active:scale-95">
                    <span class="relative z-10">Simpan Data Peminjaman</span>
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[200%] h-[200%] rounded-full bg-white/40 pointer-events-none transform scale-100 opacity-0 transition-all duration-700 ease-out group-active:scale-0 group-active:opacity-100 group-active:transition-none"></div>
                </button>
                <button type="reset" class="px-8 bg-slate-100 text-slate-500 py-4 rounded-2xl font-bold text-sm hover:bg-slate-200 transition-all uppercase">
                    Reset
                </button>
            </div>
        </form>
    </div>
</div>
@endsection