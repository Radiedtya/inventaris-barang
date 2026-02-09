@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 pb-12">
    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
        <div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">Halo, {{ Auth::user()->name }} 👋</h1>
            <p class="text-slate-500 font-medium mt-1">Ini ringkasan gudang kamu untuk hari ini.</p>
        </div>
        <div class="flex items-center gap-3 bg-white p-2 rounded-2xl shadow-sm border border-slate-100">
            <div class="bg-indigo-600 p-2 rounded-xl">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
            <div class="pr-4">
                <p class="text-[10px] uppercase font-black text-slate-400 leading-none">Tanggal</p>
                <p class="text-sm font-bold text-slate-700">{{ now()->translatedFormat('l, d M Y') }}</p>
            </div>
        </div>
    </div>

    {{-- Stats Row --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        {{-- Card: Total Barang --}}
        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm relative overflow-hidden group">
            <div class="relative z-10">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Stok Barang</p>
                <h3 class="text-3xl font-black text-slate-900">{{ $totalBarang ?? 0 }}</h3>
                <p class="text-[10px] text-slate-400 mt-2 font-medium">Total jenis item terdaftar</p>
            </div>
            <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:scale-110 transition-transform duration-500">
                <svg class="w-24 h-24 text-indigo-600" fill="currentColor" viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
        </div>

        {{-- Card: Peminjaman Aktif --}}
        <div class="bg-indigo-500 p-6 rounded-[2rem] shadow-lg shadow-indigo-200 relative overflow-hidden group">
            <div class="relative z-10">
                <p class="text-xs font-bold text-indigo-100 uppercase tracking-widest mb-1">Sedang Dipinjam</p>
                <h3 class="text-3xl font-black text-white">{{ $totalDipinjam ?? 0 }}</h3>
                <a href="{{ route('peminjaman.index') }}" class="inline-flex items-center text-[10px] text-indigo-100 mt-3 font-bold uppercase hover:underline">Pantau Peminjam →</a>
            </div>
            <div class="absolute -right-2 -bottom-2 opacity-20 group-hover:scale-110 transition-transform duration-500 text-white">
                <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
        </div>

        {{-- Card: Inbound --}}
        <div class="bg-emerald-500 p-6 rounded-[2rem] shadow-lg shadow-emerald-200 relative overflow-hidden group">
            <div class="relative z-10">
                <p class="text-xs font-bold text-emerald-100 uppercase tracking-widest mb-1">Masuk (Bulan Ini)</p>
                <h3 class="text-3xl font-black text-white">{{ $totalMasuk ?? 0 }}</h3>
                <a href="{{ route('barang-masuk.index') }}" class="inline-flex items-center text-[10px] text-emerald-100 mt-3 font-bold uppercase hover:underline">Lihat Detail →</a>
            </div>
        </div>

        {{-- Card: Outbound --}}
        <div class="bg-rose-500 p-6 rounded-[2rem] shadow-lg shadow-rose-200 relative overflow-hidden group">
            <div class="relative z-10">
                <p class="text-xs font-bold text-rose-100 uppercase tracking-widest mb-1">Keluar (Bulan Ini)</p>
                <h3 class="text-3xl font-black text-white">{{ $totalKeluar ?? 0 }}</h3>
                <a href="{{ route('barang-keluar.index') }}" class="inline-flex items-center text-[10px] text-rose-100 mt-3 font-bold uppercase hover:underline">Lihat Detail →</a>
            </div>
        </div>

        {{-- Quick Add Shortcut --}}
        <div class="bg-slate-900 p-6 rounded-[2rem] shadow-xl flex flex-col justify-center items-center text-center">
            <p class="text-white/50 text-[10px] font-bold uppercase mb-3">Aksi Cepat</p>
            <div class="flex gap-3">
                <a href="{{ route('barang.create') }}" class="w-10 h-10 bg-white/10 hover:bg-white text-white hover:text-slate-900 rounded-full flex items-center justify-center transition-all" title="Tambah Barang Baru">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round"/></svg>
                </a>
                <a href="{{ route('barang-masuk.create') }}" class="w-10 h-10 bg-emerald-500/20 hover:bg-emerald-500 text-emerald-500 hover:text-white rounded-full flex items-center justify-center transition-all" title="Input Barang Masuk">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M7 11l5-5m0 0l5 5m-5-5v12" stroke-width="2" stroke-linecap="round"/></svg>
                </a>
                <a href="{{ route('barang-keluar.create') }}" class="w-10 h-10 bg-rose-500/20 hover:bg-rose-500 text-rose-500 hover:text-white rounded-full flex items-center justify-center transition-all" title="Input Barang Keluar">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 13l-5 5m0 0l-5-5m5 5V6" stroke-width="2" stroke-linecap="round"/></svg>
                </a>
                <a href="{{ route('peminjaman.create') }}" class="w-10 h-10 bg-indigo-500/20 hover:bg-indigo-500 text-indigo-500 hover:text-white rounded-full flex items-center justify-center transition-all" title="Input Peminjaman">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" stroke-linecap="round"/></svg>
                </a>
            </div>
        </div>
    </div>

    {{-- Main Content Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Chart Section (Left) --}}
        <div class="lg:col-span-2 bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-xl font-black text-slate-800 uppercase tracking-tighter italic">Analisis Arus Barang</h2>
                    <p class="text-xs text-slate-400 font-medium">Data 7 hari terakhir</p>
                </div>
            </div>
            <div class="h-80">
                <canvas id="inventoryChart"></canvas>
            </div>
        </div>

        {{-- Recent Activity Section (Right) --}}
        <div class="space-y-6">
            <h2 class="text-xl font-black text-slate-800 uppercase tracking-tighter italic px-2">Update Terakhir</h2>
            
            {{-- Last Inbound --}}
            <div class="bg-white p-5 rounded-[2rem] border border-slate-100 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-[10px] font-black text-emerald-500 bg-emerald-50 px-3 py-1 rounded-full uppercase">Barang Masuk</span>
                </div>
                @if($lastMasuk)
                    <div class="flex gap-4 items-center">
                        <img src="{{ $lastMasuk->foto_url }}" alt="Foto Bukti" class="w-16 h-16 rounded-2xl object-cover shadow-md">
                        <div>
                            <p class="text-sm font-black text-slate-800 leading-tight">{{ $lastMasuk->barang->nama_barang }}</p>
                            <p class="text-xs text-slate-500 mt-1">{{ $lastMasuk->jumlah }} Unit • {{ $lastMasuk->tanggal_masuk }}</p>
                        </div>
                    </div>
                @else
                    <p class="text-xs italic text-slate-300">Belum ada data masuk</p>
                @endif
            </div>

            {{-- Last Outbound --}}
            <div class="bg-white p-5 rounded-[2rem] border border-slate-100 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-[10px] font-black text-rose-500 bg-rose-50 px-3 py-1 rounded-full uppercase">Barang Keluar</span>
                </div>
                @if($lastKeluar)
                    <div class="flex gap-4 items-center">
                        <img src="{{ $lastKeluar->foto_url }}" alt="Foto Bukti" class="w-16 h-16 rounded-2xl object-cover shadow-md">
                        <div>
                            <p class="text-sm font-black text-slate-800 leading-tight">{{ $lastKeluar->barang->nama_barang }}</p>
                            <p class="text-xs text-slate-500 mt-1">{{ $lastKeluar->jumlah }} Unit • {{ $lastKeluar->tanggal_keluar }}</p>
                        </div>
                    </div>
                @else
                    <p class="text-xs italic text-slate-300">Belum ada data keluar</p>
                @endif
            </div>

            {{-- Last Peminjaman --}}
            <div class="bg-white p-5 rounded-[2rem] border border-slate-100 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-[10px] font-black text-indigo-500 bg-indigo-50 px-3 py-1 rounded-full uppercase">Peminjaman Baru</span>
                </div>
                @if($lastPeminjaman)
                    <div class="flex gap-4 items-center">
                        <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center text-indigo-600 font-black text-xl">
                            {{ substr($lastPeminjaman->nama_peminjam, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm font-black text-slate-800 leading-tight">{{ $lastPeminjaman->nama_peminjam }}</p>
                            <p class="text-xs text-slate-500 mt-1">{{ $lastPeminjaman->barang->nama_barang }} • {{ $lastPeminjaman->jumlah }} Unit</p>
                            <p class="text-[10px] {{ $lastPeminjaman->status == 'dipinjam' ? 'text-amber-500' : 'text-emerald-500' }} font-bold uppercase mt-1">
                                {{ $lastPeminjaman->status }}
                            </p>
                        </div>
                    </div>
                @else
                    <p class="text-xs italic text-slate-300">Belum ada aktivitas pinjam</p>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Script Chart.js tetap sama, cuma Lia saranin ganti sedikit stylenya --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('inventoryChart').getContext('2d');
    const gradientMasuk = ctx.createLinearGradient(0, 0, 0, 400);
    gradientMasuk.addColorStop(0, 'rgba(16, 185, 129, 0.4)');
    gradientMasuk.addColorStop(1, 'rgba(16, 185, 129, 0)');

    const gradientKeluar = ctx.createLinearGradient(0, 0, 0, 400);
    gradientKeluar.addColorStop(0, 'rgba(244, 63, 94, 0.4)');
    gradientKeluar.addColorStop(1, 'rgba(244, 63, 94, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [
                {
                    label: 'Masuk',
                    data: @json($dataMasuk),
                    borderColor: '#10b981',
                    backgroundColor: gradientMasuk,
                    fill: true,
                    tension: 0.4,
                    borderWidth: 4,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#10b981',
                    pointBorderWidth: 2,
                    pointRadius: 5
                },
                {
                    label: 'Keluar',
                    data: @json($dataKeluar),
                    borderColor: '#f43f5e',
                    backgroundColor: gradientKeluar,
                    fill: true,
                    tension: 0.4,
                    borderWidth: 4,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#f43f5e',
                    pointBorderWidth: 2,
                    pointRadius: 5
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    align: 'end',
                    labels: { boxWidth: 8, usePointStyle: true, font: { size: 12, weight: 'bold' } }
                }
            },
            scales: {
                y: { grid: { borderDash: [5, 5] }, ticks: { font: { weight: 'bold' } } },
                x: { grid: { display: false }, ticks: { font: { weight: 'bold' } } }
            }
        }
    });
</script>
@endsection