<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use PDF; // Import alias DomPDF

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('laporan.index');
    }

    public function cetakBarang()
    {
        $data = Barang::all();
        $pdf = PDF::loadView('laporan.pdf_barang', compact('data'));
        return $pdf->stream('laporan-stok-barang.pdf');
    }

    public function cetakMasuk(Request $request)
    {
        // Kita kasih filter tanggal biar laporannya bisa per periode
        $data = BarangMasuk::with('barang')
                ->whereBetween('tanggal_masuk', [$request->tgl_awal, $request->tgl_akhir])
                ->get();
        
        $pdf = PDF::loadView('laporan.pdf_masuk', compact('data'));
        return $pdf->stream('laporan-barang-masuk.pdf');
    }

    public function cetakKeluar(Request $request)
    {
        $data = BarangKeluar::with('barang')
                ->whereBetween('tanggal_keluar', [$request->tgl_awal, $request->tgl_akhir])
                ->get();
        
        $pdf = PDF::loadView('laporan.pdf_keluar', compact('data'));
        return $pdf->stream('laporan-barang-keluar.pdf');
    }
}