<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; // Tambahin ini buat hapus file lama
use App\Exports\BarangMasukExport;
use Maatwebsite\Excel\Facades\Excel;

class BarangMasukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // 1. Ambil daftar merek dari tabel Barang untuk pilihan dropdown
        $daftarMerek = Barang::distinct()->pluck('merek');

        // 2. Mulai query dengan relasi barang
        $query = BarangMasuk::with('barang');

        // 3. Filter berdasarkan merek (lewat relasi)
        if ($request->filled('merek')) {
            $query->whereHas('barang', function($q) use ($request) {
                $q->where('merek', $request->merek);
            });
        }

        // 4. Gunakan paginate, bukan get
        $barangMasuks = $query->latest()->paginate(10);

        return view('barang-masuk.index', compact('barangMasuks', 'daftarMerek'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('barang-masuk.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
            'tanggal_masuk' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048'
        ]);

        DB::transaction(function () use ($request) {
            $masuk = new BarangMasuk();
            $masuk->barang_id = $request->barang_id;
            $masuk->jumlah = $request->jumlah;
            $masuk->keterangan = $request->keterangan;
            $masuk->tanggal_masuk = $request->tanggal_masuk;

            // Logika Foto
            if ($request->hasFile('foto')) {
                $img = $request->file('foto');
                $name = rand(1000, 9999) . $img->getClientOriginalName();
                $img->move(public_path('storage/transaksi'), $name);
                $masuk->foto = 'transaksi/' . $name;
            }

            $masuk->save();

            // Tambahin stok di tabel barang
            $barang = Barang::findOrFail($request->barang_id);
            $barang->stok += $request->jumlah;
            $barang->save();
        });

        return redirect()->route('barang-masuk.index')->with('success', 'Stok berhasil ditambah!');
    }

    public function edit(string $id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        $barangs = Barang::all();
        return view('barang-masuk.edit', compact('barangMasuk', 'barangs'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
            'tanggal_masuk' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048'
        ]);

        $barangMasuk = BarangMasuk::findOrFail($id);

        DB::transaction(function () use ($request, $barangMasuk) {
            $barang = Barang::findOrFail($barangMasuk->barang_id);
            
            // 1. Sesuaikan stok (Balikin stok lama dulu baru tambah yang baru)
            $barang->stok = ($barang->stok - $barangMasuk->jumlah) + $request->jumlah;
            $barang->save();

            // 2. Update data transaksi
            $barangMasuk->jumlah = $request->jumlah;
            $barangMasuk->keterangan = $request->keterangan;
            $barangMasuk->tanggal_masuk = $request->tanggal_masuk;

            // 3. Update Foto jika ada yang baru
            if ($request->hasFile('foto')) {
                // Hapus foto bukti yang lama jika ada
                if ($barangMasuk->foto && File::exists(public_path('storage/' . $barangMasuk->foto))) {
                    File::delete(public_path('storage/' . $barangMasuk->foto));
                }

                $img = $request->file('foto');
                $name = rand(1000, 9999) . $img->getClientOriginalName();
                $img->move(public_path('storage/transaksi'), $name);
                $barangMasuk->foto = 'transaksi/' . $name;
            }

            $barangMasuk->save();
        });

        return redirect()->route('barang-masuk.index')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy(string $id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);

        // DB::transaction(function () use ($barangMasuk) {
        //     // Kurangi stok barang karena transaksinya dibatalkan/dihapus
        //     $barang = Barang::findOrFail($barangMasuk->barang_id);
        //     $barang->stok -= $barangMasuk->jumlah;
        //     $barang->save();

        //     // Hapus file foto bukti
        //     if ($barangMasuk->foto && File::exists(public_path('storage/' . $barangMasuk->foto))) {
        //         File::delete(public_path('storage/' . $barangMasuk->foto));
        //     }

        //     $barangMasuk->delete();
        // });

        // Cara tanpa mengubah stok
        // Hapus file foto bukti
        if ($barangMasuk->foto && File::exists(public_path('storage/' . $barangMasuk->foto))) {
            File::delete(public_path('storage/' . $barangMasuk->foto));
        }

        $barangMasuk->delete();

        return redirect()->route('barang-masuk.index')->with('success', 'Data dihapus dan stok sudah disesuaikan.');
    }

    // Tambahkan method export
    public function export(Request $request) 
    {
        // Ambil merek dari URL
        $merek = $request->query('merek'); 

        // Kirim variabel $merek ke constructor file Export
        return Excel::download(new BarangMasukExport($merek), 'laporan-barang-masuk.xlsx');
    }
}