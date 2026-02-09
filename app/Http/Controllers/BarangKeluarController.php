<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Exports\BarangKeluarExport;
use Maatwebsite\Excel\Facades\Excel;

class BarangKeluarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // 1. Ambil daftar merek dari tabel Barang
        $daftarMerek = Barang::distinct()->pluck('merek');

        // 2. Query Barang Keluar dengan relasi
        $query = BarangKeluar::with('barang');

        // 3. Filter pakai whereHas karena merek ada di tabel sebelah
        if ($request->filled('merek')) {
            $query->whereHas('barang', function($q) use ($request) {
                $q->where('merek', $request->merek);
            });
        }

        $barangKeluars = $query->latest()->paginate(10);

        return view('barang-keluar.index', compact('barangKeluars', 'daftarMerek'));
    }

    public function create()
    {
        $barangs = Barang::where('stok', '>', 0)->get();
        return view('barang-keluar.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
            'tanggal_keluar' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048'
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        // Validasi stok (Jangan sampai minus)
        if ($request->jumlah > $barang->stok) {
            return back()->withErrors(['jumlah' => 'Stok tidak mencukupi! Sisa stok: ' . $barang->stok])->withInput();
        }

        DB::transaction(function () use ($request, $barang) {
            $keluar = new BarangKeluar();
            $keluar->barang_id = $request->barang_id;
            $keluar->jumlah = $request->jumlah;
            $keluar->keterangan = $request->keterangan;
            $keluar->tanggal_keluar = $request->tanggal_keluar;

            // Logika Foto
            if ($request->hasFile('foto')) {
                $img = $request->file('foto');
                $name = rand(1000, 9999) . $img->getClientOriginalName();
                $img->move(public_path('storage/transaksi_keluar'), $name);
                $keluar->foto = 'transaksi_keluar/' . $name;
            }

            $keluar->save();

            // Kurangi stok di tabel barang
            $barang->stok -= $request->jumlah;
            $barang->save();
        });

        return redirect()->route('barang-keluar.index')->with('success', 'Stok berhasil dikurangi!');
    }

    public function edit(string $id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);
        $barangs = Barang::all();
        return view('barang-keluar.edit', compact('barangKeluar', 'barangs'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
            'tanggal_keluar' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048'
        ]);

        $barangKeluar = BarangKeluar::findOrFail($id);

        DB::transaction(function () use ($request, $barangKeluar) {
            $barang = Barang::findOrFail($barangKeluar->barang_id);
            
            // Validasi stok buat update
            if ($request->jumlah > ($barang->stok + $barangKeluar->jumlah)) {
                throw new \Exception('Stok tidak mencukupi untuk update ini.');
            }

            // 1. Sesuaikan stok (Balikin stok lama dulu baru dikurangi yang baru)
            $barang->stok = ($barang->stok + $barangKeluar->jumlah) - $request->jumlah;
            $barang->save();

            // 2. Update data transaksi
            $barangKeluar->jumlah = $request->jumlah;
            $barangKeluar->keterangan = $request->keterangan;
            $barangKeluar->tanggal_keluar = $request->tanggal_keluar;

            // 3. Update Foto
            if ($request->hasFile('foto')) {
                if ($barangKeluar->foto && File::exists(public_path('storage/' . $barangKeluar->foto))) {
                    File::delete(public_path('storage/' . $barangKeluar->foto));
                }

                $img = $request->file('foto');
                $name = rand(1000, 9999) . $img->getClientOriginalName();
                $img->move(public_path('storage/transaksi_keluar'), $name);
                $barangKeluar->foto = 'transaksi_keluar/' . $name;
            }

            $barangKeluar->save();
        });

        return redirect()->route('barang-keluar.index')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy(string $id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);

        // Cara agar dihapus sekaligus mengembalikan stok
        // DB::transaction(function () use ($barangKeluar) {
        //     // Balikin stok barang (tambah lagi) karena transaksi keluar dihapus
        //     $barang = Barang::findOrFail($barangKeluar->barang_id);
        //     $barang->stok += $barangKeluar->jumlah;
        //     $barang->save();

        //     // Hapus file foto
        //     if ($barangKeluar->foto && File::exists(public_path('storage/' . $barangKeluar->foto))) {
        //         File::delete(public_path('storage/' . $barangKeluar->foto));
        //     }

        //     $barangKeluar->delete();
        // });

        // tanpa menambah stok kembali
        // Hapus file foto
        if ($barangKeluar->foto && File::exists(public_path('storage/' . $barangKeluar->foto))) {
            File::delete(public_path('storage/' . $barangKeluar->foto));
        }

        $barangKeluar->delete();


        return redirect()->route('barang-keluar.index')->with('success', 'Data dihapus dan stok dikembalikan.');
    }

    // Ekspor ke Excel
    public function export() 
    {
        // Tangkap merek dari URL
        $merek = $request->query('merek'); 
        
        // Kirim ke Constructor Export
        return Excel::download(new BarangKeluarExport($merek), 'laporan-barang-keluar.xlsx');
    }
}