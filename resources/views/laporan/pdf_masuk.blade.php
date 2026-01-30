<!DOCTYPE html>
<html>
<head>
    <title>Laporan Barang Masuk</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 11px; color: #334155; margin: 20px; }
        
        /* Header Style dengan aksen Emerald */
        .header { text-align: center; margin-bottom: 30px; border-bottom: 3px solid #059669; padding-bottom: 15px; }
        .header h1 { margin: 0; color: #1e293b; font-size: 22px; letter-spacing: 2px; }
        .header p { margin: 5px 0; color: #6b7280; font-weight: bold; text-transform: uppercase; font-size: 10px; }
        
        /* Info Box dengan soft green background */
        .info { margin-bottom: 25px; background: #ecfdf5; padding: 15px; border-radius: 12px; border-left: 5px solid #059669; }
        .info table { width: auto; border: none; }
        .info td { border: none; padding: 2px 8px; color: #064e3b; }
        
        /* Table Style */
        table { width: 100%; border-collapse: collapse; background: #fff; }
        th { 
            background-color: #059669; 
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
        
        .text-center { text-align: center; }
        .font-bold { font-weight: bold; color: #1e293b; }
        
        /* Footer */
        .footer { margin-top: 40px; text-align: right; font-size: 9px; color: #94a3b8; border-top: 1px solid #e5e7eb; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN BARANG MASUK</h1>
        <p>Logistik Inventaris Pro - Sistem Informasi RPL</p>
    </div>

    <div class="info">
        <table>
            <tr>
                <td width="100">Periode Laporan</td>
                <td class="font-bold">: {{ request('tgl_awal') }} s/d {{ request('tgl_akhir') }}</td>
            </tr>
            <tr>
                <td>Dicetak Oleh</td>
                <td class="font-bold">: {{ Auth::user()->name }}</td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th width="30" class="text-center">No</th>
                <th width="90">Tanggal</th>
                <th>Nama Barang</th>
                <th>Merek</th>
                <th width="60" class="text-center">Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $key => $item)
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d/m/Y') }}</td>
                <td><span class="font-bold">{{ $item->barang->nama_barang }}</span></td>
                <td>{{ $item->barang->merek }}</td>
                <td class="text-center font-bold" style="color: #059669;">+ {{ $item->jumlah }}</td>
                <td>{{ $item->keterangan ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center" style="padding: 30px; color: #94a3b8;">
                    Tidak ada transaksi masuk pada periode ini.
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