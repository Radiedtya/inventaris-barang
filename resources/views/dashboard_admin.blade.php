@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 pb-12 select-none">
    
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Console Administrator</h1>
        <p class="text-xs font-medium text-slate-400 mt-1">Otoritas penuh manajemen operator dan konfigurasi keamanan sistem.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        
        <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-[0_1px_2px_rgba(0,0,0,0.01)]">
            <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Operator Aktif</p>
            <div class="flex items-end justify-between mt-1">
                <h3 class="text-2xl font-bold text-slate-900 tracking-tight">{{ $totalPetugas }}</h3>
                <span class="text-[10px] font-medium text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded">Terverifikasi</span>
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-[0_1px_2px_rgba(0,0,0,0.01)]">
            <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Administrator</p>
            <div class="flex items-end justify-between mt-1">
                <h3 class="text-2xl font-bold text-slate-900 tracking-tight">{{ $totalAdmin }}</h3>
                <span class="text-[10px] font-medium text-slate-400 bg-slate-50 px-2 py-0.5 rounded">Root Level</span>
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-[0_1px_2px_rgba(0,0,0,0.01)]">
            <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Total Volume Aset</p>
            <div class="flex items-end justify-between mt-1">
                <h3 class="text-2xl font-bold text-slate-900 tracking-tight">{{ $totalAset }}</h3>
                <span class="text-[10px] font-medium text-slate-400 mt-1">Unit Barang</span>
            </div>
        </div>

        <a href="{{ route('petugas.index') }}" class="group bg-slate-900 p-5 rounded-xl flex flex-col justify-between hover:bg-slate-800 transition-colors shadow-sm">
            <p class="text-slate-400 text-[10px] font-semibold uppercase tracking-wider">Aksi Cepat</p>
            <div class="flex items-center justify-between mt-2">
                <span class="text-white text-xs font-bold">Kelola Petugas</span>
                <svg class="w-4 h-4 text-white group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 7l5 5m0 0l-5 5m5-5H6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-xl border border-slate-100 shadow-[0_1px_2px_rgba(0,0,0,0.01)] overflow-hidden">
            <div class="p-5 border-b border-slate-50">
                <h2 class="text-sm font-semibold text-slate-900 tracking-tight">Registrasi Petugas Terbaru</h2>
            </div>
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50/50">
                    <tr>
                        <th class="px-5 py-3 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Nama</th>
                        <th class="px-5 py-3 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Email</th>
                        <th class="px-5 py-3 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Tgl Bergabung</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($recentUsers as $user)
                    <tr class="hover:bg-slate-50/30 transition-colors">
                        <td class="px-5 py-3.5 text-xs font-semibold text-slate-700">{{ $user->name }}</td>
                        <td class="px-5 py-3.5 text-xs text-slate-500">{{ $user->email }}</td>
                        <td class="px-5 py-3.5 text-xs text-slate-400 font-medium">{{ $user->created_at->translatedFormat('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-3 bg-slate-50/50 text-center">
                <a href="{{ route('petugas.index') }}" class="text-[10px] font-bold text-slate-500 hover:text-slate-900 uppercase tracking-widest">Lihat Semua Petugas</a>
            </div>
        </div>

        <div class="space-y-4">
            <div class="bg-white p-6 rounded-xl border border-slate-100 shadow-[0_1px_2px_rgba(0,0,0,0.01)]">
                <div class="w-10 h-10 bg-slate-50 rounded-lg flex items-center justify-center mb-4 text-slate-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <h3 class="text-sm font-bold text-slate-800">Keamanan Akun</h3>
                <p class="text-[11px] text-slate-400 mt-2 leading-relaxed">Pastikan setiap petugas menggunakan email institusi yang valid. Jangan bagikan kredensial login kepada pihak ketiga.</p>
            </div>

            <div class="bg-indigo-50 border border-indigo-100 p-6 rounded-xl">
                <h3 class="text-sm font-bold text-indigo-900">Tips Admin</h3>
                <p class="text-[11px] text-indigo-600/80 mt-2 leading-relaxed">Anda dapat memantau log aktivitas barang melalui menu "Pusat Laporan" jika diperlukan audit data secara manual.</p>
            </div>
        </div>
    </div>
</div>
@endsection