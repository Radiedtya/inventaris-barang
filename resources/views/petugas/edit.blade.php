@extends('layouts.app')

@section('content')
<div class="p-8 max-w-2xl mx-auto">
    <div class="flex items-center gap-4 mb-10">
        <a href="{{ route('petugas.index') }}" class="w-10 h-10 flex items-center justify-center bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-indigo-600 hover:shadow-lg transition-all hover:-translate-x-1 duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h2 class="text-2xl font-black text-slate-800 tracking-tight">Edit Profil Petugas</h2>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Update Data: {{ $petugas->name }}</p>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-indigo-100/20 p-8 md:p-12 relative overflow-hidden">
        <div class="absolute -top-16 -right-16 w-40 h-40 bg-indigo-50/70 rounded-full blur-3xl opacity-60"></div>

        <form action="{{ route('petugas.update', $petugas->id) }}" method="POST" class="relative z-10 space-y-8">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div class="group">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2.5 ml-1 group-focus-within:text-indigo-600 transition-colors">Nama Lengkap Petugas</label>
                    <input type="text" name="name" value="{{ old('name', $petugas->name) }}" required
                        class="w-full px-6 py-4.5 bg-slate-50 border-2 border-transparent rounded-2xl focus:border-indigo-500 focus:bg-white outline-none transition-all duration-300 font-bold text-slate-700 placeholder:text-slate-300">
                    @error('name') <p class="text-rose-500 text-[10px] font-bold ml-1 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="group">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2.5 ml-1 group-focus-within:text-indigo-600 transition-colors">Email Akses Resmi</label>
                    <input type="email" name="email" value="{{ old('email', $petugas->email) }}" required
                        class="w-full px-6 py-4.5 bg-slate-50 border-2 border-transparent rounded-2xl focus:border-indigo-500 focus:bg-white outline-none transition-all duration-300 font-bold text-slate-700 placeholder:text-slate-300">
                    @error('email') <p class="text-rose-500 text-[10px] font-bold ml-1 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="p-7 bg-slate-50 rounded-4xl border border-slate-100 space-y-6 mt-4">
                    <div class="flex items-center gap-2.5 mb-2.5">
                        <div class="w-8 h-8 rounded-lg bg-indigo-100 flex items-center justify-center text-indigo-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <span class="text-[10px] font-black text-indigo-900 uppercase tracking-widest">Ganti Keamanan (Opsional)</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <input type="password" name="password" 
                            class="w-full px-6 py-4 bg-white border-2 border-transparent rounded-2xl focus:border-indigo-500 focus:bg-white outline-none transition-all font-bold text-slate-700 placeholder:text-slate-300"
                            placeholder="Password Baru">
                        
                        <input type="password" name="password_confirmation" 
                            class="w-full px-6 py-4 bg-white border-2 border-transparent rounded-2xl focus:border-indigo-500 focus:bg-white outline-none transition-all font-bold text-slate-700 placeholder:text-slate-300"
                            placeholder="Konfirmasi">
                    </div>
                    <p class="text-[9px] text-indigo-400 font-bold italic mt-2 ml-1">
                        *Biarkan kosong jika tidak ingin mengubah password lama.
                    </p>
                    @error('password') <p class="text-rose-500 text-[10px] font-bold ml-1 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <button type="submit" class="w-full py-5 bg-indigo-600 text-white rounded-2xl font-black text-xs uppercase tracking-[0.3em] shadow-xl shadow-indigo-100 hover:bg-indigo-700 hover:shadow-indigo-200 hover:-translate-y-1 active:scale-[0.98] transition-all duration-300">
                Simpan Perubahan Data
            </button>
        </form>
    </div>
</div>
@endsection