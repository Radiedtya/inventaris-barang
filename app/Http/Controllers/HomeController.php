<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Ambil data 7 hari terakhir untuk grafik
        $labels = [];
        $dataMasuk = [];
        $dataKeluar = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $labels[] = now()->subDays($i)->translatedFormat('d M');
            
            $dataMasuk[] = BarangMasuk::whereDate('tanggal_masuk', $date)->sum('jumlah');
            $dataKeluar[] = BarangKeluar::whereDate('tanggal_keluar', $date)->sum('jumlah');
        }

        $data = [
            'totalBarang'    => Barang::count(),
            'totalMasuk'     => BarangMasuk::whereMonth('tanggal_masuk', now()->month)->count(),
            'totalKeluar'    => BarangKeluar::whereMonth('tanggal_keluar', now()->month)->count(),
            
            // --- DATA TAMBAHAN DARI LIA ---
            'totalDipinjam'  => Peminjaman::where('status', 'dipinjam')->sum('jumlah'),
            'lastPeminjaman' => Peminjaman::with('barang')->latest()->first(),
            // ------------------------------

            'lastMasuk'      => BarangMasuk::with('barang')->latest()->first(),
            'lastKeluar'     => BarangKeluar::with('barang')->latest()->first(),
            'labels'         => $labels,
            'dataMasuk'      => $dataMasuk,
            'dataKeluar'     => $dataKeluar,
        ];

        return view('home', $data); // Pastikan nama view-nya sesuai (home atau dashboard)
    }
}