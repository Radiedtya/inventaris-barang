<?php

use Illuminate\Support\Facades\Route; 
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\UserController; // Untuk CRUD Petugas
use App\Http\Controllers\HomeController;

// --- PUBLIC ROUTES ---
Route::get('/', function () {
    return view('startup');
});

// Auth Google
Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google.login');
Route::get('auth/google/callback', [GoogleAuthController::class, 'callback']);

Auth::routes();

// --- PROTECTED ROUTES (Harus Login) ---
Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

    // --- MASTER BARANG ---
    Route::get('/barang/export', [BarangController::class, 'export'])->name('barang.export');
    Route::resource('barang', BarangController::class);

    // --- BARANG MASUK ---
    Route::get('/barang-masuk/export', [BarangMasukController::class, 'export'])->name('barang-masuk.export');
    Route::resource('barang-masuk', BarangMasukController::class);

    // --- BARANG KELUAR ---
    Route::get('/barang-keluar/export', [BarangKeluarController::class, 'export'])->name('barang-keluar.export');
    Route::resource('barang-keluar', BarangKeluarController::class);

    // --- PEMINJAMAN BARANG ---
    Route::get('/peminjaman/export-excel', [PeminjamanController::class, 'exportExcel'])->name('peminjaman.excel'); // Route Excel Baru
    Route::get('/peminjaman/export', [PeminjamanController::class, 'export'])->name('peminjaman.export');
    Route::post('/peminjaman/{id}/kembalikan', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan');
    Route::resource('peminjaman', PeminjamanController::class);

    // --- LAPORAN ---
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/barang', [LaporanController::class, 'cetakBarang'])->name('laporan.barang');
    Route::get('/laporan/masuk', [LaporanController::class, 'cetakMasuk'])->name('laporan.masuk');
    Route::get('/laporan/keluar', [LaporanController::class, 'cetakKeluar'])->name('laporan.keluar');
    Route::get('/laporan/peminjaman', [LaporanController::class, 'cetakPeminjaman'])->name('laporan.peminjaman');

    // --- KHUSUS ROLE ADMIN ---
    Route::middleware(['role:admin'])->group(function () {
        // CRUD Data Petugas (Menggunakan UserController)
        Route::resource('petugas', UserController::class);
    });
});

// --- 404 FALLBACK ---
Route::fallback(function () {
    return view('errors.404');
});