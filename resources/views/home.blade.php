@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 pb-12 select-none">

    {{-- Minimalist Floating Toast Notification --}}
    @if(session('success'))
        <div x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 4000)"
             x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-2 sm:translate-y-0 sm:translate-x-2"
             x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed bottom-5 right-5 z-50 max-w-sm w-full bg-white border border-slate-200/80 rounded-xl shadow-md p-4 flex items-start gap-3">
            
            <div class="p-1 bg-emerald-50 text-emerald-600 rounded-md shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <div class="flex-1 min-w-0">
                <p class="text-xs font-semibold text-slate-900">Aksi Berhasil</p>
                <p class="text-[11px] text-slate-500 mt-0.5 leading-relaxed">{{ session('success') }}</p>
            </div>

            <button @click="show = false" class="text-slate-400 hover:text-slate-600 transition-colors shrink-0">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    @endif

    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Selamat Datang, {{ Auth::user()->name }}</h1>
            <p class="text-xs font-medium text-slate-400 mt-1">Ringkasan aktivitas dan pergerakan logistik gudang hari ini.</p>
        </div>
        
        {{-- Date Display (Clean Structure) --}}
        <div class="inline-flex items-center gap-2.5 bg-white border border-slate-100 px-3.5 py-2 rounded-lg self-start sm:self-auto shadow-[0_1px_2px_rgba(0,0,0,0.01)]">
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span class="text-xs font-semibold text-slate-700 tracking-tight">
                {{ now()->translatedFormat('l, d M Y') }}
            </span>
        </div>
    </div>

    {{-- Stats Grid System --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
        
        {{-- Card: Total Barang --}}
        <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-[0_1px_2px_rgba(0,0,0,0.01)] flex flex-col justify-between min-h-[120px]">
            <div>
                <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Total Item</p>
                <h3 class="text-2xl font-bold text-slate-900 mt-1 tracking-tight">{{ $totalBarang ?? 0 }}</h3>
            </div>
            <p class="text-[10px] text-slate-400 font-medium">Jenis barang terdaftar</p>
        </div>

        {{-- Card: Peminjaman Aktif --}}
        <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-[0_1px_2px_rgba(0,0,0,0.01)] flex flex-col justify-between min-h-[120px]">
            <div>
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Sedang Dipinjam</p>
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mt-1 tracking-tight">{{ $totalDipinjam ?? 0 }}</h3>
            </div>
            <a href="{{ route('peminjaman.index') }}" class="text-[10px] font-semibold text-slate-600 hover:text-slate-900 inline-flex items-center gap-1 transition-colors">
                Pantau Sirkulasi →
            </a>
        </div>

        {{-- Card: Inbound --}}
        <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-[0_1px_2px_rgba(0,0,0,0.01)] flex flex-col justify-between min-h-[120px]">
            <div>
                <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Barang Masuk</p>
                <h3 class="text-2xl font-bold text-slate-900 mt-1 tracking-tight">{{ $totalMasuk ?? 0 }}</h3>
            </div>
            <a href="{{ route('barang-masuk.index') }}" class="text-[10px] font-semibold text-emerald-600 hover:text-emerald-700 inline-flex items-center gap-1 transition-colors">
                Log Inbound →
            </a>
        </div>

        {{-- Card: Outbound --}}
        <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-[0_1px_2px_rgba(0,0,0,0.01)] flex flex-col justify-between min-h-[120px]">
            <div>
                <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Barang Keluar</p>
                <h3 class="text-2xl font-bold text-slate-900 mt-1 tracking-tight">{{ $totalKeluar ?? 0 }}</h3>
            </div>
            <a href="{{ route('barang-keluar.index') }}" class="text-[10px] font-semibold text-rose-600 hover:text-rose-700 inline-flex items-center gap-1 transition-colors">
                Log Outbound →
            </a>
        </div>

        {{-- Professional Quick Action Panel --}}
        <div class="bg-slate-900 p-5 rounded-xl flex flex-col justify-between min-h-[120px] sm:col-span-2 lg:col-span-1">
            <p class="text-slate-400 text-[10px] font-semibold uppercase tracking-wider">Aksi Singkat</p>
            <div class="grid grid-cols-4 gap-2 mt-2">
                <a href="{{ route('barang.create') }}" class="h-8 bg-white/10 hover:bg-white text-white hover:text-slate-900 rounded-md flex items-center justify-center transition-colors" title="Barang Baru">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M12 4v16m8-8H4" stroke-linecap="round"/></svg>
                </a>
                <a href="{{ route('barang-masuk.create') }}" class="h-8 bg-white/10 hover:bg-emerald-500 hover:text-white text-slate-300 rounded-md flex items-center justify-center transition-colors" title="Input Masuk">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M7 11l5-5m0 0l5 5m-5-5v12" stroke-linecap="round"/></svg>
                </a>
                <a href="{{ route('barang-keluar.create') }}" class="h-8 bg-white/10 hover:bg-rose-500 hover:text-white text-slate-300 rounded-md flex items-center justify-center transition-colors" title="Input Keluar">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M17 13l-5 5m0 0l-5-5m5 5V6" stroke-linecap="round"/></svg>
                </a>
                <a href="{{ route('peminjaman.create') }}" class="h-8 bg-white/10 hover:bg-indigo-500 hover:text-white text-slate-300 rounded-md flex items-center justify-center transition-colors" title="Catat Peminjaman">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round"/></svg>
                </a>
            </div>
        </div>
    </div>

    {{-- Analytics & Realtime Feeds Container --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- Chart Section (Left) --}}
        <div class="lg:col-span-2 bg-white p-6 rounded-xl border border-slate-100 shadow-[0_1px_2px_rgba(0,0,0,0.01)]">
            <div class="mb-6">
                <h2 class="text-sm font-semibold text-slate-900 tracking-tight">Metrik Arus Logistik</h2>
                <p class="text-[11px] text-slate-400 font-medium mt-0.5">Analisis tren frekuensi barang 7 hari terakhir</p>
            </div>
            <div class="h-72">
                <canvas id="inventoryChart"></canvas>
            </div>
        </div>

        {{-- Feed Aktivitas Terkini (Right) --}}
        <div class="flex flex-col gap-4">
            <h2 class="text-sm font-semibold text-slate-900 tracking-tight px-1">Log Perubahan Terakhir</h2>
            
            {{-- Last Inbound --}}
            <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-[0_1px_2px_rgba(0,0,0,0.01)] flex items-center justify-between gap-4">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-11 h-11 rounded-lg border border-slate-100 overflow-hidden bg-slate-50 shrink-0">
                        @if($lastMasuk && $lastMasuk->foto_url)
                            <img src="{{ $lastMasuk->foto_url }}" alt="Bukti" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-semibold text-slate-900 truncate">
                            {{ $lastMasuk ? $lastMasuk->barang->nama_barang : 'Belum ada data' }}
                        </p>
                        <p class="text-[11px] text-slate-400 truncate mt-0.5">
                            {{ $lastMasuk ? $lastMasuk->jumlah . ' Unit • ' . $lastMasuk->tanggal_masuk : 'Tidak tersedia' }}
                        </p>
                    </div>
                </div>
                <span class="text-[9px] font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-100 shrink-0 uppercase tracking-wider">In</span>
            </div>

            {{-- Last Outbound --}}
            <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-[0_1px_2px_rgba(0,0,0,0.01)] flex items-center justify-between gap-4">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-11 h-11 rounded-lg border border-slate-100 overflow-hidden bg-slate-50 shrink-0">
                        @if($lastKeluar && $lastKeluar->foto_url)
                            <img src="{{ $lastKeluar->foto_url }}" alt="Bukti" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-semibold text-slate-900 truncate">
                            {{ $lastKeluar ? $lastKeluar->barang->nama_barang : 'Belum ada data' }}
                        </p>
                        <p class="text-[11px] text-slate-400 truncate mt-0.5">
                            {{ $lastKeluar ? $lastKeluar->jumlah . ' Unit • ' . $lastKeluar->tanggal_keluar : 'Tidak tersedia' }}
                        </p>
                    </div>
                </div>
                <span class="text-[9px] font-semibold text-rose-600 bg-rose-50 px-2 py-0.5 rounded border border-rose-100 shrink-0 uppercase tracking-wider">Out</span>
            </div>

            {{-- Last Peminjaman --}}
            <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-[0_1px_2px_rgba(0,0,0,0.01)] flex items-center justify-between gap-4">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-11 h-11 rounded-lg bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-600 font-semibold text-xs shrink-0 uppercase">
                        {{ $lastPeminjaman ? substr($lastPeminjaman->nama_peminjam, 0, 2) : '?' }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-semibold text-slate-900 truncate">
                            {{ $lastPeminjaman ? $lastPeminjaman->nama_peminjam : 'Belum ada data' }}
                        </p>
                        <p class="text-[11px] text-slate-400 truncate mt-0.5">
                            {{ $lastPeminjaman ? $lastPeminjaman->barang->nama_barang . ' • ' . $lastPeminjaman->jumlah . ' Unit' : 'Tidak tersedia' }}
                        </p>
                    </div>
                </div>
                @if($lastPeminjaman)
                    <span class="text-[9px] font-semibold {{ $lastPeminjaman->status == 'dipinjam' ? 'text-amber-600 bg-amber-50 border-amber-100' : 'text-slate-600 bg-slate-50 border-slate-100' }} px-2 py-0.5 rounded border shrink-0 uppercase tracking-wider">
                        {{ $lastPeminjaman->status }}
                    </span>
                @else
                    <span class="text-[9px] font-semibold text-slate-400 bg-slate-50 px-2 py-0.5 rounded border border-slate-100 shrink-0 uppercase">Empty</span>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Professional Chart.js Engine Configuration --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('inventoryChart').getContext('2d');
    
    // Smooth translucent gradients for high-end look
    const gradientMasuk = ctx.createLinearGradient(0, 0, 0, 300);
    gradientMasuk.addColorStop(0, 'rgba(15, 23, 42, 0.05)');
    gradientMasuk.addColorStop(1, 'rgba(15, 23, 42, 0)');

    const gradientKeluar = ctx.createLinearGradient(0, 0, 0, 300);
    gradientKeluar.addColorStop(0, 'rgba(100, 116, 139, 0.05)');
    gradientKeluar.addColorStop(1, 'rgba(100, 116, 139, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [
                {
                    label: 'Inbound',
                    data: @json($dataMasuk),
                    borderColor: '#0f172a', // Sleek slate-900 line
                    backgroundColor: gradientMasuk,
                    fill: true,
                    tension: 0.35,
                    borderWidth: 2,
                    pointBackgroundColor: '#0f172a',
                    pointHoverRadius: 6,
                    pointRadius: 0 // Hides standard nodes for a modern clean look, reveals on hover
                },
                {
                    label: 'Outbound',
                    data: @json($dataKeluar),
                    borderColor: '#94a3b8', // Sophisticated slate-400 line
                    backgroundColor: gradientKeluar,
                    fill: true,
                    tension: 0.35,
                    borderWidth: 2,
                    pointBackgroundColor: '#94a3b8',
                    pointHoverRadius: 6,
                    pointRadius: 0
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
                    labels: {
                        boxWidth: 6,
                        boxHeight: 6,
                        usePointStyle: true,
                        font: { size: 11, fontColor: '#64748b', weight: '500' }
                    }
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    padding: 10,
                    backgroundColor: '#0f172a',
                    titleFont: { size: 11, weight: '600' },
                    bodyFont: { size: 11 },
                    cornerRadius: 6
                }
            },
            scales: {
                y: {
                    grid: { color: '#f1f5f9', drawBorder: false },
                    ticks: { color: '#94a3b8', font: { size: 10 } }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#94a3b8', font: { size: 10 } }
                }
            }
        }
    });
</script>
@endsection