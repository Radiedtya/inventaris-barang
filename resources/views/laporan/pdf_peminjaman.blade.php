<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman Barang</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 11px; color: #334155; margin: 20px; }
        
        /* Header Style */
        .header { text-align: center; margin-bottom: 30px; border-bottom: 3px solid #7c3aed; padding-bottom: 15px; }
        .header h1 { margin: 0; color: #1e293b; font-size: 22px; letter-spacing: 2px; }
        .header p { margin: 5px 0; color: #6b7280; font-weight: bold; text-transform: uppercase; font-size: 10px; }
        
        /* Info Box */
        .info { margin-bottom: 25px; background: #f5f3ff; padding: 15px; border-radius: 12px; border-left: 5px solid #7c3aed; }
        .info table { width: auto; border: none; }
        .info td { border: none; padding: 2px 8px; color: #4b5563; }
        
        /* Table Style */
        table { width: 100%; border-collapse: collapse; background: #fff; }
        th { 
            background-color: #7c3aed; 
            color: white; 
            padding: 12px 10px; 
            text-align: left; 
            text-transform: uppercase; 
            font-size: 9px; 
            letter-spacing: 1px;
        }
        td { 
            border: 1px solid #e5e7eb; 
            padding: 10px; 
            vertical-align: middle; 
        }
        tr:nth-child(even) { background-color: #f9fafb; }
        
        /* Status Badges */
        .badge { padding: 4px 8px; border-radius: 4px; font-weight: bold; font-size: 8px; text-transform: uppercase; }
        .badge-amber { background-color: #fff7ed; color: #9a3412; border: 1px solid #fdba74; }
        .badge-emerald { background-color: #ecfdf5; color: #065f46; border: 1px solid #6ee7b7; }
        
        .text-center { text-align: center; }
        .font-bold { font-weight: bold; color: #1e293b; }
        
        /* Footer */
        .footer { margin-top: 40px; text-align: right; font-size: 9px; color: #94a3b8; border-top: 1px solid #e5e7eb; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN PEMINJAMAN</h1>
        <p>Sistem Manajemen Inventaris - Jurusan RPL</p>
    </div>

    <div class="info">
        <table>
            <tr>
                <td width="100">Periode Laporan</td>
                <td class="font-bold">: {{ request('tgl_awal') }} s/d {{ request('tgl_akhir') }}</td>
            </tr>
            <tr>
                <td>Petugas Cetak</td>
                <td class="font-bold">: {{ Auth::user()->name }}</td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th width="20" class="text-center">No</th>
                <th>Nama Peminjam</th>
                <th>Barang & Merek</th>
                <th width="40" class="text-center">Qty</th>
                <th width="80">Tgl Pinjam</th>
                <th width="80">Tgl Kembali</th>
                <th width="70" class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $key => $p)
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                <td><span class="font-bold">{{ $p->nama_peminjam }}</span></td>
                <td>{{ $p->barang->nama_barang }} <br> <small style="color: #64748b;">{{ $p->barang->merek }}</small></td>
                <td class="text-center font-bold">{{ $p->jumlah }}</td>
                <td>{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d/m/Y') }}</td>
                <td>{{ $p->tanggal_kembali ? \Carbon\Carbon::parse($p->tanggal_kembali)->format('d/m/Y') : '-' }}</td>
                <td class="text-center">
                    @if($p->status == 'dipinjam')
                        <span class="badge badge-amber">DIPINJAM</span>
                    @else
                        <span class="badge badge-emerald">KEMBALI</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center" style="padding: 30px; color: #94a3b8;">
                    Belum ada data peminjaman di periode ini.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ now()->translatedFormat('d F Y, H:i') }} WIB
    </div>
</body>
</html>