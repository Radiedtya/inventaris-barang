<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;
use App\Exports\BarangExport;
use Maatwebsite\Excel\Facades\Excel;

class BarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // 1. Ambil semua merek yang ada (biar muncul di pilihan dropdown)
        $daftarMerek = Barang::distinct()->pluck('merek');

        // 2. Siapkan query
        $query = Barang::query();

        // 3. Cek kalau user lagi pilih merek tertentu
        if ($request->has('merek') && $request->merek != '') {
            $query->where('merek', $request->merek);
        }

        // 4. Ambil datanya
        $barangs = $query->latest()->paginate(10);

        return view('barang.index', compact('barangs', 'daftarMerek'));
    }

    public function create(): View
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|max:255',
            'merek'       => 'required|max:255',
            'stok'        => 'required|integer|min:0',
            'foto'        => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048'
        ], [
            'nama_barang.required' => 'Nama barang wajib diisi yaa!',
            'merek.required'       => 'Merek wajib diisi!',
            'stok.required'        => 'Stok wajib diisi!',
            'foto.image'           => 'File harus berupa gambar',
        ]);

        $barang = new Barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->merek       = $request->merek;
        $barang->stok        = $request->stok;

        if ($request->hasFile('foto')) {
            $img = $request->file('foto');
            // Membuat nama unik: angka random + nama asli file
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            // Pindahkan langsung ke public/storage/produk
            $img->move(public_path('storage/produk'), $name);
            // Simpan nama filenya saja ke database
            $barang->foto = 'produk/' . $name; 
        }

        $barang->save();
        
        return redirect()->route('barang.index')->with('success', 'Barang baru berhasil dicatat!');
    }

    public function edit($id): View
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|max:255',
            'merek'       => 'required|max:255',
            'stok'        => 'required|integer|min:0',
            'foto'        => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048'
        ]);

        $barang = Barang::findOrFail($id);
        $barang->nama_barang = $request->nama_barang;
        $barang->merek       = $request->merek;
        $barang->stok        = $request->stok;

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($barang->foto) {
                $oldPath = public_path('storage/' . $barang->foto);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            $img = $request->file('foto');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move(public_path('storage/produk'), $name);
            $barang->foto = 'produk/' . $name;
        }

        $barang->save();
        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        if ($barang->foto) {
            $filePath = public_path('storage/' . $barang->foto);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }

    // Ekspor ke Excel
    public function export(Request $request)
    {
        // Mengambil merek dari request
        $merek = $request->query('merek'); 
        
        return Excel::download(new BarangExport($merek), 'data-stok-barang.xlsx');
    }
}