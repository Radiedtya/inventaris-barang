<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    // 1. Tampilkan semua data peminjaman
    public function index(Request $request)
    {
        $daftarMerek = Barang::distinct()->pluck('merek');
        $query = Peminjaman::with('barang');

        // Filter merek
        if ($request->filled('merek')) {
            $query->whereHas('barang', function($q) use ($request) {
                $q->where('merek', $request->merek);
            });
        }

        $peminjamans = $query->latest()->paginate(10);
        return view('peminjaman.index', compact('peminjamans', 'daftarMerek'));
    }

    // 2. Form Tambah Pinjam
    public function create()
    {
        $barangs = Barang::where('stok', '>', 0)->get(); // Cuma barang yang ada stoknya
        return view('peminjaman.create', compact('barangs'));
    }

    // 3. Simpan Peminjaman (Stok Berkurang)
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'nama_peminjam' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        // Validasi: Stok cukup
        if ($barang->stok < $request->jumlah) {
            return back()->with('error', 'Maaf, stok tidak cukup untuk dipinjam.');
        }

        // Simpan transaksi
        Peminjaman::create([
            'barang_id' => $request->barang_id,
            'nama_peminjam' => $request->nama_peminjam,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'status' => 'dipinjam',
            'keterangan' => $request->keterangan,
        ]);

        // KURANGI STOK
        $barang->decrement('stok', $request->jumlah);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dicatat!');
    }

    // 4. Fitur Pengembalian (Stok Bertambah)
    public function kembalikan($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        if ($pinjam->status === 'dikembalikan') {
            return back()->with('info', 'Barang ini sudah dikembalikan kok.');
        }

        // Update transaksi
        $pinjam->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now(),
        ]);

        // TAMBAH STOK LAGI
        $pinjam->barang->increment('stok', $pinjam->jumlah);

        return back()->with('success', 'Barang sudah kembali, stok sudah update ya!');
    }

    // 5. Hapus (Kalau salah input)
    public function destroy($id)
    {
        $pinjam = Peminjaman::findOrFail($id);
        
        // Logic Aman: Kalau status masih "dipinjam" tapi datanya dihapus, 
        // sebaiknya stok dikembalikan dulu biar gak "hilang" di sistem.
        if ($pinjam->status === 'dipinjam') {
            $pinjam->barang->increment('stok', $pinjam->jumlah);
        }

        $pinjam->delete();
        return back()->with('success', 'Data peminjaman berhasil dihapus.');
    }
}