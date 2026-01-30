<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Import Model-model kamu di sini
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;

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
            
            $dataMasuk[] = \App\Models\BarangMasuk::whereDate('tanggal_masuk', $date)->sum('jumlah');
            $dataKeluar[] = \App\Models\BarangKeluar::whereDate('tanggal_keluar', $date)->sum('jumlah');
        }

        $data = [
            'totalBarang' => \App\Models\Barang::count(),
            'totalMasuk'  => \App\Models\BarangMasuk::whereMonth('tanggal_masuk', now()->month)->count(),
            'totalKeluar' => \App\Models\BarangKeluar::whereMonth('tanggal_keluar', now()->month)->count(),
            'lastMasuk'   => \App\Models\BarangMasuk::with('barang')->latest()->first(),
            'lastKeluar'  => \App\Models\BarangKeluar::with('barang')->latest()->first(),
            'labels'      => $labels,
            'dataMasuk'   => $dataMasuk,
            'dataKeluar'  => $dataKeluar,
        ];

        return view('home', $data);
    }
}