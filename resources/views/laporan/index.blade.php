@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 font-italic">Pusat Laporan</h1>
        <p class="text-sm text-gray-500 mt-1">Pilih jenis laporan yang ingin kamu cetak dalam format PDF.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        {{-- Card Laporan Stok Barang --}}
        <div class="bg-blue-200 rounded-3xl border border-gray-100 shadow-sm p-8 hover:shadow-md transition">
            <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center mb-6 text-2xl">
                📦
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Laporan Stok Barang</h3>
            <p class="text-sm text-gray-500 mb-6">Mencetak seluruh daftar barang beserta sisa stok terbaru saat ini.</p>
            
            <a href="{{ route('laporan.barang') }}" target="_blank" 
               class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Cetak Stok Sekarang
            </a>
        </div>

        {{-- Card Laporan Barang Masuk (Dengan Filter) --}}
        <div class="bg-green-200 rounded-3xl border border-gray-100 shadow-sm p-8 hover:shadow-md transition">
            <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center mb-6 text-2xl">
                📥
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Laporan Barang Masuk</h3>
            <p class="text-sm text-gray-500 mb-6">Cetak riwayat barang masuk berdasarkan periode tanggal tertentu.</p>
            
            <form action="{{ route('laporan.masuk') }}" method="GET" target="_blank" class="space-y-4">
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase">Tgl Awal</label>
                        <input type="date" name="tgl_awal" value="{{ date('Y-m-01') }}" class="w-full mt-1 px-3 py-2 bg-gray-50 border border-gray-100 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase">Tgl Akhir</label>
                        <input type="date" name="tgl_akhir" value="{{ date('Y-m-d') }}" class="w-full mt-1 px-3 py-2 bg-gray-50 border border-gray-100 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
                    </div>
                </div>
                <button type="submit" 
                        class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-emerald-600 text-white rounded-xl font-bold hover:bg-emerald-700 transition shadow-lg shadow-emerald-100">
                    Filter & Cetak PDF
                </button>
            </form>
        </div>

        {{-- Kamu bisa tambah satu card lagi buat Barang Keluar di sini nanti --}}

        {{-- Card Laporan Barang Keluar --}}
        <div class="bg-red-200 rounded-3xl border border-gray-100 shadow-sm p-8 hover:shadow-md transition">
            <div class="w-14 h-14 bg-rose-50 rounded-2xl flex items-center justify-center mb-6 text-2xl">
                📤
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Laporan Barang Keluar</h3>
            <p class="text-sm text-gray-500 mb-6">Cetak riwayat pengeluaran barang berdasarkan periode tanggal.</p>
            
            <form action="{{ route('laporan.keluar') }}" method="GET" target="_blank" class="space-y-4">
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase">Tgl Awal</label>
                        <input type="date" name="tgl_awal" value="{{ date('Y-m-01') }}" class="w-full mt-1 px-3 py-2 bg-gray-50 border border-gray-100 rounded-lg text-sm focus:ring-2 focus:ring-rose-500 outline-none">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase">Tgl Akhir</label>
                        <input type="date" name="tgl_akhir" value="{{ date('Y-m-d') }}" class="w-full mt-1 px-3 py-2 bg-gray-50 border border-gray-100 rounded-lg text-sm focus:ring-2 focus:ring-rose-500 outline-none">
                    </div>
                </div>
                <button type="submit" 
                        class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-rose-600 text-white rounded-xl font-bold hover:bg-rose-700 transition shadow-lg shadow-rose-100">
                    Filter & Cetak PDF
                </button>
            </form>
        </div>

    </div>

    {{-- Footer Info --}}
    <div class="mt-12 p-6 bg-gray-900 rounded-[2rem] text-center">
        <p class="text-gray-400 text-sm">Laporan dihasilkan secara otomatis oleh sistem <span class="text-white font-bold">Inventaris Barang</span></p>
    </div>
</div>
@endsection