<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Dashboard Petugas
    public function index()
    {
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
            'totalDipinjam'  => Peminjaman::where('status', 'dipinjam')->sum('jumlah'),
            'lastPeminjaman' => Peminjaman::with('barang')->latest()->first(),
            'lastMasuk'      => BarangMasuk::with('barang')->latest()->first(),
            'lastKeluar'     => BarangKeluar::with('barang')->latest()->first(),
            'labels'         => $labels,
            'dataMasuk'      => $dataMasuk,
            'dataKeluar'     => $dataKeluar,
        ];

        return view('home', $data);
    }

    // ==========================================
    // Dashboard Khusus Admin
    // ==========================================
    public function adminIndex()
    {
        $data = [
            'totalPetugas' => User::where('role', 'petugas')->count(),
            'totalAdmin'   => User::where('role', 'admin')->count(),
            'recentUsers'  => User::where('role', 'petugas')->latest()->take(5)->get(),
            // Admin juga bisa liat ringkasan aset secara global
            'totalAset'    => Barang::sum('stok'),
        ];

        return view('dashboard_admin', $data);
    }
}