@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    {{-- Header --}}
    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('barang-keluar.index') }}" class="p-2 bg-white border border-gray-100 rounded-lg text-gray-400 hover:text-rose-600 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Pengeluaran Barang</h1>
            <p class="text-sm text-gray-500">Perubahan jumlah akan otomatis menyesuaikan stok di gudang.</p>
        </div>
    </div>

    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
        <form action="{{ route('barang-keluar.update', $barangKeluar->id) }}" method="POST" class="p-8 space-y-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Nama Barang (Read Only) --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Barang</label>
                    <input type="text" value="{{ $barangKeluar->barang->nama_barang }}" 
                           class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 text-gray-500 outline-none" readonly>
                    <input type="hidden" name="barang_id" value="{{ $barangKeluar->barang_id }}">
                </div>

                {{-- Merek --}}

                {{-- Jumlah --}}
                <div>
                    <label for="jumlah" class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Keluar</label>
                    <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', $barangKeluar->jumlah) }}" min="1"
                           class="w-full px-4 py-3 rounded-xl border @error('jumlah') border-red-500 @else border-gray-200 @enderror focus:ring-2 focus:ring-rose-500 outline-none transition" required>
                    @error('jumlah') <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                </div>

                {{-- Tanggal --}}
                <div>
                    <label for="tanggal_keluar" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Keluar</label>
                    <input type="date" name="tanggal_keluar" id="tanggal_keluar" value="{{ old('tanggal_keluar', $barangKeluar->tanggal_keluar) }}"
                           class="w-full px-4 py-3 rounded-xl border @error('tanggal_keluar') border-red-500 @else border-gray-200 @enderror focus:ring-2 focus:ring-rose-500 outline-none transition" required>
                </div>

                {{-- Keterangan --}}
                <div class="md:col-span-2">
                    <label for="keterangan" class="block text-sm font-semibold text-gray-700 mb-2">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" rows="2" 
                              class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-rose-500 outline-none transition text-sm">{{ old('keterangan', $barangKeluar->keterangan) }}</textarea>
                </div>

                {{-- Update Foto Bukti --}}
                <div class="md:col-span-2 space-y-4">
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest">Update Bukti Foto</label>
                    <div class="flex items-center gap-6 p-4 bg-slate-50 rounded-2xl border border-dashed border-gray-200">
                        <div class="w-24 h-24 rounded-2xl overflow-hidden border-2 border-white bg-white shadow-sm">
                            <img id="image-preview" src="{{ $barangKeluar->foto_url }}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <input type="file" name="foto" id="foto-input" accept="image/*"
                                   class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-rose-600 file:text-white hover:file:bg-rose-700 cursor-pointer">
                            <p class="mt-2 text-[10px] text-gray-400">Kosongkan jika tidak ingin mengganti bukti foto.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-50">
                <a href="{{ route('barang-keluar.index') }}" class="px-6 py-2.5 text-sm font-medium text-gray-400 transition">Batal</a>
                <button type="submit" class="px-8 py-2.5 bg-rose-600 text-white rounded-xl hover:bg-rose-700 transition shadow-lg shadow-rose-100 font-bold">
                    Update Pengeluaran
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
            imagePreview.src = URL.createObjectURL(file);
        }
    }
</script>
@endsection