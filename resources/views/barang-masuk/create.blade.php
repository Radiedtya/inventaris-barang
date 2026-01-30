@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    {{-- Header --}}
    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('barang-masuk.index') }}" class="p-2 bg-white border border-gray-100 rounded-lg text-gray-400 hover:text-indigo-600 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Catat Barang Masuk</h1>
            <p class="text-sm text-gray-500">Stok barang akan otomatis bertambah setelah data disimpan.</p>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
        <form action="{{ route('barang-masuk.store') }}" method="POST" class="p-8 space-y-6" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Pilih Barang --}}
                <div class="md:col-span-2">
                    <label for="barang_id" class="block text-sm font-semibold text-gray-700 mb-2">Pilih Barang</label>
                    <select name="barang_id" id="barang_id" 
                            class="w-full px-4 py-3 rounded-xl border @error('barang_id') border-red-500 @else border-gray-200 @enderror focus:ring-2 focus:ring-indigo-500 outline-none transition appearance-none bg-no-repeat bg-right bg-white"
                            style="background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%20fill%3D%22none%22%20stroke%3D%22%236B7280%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpath%20d%3D%22M6%209l6%206%206-6%22%3E%3C%2Fpath%3E%3C%2Fsvg%3E'); background-position: right 1rem center; background-size: 1.5em;"
                            required>
                        <option value="">-- Cari Nama Barang --</option>
                        @foreach($barangs as $b)
                            <option value="{{ $b->id }}" {{ old('barang_id') == $b->id ? 'selected' : '' }}>
                                {{ $b->nama_barang }} (Stok: {{ $b->stok }})
                            </option>
                        @endforeach
                    </select>
                    @error('barang_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Merek --}}


                {{-- Jumlah --}}
                <div class="md:col-span-2">
                    <label for="jumlah" class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Masuk</label>
                    <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah') }}" min="1"
                           class="w-full px-4 py-3 rounded-xl border @error('jumlah') border-red-500 @else border-gray-200 @enderror focus:ring-2 focus:ring-indigo-500 outline-none transition"
                           placeholder="0" required>
                    @error('jumlah') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Tanggal Masuk --}}
                <div class="md:col-span-2">
                    <label for="tanggal_masuk" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Transaksi</label>
                    <input type="date" name="tanggal_masuk" id="tanggal_masuk" 
                           value="{{ old('tanggal_masuk', date('Y-m-d')) }}"
                           class="w-full px-4 py-3 rounded-xl border @error('tanggal_masuk') border-red-500 @else border-gray-200 @enderror focus:ring-2 focus:ring-indigo-500 outline-none transition"
                           required>
                    @error('tanggal_masuk') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Keterangan --}}
                <div class="md:col-span-2">
                    <label for="keterangan" class="block text-sm font-semibold text-gray-700 mb-2">Keterangan (Opsional)</label>
                    <textarea name="keterangan" id="keterangan" rows="2" 
                              class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm"
                              placeholder="Tambah catatan kecil...">{{ old('keterangan') }}</textarea>
                </div>

                {{-- Bagian Foto yang Lia benerin styling-nya --}}
                <div class="md:col-span-2 space-y-4">
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest">
                        Bukti Masuk (Nota/Surat Jalan)
                    </label>

                    <div class="flex items-center gap-6 p-4 bg-slate-50 rounded-2xl border border-dashed border-gray-200">
                        <div class="relative flex-shrink-0">
                            <div class="w-24 h-24 rounded-2xl overflow-hidden border-2 border-white bg-white shadow-sm flex items-center justify-center">
                                <img id="image-preview" src="#" class="hidden w-full h-full object-cover">
                                <div id="placeholder-icon" class="text-gray-300">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="flex-1">
                            <input type="file" name="foto" id="foto-input" accept="image/*"
                                   class="block w-full text-xs text-slate-500
                                   file:mr-4 file:py-2 file:px-4
                                   file:rounded-lg file:border-0
                                   file:text-xs file:font-bold file:uppercase
                                   file:bg-indigo-600 file:text-white
                                   hover:file:bg-indigo-700 transition-all cursor-pointer">
                            <p class="mt-2 text-[10px] text-gray-400">Format: JPG, PNG, WEBP (Maks. 2MB)</p>
                        </div>
                    </div>
                    @error('foto') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Buttons --}}
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-50">
                <a href="{{ route('barang-masuk.index') }}" class="px-6 py-2.5 text-sm font-medium text-gray-400 hover:text-gray-600 transition">Batal</a>
                <button type="submit" 
                        class="px-8 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 font-bold">
                    Simpan Transaksi
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