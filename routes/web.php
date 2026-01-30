<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;

Route::get('/', function () {
    return view('startup');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// --- MASTER BARANG ---
Route::get('/barang/export', [BarangController::class, 'export'])->name('barang.export');
Route::resource('barang', BarangController::class);

// --- BARANG MASUK (Export ditaruh SEBELUM resource) ---
Route::get('/barang-masuk/export', [BarangMasukController::class, 'export'])->name('barang-masuk.export');
Route::resource('barang-masuk', App\Http\Controllers\BarangMasukController::class);

// --- BARANG KELUAR (Sekalian buat export-nya juga ya) ---
Route::get('/barang-keluar/export', [BarangKeluarController::class, 'export'])->name('barang-keluar.export');
Route::resource('barang-keluar', App\Http\Controllers\BarangKeluarController::class);

// --- PEMINJAMAN BARANG ---
// 1. Route Khusus Pengembalian (Taruh di atas resource biar gak bentrok)
Route::post('/peminjaman/{id}/kembalikan', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan');

// 2. Route CRUD Peminjaman
Route::resource('peminjaman', PeminjamanController::class);

// --- LAPORAN ---
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/barang', [LaporanController::class, 'cetakBarang'])->name('laporan.barang');
Route::get('/laporan/masuk', [LaporanController::class, 'cetakMasuk'])->name('laporan.masuk');
Route::get('/laporan/keluar', [LaporanController::class, 'cetakKeluar'])->name('laporan.keluar');

Route::fallback(function () {
    return view('errors.404');
});