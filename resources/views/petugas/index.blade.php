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
                <p class="text-xs font-semibold text-slate-900">Sistem Diperbarui</p>
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
            <h1 class="text-xl font-bold text-slate-900 tracking-tight">Konfigurasi Operator</h1>
            <p class="text-xs font-medium text-slate-400 mt-1">Kelola hak akses autentikasi, kredensial akun, serta penugasan petugas inventaris gudang.</p>
        </div>

        <div class="flex items-center gap-2">
            {{-- Tombol Export --}}
            <button class="h-9 px-3.5 bg-white border border-slate-200 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors text-xs font-semibold flex items-center gap-1.5 shadow-[0_1px_2px_rgba(0,0,0,0.01)]">
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Export Data
            </button>

            {{-- Tombol Tambah --}}
            <a href="{{ route('petugas.create') }}"  
               class="h-9 px-3.5 bg-slate-900 text-white rounded-lg hover:bg-slate-800 transition-colors text-xs font-semibold flex items-center gap-1.5 shadow-sm">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path d="M12 4v16m8-8H4" stroke-linecap="round"/>
                </svg>
                Registrasi Petugas
            </a>
        </div>
    </div>

    {{-- Pencarian Konten (Matte Filter Area) --}}
    <div class="bg-slate-50/60 border border-slate-200/50 p-4 rounded-xl">
        <form action="{{ route('petugas.index') }}" method="GET" class="flex flex-col sm:flex-row items-stretch sm:items-end gap-3">
            
            <div class="flex-1">
                <label for="search" class="block text-[10px] font-semibold text-slate-400 uppercase tracking-wider mb-1.5 ml-0.5">Cari Akun Petugas</label>
                <div class="relative">
                    <input type="text" name="search" id="search" value="{{ request('search') }}" 
                           placeholder="Masukkan nama lengkap atau alamat email akun..."
                           class="w-full h-9 px-3 rounded-lg border border-slate-200 bg-white focus:border-slate-400 focus:ring-0 outline-none transition-all text-xs font-medium text-slate-700 placeholder-slate-400">
                </div>
            </div>
            
            <div class="flex items-center gap-2 shrink-0">
                <button type="submit" class="h-9 px-6 bg-white border border-slate-200 text-slate-700 rounded-lg text-xs font-semibold hover:bg-slate-50 transition-colors shadow-[0_1px_2px_rgba(0,0,0,0.01)]">
                    Cari Data
                </button>
                
                @if(request('search'))
                    <a href="{{ route('petugas.index') }}" class="h-9 px-4 bg-slate-200/70 text-slate-600 rounded-lg text-xs font-medium hover:bg-slate-200 transition-colors flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Table Area --}}
    <div class="bg-white border border-slate-100 rounded-xl shadow-[0_1px_2px_rgba(0,0,0,0.01)] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50/70 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-3 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Nama Lengkap</th>
                        <th class="px-6 py-3 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Alamat Email</th>
                        <th class="px-6 py-3 text-[10px] font-semibold text-slate-400 uppercase tracking-wider text-center w-28">Aksi</th>
                    </tr>
                </thead>
                
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $user)
                    <tr class="hover:bg-slate-50/30 transition-colors">
                        
                        {{-- Nama Petugas --}}
                        <td class="px-6 py-3.5 text-xs font-semibold text-slate-700">
                            {{ $user->name }}
                        </td>

                        {{-- Email Petugas --}}
                        <td class="px-6 py-3.5 text-xs text-slate-500 font-medium">
                            {{ $user->email }}
                        </td>

                        {{-- Tombol Aksi --}}
                        <td class="px-6 py-3.5">
                            <div class="flex justify-center items-center gap-1">
                                <a href="{{ route('petugas.edit', $user->id) }}" class="p-1.5 text-slate-400 hover:text-amber-500 hover:bg-amber-50 rounded-md transition-all" title="Ubah Profil Akun">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-5 5l.5-2.5 7.5-7.5-3-3-7.5 7.5-2.5.5z" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                                
                                <form action="{{ route('petugas.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus seluruh hak akses akun petugas ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50/50 rounded-md transition-all" title="Cabut Akses Akun">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center gap-2 text-slate-300">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <p class="text-xs font-medium text-slate-400">Data akun atau operator yang dicari tidak terdaftar.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection