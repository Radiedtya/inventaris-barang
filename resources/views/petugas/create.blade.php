@extends('layouts.app')

@section('content')
<div class="p-8 max-w-2xl mx-auto">
    <div class="flex items-center gap-4 mb-10">
        <a href="{{ route('petugas.index') }}" class="w-10 h-10 flex items-center justify-center bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-indigo-600 hover:shadow-lg transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h2 class="text-2xl font-black text-slate-800 tracking-tight">{{ isset($petugas) ? 'Edit Petugas' : 'Petugas Baru' }}</h2>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Master User Configuration</p>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-indigo-100/20 p-8 md:p-12 relative overflow-hidden">
        <div class="absolute -top-12 -right-12 w-32 h-32 bg-indigo-50 rounded-full opacity-50"></div>

        <form action="{{ isset($petugas) ? route('petugas.update', $petugas->id) : route('petugas.store') }}" method="POST" class="relative z-10 space-y-8">
            @csrf
            @if(isset($petugas)) @method('PUT') @endif

            <div class="space-y-6">
                <div class="group">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1 group-focus-within:text-indigo-600 transition-colors">Nama Lengkap Petugas</label>
                    <input type="text" name="name" value="{{ old('name', $petugas->name ?? '') }}" required
                        class="w-full px-6 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:border-indigo-500 focus:bg-white outline-none transition-all font-bold text-slate-700 placeholder:text-slate-300"
                        placeholder="Misal: Ahmad Dani">
                </div>

                <div class="group">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1 group-focus-within:text-indigo-600 transition-colors">Email Akses</label>
                    <input type="email" name="email" value="{{ old('email', $petugas->email ?? '') }}" required
                        class="w-full px-6 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:border-indigo-500 focus:bg-white outline-none transition-all font-bold text-slate-700 placeholder:text-slate-300"
                        placeholder="ahmad@ryndev.com">
                </div>

                <div class="p-6 bg-slate-50/50 rounded-4xl border border-slate-100 space-y-6">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Keamanan Akun</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="password" name="password" {{ isset($petugas) ? '' : 'required' }}
                            class="w-full px-6 py-4 bg-white border-2 border-transparent rounded-2xl focus:border-indigo-500 outline-none transition-all font-bold text-slate-700"
                            placeholder="Password Baru">
                        
                        <input type="password" name="password_confirmation" {{ isset($petugas) ? '' : 'required' }}
                            class="w-full px-6 py-4 bg-white border-2 border-transparent rounded-2xl focus:border-indigo-500 outline-none transition-all font-bold text-slate-700"
                            placeholder="Konfirmasi">
                    </div>
                    @if(isset($petugas))
                        <p class="text-[9px] text-slate-400 font-bold italic">*Kosongkan jika tidak ingin ganti password</p>
                    @endif
                </div>
            </div>

            <button type="submit" class="w-full py-5 bg-indigo-600 text-white rounded-2xl font-black text-xs uppercase tracking-[0.3em] shadow-xl shadow-indigo-100 hover:bg-indigo-700 hover:shadow-indigo-200 active:scale-[0.98] transition-all">
                {{ isset($petugas) ? 'Perbarui Akses' : 'Buat Akun Petugas' }}
            </button>
        </form>
    </div>
</div>
@endsection