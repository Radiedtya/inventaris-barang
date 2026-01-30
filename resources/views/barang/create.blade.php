@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Tambah Barang Baru</h1>
        <p class="text-sm text-gray-500">Masukkan detail barang untuk menambah stok gudang kita.</p>
    </div>

    {{-- Form Card --}}
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
        <form action="{{ route('barang.store') }}" method="POST" class="p-8 space-y-6" enctype="multipart/form-data">
            @csrf
            
            {{-- Input Nama Barang --}}
            <div>
                <label for="nama_barang" class="block text-sm font-semibold text-gray-700 mb-2">Nama Barang</label>
                <input type="text" 
                       name="nama_barang" 
                       id="nama_barang" 
                       value="{{ old('nama_barang') }}"
                       class="w-full px-4 py-3 rounded-xl border @error('nama_barang') border-red-500 @else border-gray-200 @enderror focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none text-gray-700"
                       placeholder="Contoh: Laptop MacBook Pro"
                       autocomplete="off"
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
                       value="{{ old('merek') }}"
                       class="w-full px-4 py-3 rounded-xl border @error('merek') border-red-500 @else border-gray-200 @enderror focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none text-gray-700"
                       placeholder="Contoh: Apple"
                       autocomplete="off"
                       required>
                @error('merek')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input Stok Awal --}}
            <div>
                <label for="stok" class="block text-sm font-semibold text-gray-700 mb-2">Stok Awal</label>
                <div class="relative">
                    <input type="number" 
                           name="stok" 
                           id="stok" 
                           value="{{ old('stok', 0) }}"
                           class="w-full px-4 py-3 rounded-xl border @error('stok') border-red-500 @else border-gray-200 @enderror focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none text-gray-700"
                           required>
                </div>
                <p class="mt-2 text-xs text-gray-400 italic">*Nilai ini akan menjadi stok pembuka barang.</p>
                @error('stok')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-4">
                <label class="block text-sm font-extrabold text-slate-700 uppercase tracking-wider">
                    Foto Produk
                </label>

                <div class="flex items-start gap-6">
                    <div class="relative group">
                        <div class="w-32 h-32 rounded-3xl overflow-hidden border-2 border-dashed border-gray-200 bg-gray-50 flex items-center justify-center transition-all group-hover:border-indigo-300">
                            @if(isset($barang) && $barang->foto)
                                <img id="image-preview" src="{{ $barang->foto_url }}" class="w-full h-full object-cover">
                            @else
                                <img id="image-preview" src="#" class="hidden w-full h-full object-cover">
                                <div id="placeholder-icon" class="text-gray-300 flex flex-col items-center">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span class="text-[10px] font-bold mt-1 uppercase">Pilih Foto</span>
                                </div>
                            @endif
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
                        
                        <p class="mt-2 text-xs text-gray-400 leading-relaxed">
                            Gunakan foto produk dengan latar belakang bersih. <br>
                            Format: <span class="text-slate-600 font-bold">JPG, PNG, WEBP</span> (Maks. 2MB)
                        </p>
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
                        class="px-6 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 font-bold">
                    Simpan Barang
                </button>
            </div>
        </form>
    </div>
</div>


<script>
    const fotoInput = document.getElementById('foto-input');
    const imagePreview = document.getElementById('image-preview');
    const placeholderIcon = document.getElementById('placeholder-icon');

    fotoInput.onchange = evt => {
        const [file] = fotoInput.files;
        if (file) {
            imagePreview.src = URL.createObjectURL(file);
            imagePreview.classList.remove('hidden');
            if (placeholderIcon) {
                placeholderIcon.classList.add('hidden');
            }
        }
    }
</script>
@endsection