@extends('layouts.app')

@section('content')
<div class="p-8">

    <div class="space-y-6">
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('petugas.create') }}"  
            class="px-5 py-2.5 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition shadow-lg shadow-gray-100 font-bold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round"/>
                </svg>
                Tambah Petugas
            </a>

            <button class="px-5 py-2.5 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition shadow-lg shadow-emerald-100 font-bold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Export Petugas
            </button>
        </div>

        <div class="bg-white p-5 rounded-3xl border border-gray-100 shadow-sm mb-6 mt-4">
            <form action="{{ route('petugas.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
                
                <div class="flex-1 min-w-62.5">
                    <label for="search" class="block text-xs font-black text-indigo-400 uppercase tracking-widest mb-2 ml-1">Cari Petugas</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" 
                        placeholder="Ketik nama atau email..."
                        class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm font-medium bg-slate-50">
                </div>
                
                <div class="flex gap-2">
                    <button type="submit" class="px-8 py-3 bg-indigo-600 text-white rounded-2xl font-bold text-sm hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">
                        Cari
                    </button>
                    
                    @if(request('search'))
                        <a href="{{ route('petugas.index') }}" class="px-8 py-3 bg-gray-100 text-gray-500 rounded-2xl font-bold text-sm hover:bg-gray-200 transition">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div id="alert-success" class="mb-6 animate-fade-in">
            <div class="bg-emerald-50 border border-emerald-100 text-emerald-600 px-6 py-4 rounded-2xl font-bold text-sm flex items-center gap-3">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="bg-white rounded-4xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50/50">
                <tr>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Petugas</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Email</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($users as $user)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-3">
                            <span class="font-bold text-slate-700">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-5 text-sm text-slate-500 font-medium">{{ $user->email }}</td>
                    <td class="px-8 py-5">
                        <div class="flex justify-center gap-3">
                            <a href="{{ route('petugas.edit', $user->id) }}" class="p-2 bg-amber-50 text-amber-600 rounded-lg hover:bg-amber-100 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-5 5l.5-2.5 7.5-7.5-3-3-7.5 7.5-2.5.5z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                            <form action="{{ route('petugas.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus user ini?')" class="p-2 bg-rose-50 text-rose-600 rounded-lg hover:bg-rose-100 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-8 py-10 text-center text-slate-400 font-medium italic">Data petugas tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection