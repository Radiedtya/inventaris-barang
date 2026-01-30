@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    {{-- Header --}}
    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('barang.index') }}" class="p-2 bg-white border border-gray-100 rounded-lg text-gray-400 hover:text-indigo-600 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Data Barang</h1>
            <p class="text-sm text-gray-500">Perbarui informasi untuk barang <span class="font-semibold text-indigo-600">"{{ $barang->nama_barang }}"</span></p>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
        <form action="{{ route('barang.update', $barang->id) }}" method="POST" class="p-8 space-y-6" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- PENTING: Biar Laravel tahu ini proses update --}}
            
            {{-- Input Nama Barang --}}
            <div>
                <label for="nama_barang" class="block text-sm font-semibold text-gray-700 mb-2">Nama Barang</label>
                <input type="text" 
                       name="nama_barang" 
                       id="nama_barang" 
                       value="{{ old('nama_barang', $barang->nama_barang) }}"
                       class="w-full px-4 py-3 rounded-xl border @error('nama_barang') border-red-500 @else border-gray-200 @enderror focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none text-gray-700"
                       required>
                @error('nama_barang')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Input Merek --}}
            <div>
                <label for="merek" class="block text-sm font-semibold text-gray-700 mb-2">Merek</label>
                <input type="text" 
                       name="merek" 
                       id="merek" 
                       value="{{ old('merek', $barang->merek) }}"
                       class="w-full px-4 py-3 rounded-xl border @error('merek') border-red-500 @else border-gray-200 @enderror focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none text-gray-700"
                       required>
                @error('merek')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input Stok --}}
            <div>
                <label for="stok" class="block text-sm font-semibold text-gray-700 mb-2">Stok Saat Ini</label>
                <input type="number" 
                       name="stok" 
                       id="stok" 
                       value="{{ old('stok', $barang->stok) }}"
                       class="w-full px-4 py-3 rounded-xl border @error('stok') border-red-500 @else border-gray-200 @enderror focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none text-gray-700"
                       required>
                <p class="mt-2 text-xs text-amber-500 italic flex items-center gap-1">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"/></svg>
                    Hati-hati, mengubah stok manual bisa membuat data transaksi tidak sinkron.
                </p>
                @error('stok')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-4">
                <label class="block text-sm font-extrabold text-slate-700 uppercase tracking-wider">
                    Ubah Foto Produk
                </label>

                <div class="flex items-start gap-6">
                    <div class="relative group">
                        <div class="w-32 h-32 rounded-3xl overflow-hidden border-2 border-indigo-100 bg-slate-50 flex items-center justify-center shadow-inner">
                            {{-- Logika: Jika ada foto lama tampilkan, jika tidak pakai placeholder --}}
                            <img id="image-preview" 
                                src="{{ $barang->foto_url }}" 
                                class="w-full h-full object-cover">
                        </div>
                        {{-- Badge Indikator --}}
                        <div class="absolute -bottom-2 -right-2 bg-indigo-600 text-white text-[10px] px-2 py-1 rounded-lg font-bold shadow-lg">
                            FOTO SAAT INI
                        </div>
                    </div>

                    <div class="flex-1">
                        <input type="file" name="foto" id="foto-input" accept="image/*"
                            class="block w-full text-sm text-slate-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-xl file:border-0
                            file:text-xs file:font-black file:uppercase
                            file:bg-indigo-50 file:text-indigo-700
                            hover:file:bg-indigo-100 transition-all cursor-pointer">
                        
                        <div class="mt-3 p-3 bg-amber-50 rounded-xl border border-amber-100">
                            <p class="text-[11px] text-amber-700 leading-relaxed font-medium">
                                <span class="font-bold">Info:</span> Biarkan kosong jika tidak ingin mengubah foto. Jika memilih foto baru, foto lama akan otomatis terhapus dari server.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-50">
                <a href="{{ route('barang.index') }}" 
                   class="px-6 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-800 transition">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 bg-amber-500 text-white rounded-xl hover:bg-amber-600 transition shadow-lg shadow-amber-200 font-bold">
                    Perbarui Data
                </button>
            </div>
        </form>
    </div>
</div>


<script>
    const fotoInput = document.getElementById('foto-input');
    const imagePreview = document.getElementById('image-preview');

    fotoInput.onchange = evt => {
        const [file] = fotoInput.files;
        if (file) {
            // Membuat URL sementara untuk file yang baru dipilih
            imagePreview.src = URL.createObjectURL(file);
            
            // Tambahkan sedikit efek border biar Ryn tahu ini sedang di-preview
            imagePreview.classList.add('ring-4', 'ring-indigo-500/20');
        }
    }
</script>
@endsection