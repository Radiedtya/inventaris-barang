<!DOCTYPE html>
<html>
<head>
    <title>Laporan Stok Barang</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 11px; color: #334155; margin: 20px; }
        
        /* Header Style dengan aksen Navy */
        .header { text-align: center; margin-bottom: 30px; border-bottom: 3px solid #1e1b4b; padding-bottom: 15px; }
        .header h1 { margin: 0; color: #1e1b4b; font-size: 22px; letter-spacing: 2px; }
        .header p { margin: 5px 0; color: #64748b; font-weight: bold; text-transform: uppercase; font-size: 10px; }
        
        /* Info Box dengan soft navy/slate background */
        .info { margin-bottom: 25px; background: #f1f5f9; padding: 15px; border-radius: 12px; border-left: 5px solid #1e1b4b; }
        .info table { width: auto; border: none; }
        .info td { border: none; padding: 2px 8px; color: #334155; }
        
        /* Table Style */
        table { width: 100%; border-collapse: collapse; background: #fff; }
        th { 
            background-color: #1e1b4b; 
            color: white; 
            padding: 12px 10px; 
            text-align: left; 
            text-transform: uppercase; 
            font-size: 9px; 
            letter-spacing: 1px;
        }
        td { 
            border: 1px solid #e2e8f0; 
            padding: 10px; 
            vertical-align: middle; 
        }
        tr:nth-child(even) { background-color: #f8fafc; }
        
        .text-center { text-align: center; }
        .font-bold { font-weight: bold; color: #0f172a; }
        
        /* Badge Stok */
        .stok-badge { 
            padding: 4px 8px; 
            background: #e0e7ff; 
            color: #3730a3; 
            border-radius: 6px; 
            font-weight: bold; 
        }

        /* Footer */
        .footer { margin-top: 40px; text-align: right; font-size: 9px; color: #94a3b8; border-top: 1px solid #e2e8f0; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN STOK BARANG</h1>
        <p>Master Data Inventaris Gudang - SMK RPL</p>
    </div>

    <div class="info">
        <table>
            <tr>
                <td width="100">Tanggal Update</td>
                <td class="font-bold">: {{ date('d F Y') }}</td>
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
                <th width="100">Kode Barang</th>
                <th>Informasi Barang</th>
                <th>Merek / Brand</th>
                <th width="80" class="text-center">Stok Akhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key => $item)
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                <td class="font-bold">BRG-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</td>
                <td>
                    <span class="font-bold" style="font-size: 12px;">{{ $item->nama_barang }}</span>
                </td>
                <td>{{ $item->merek }}</td>
                <td class="text-center">
                    <span class="stok-badge">{{ $item->stok }} Unit</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Laporan ini digenerate secara otomatis pada {{ now()->translatedFormat('d F Y, H:i') }} WIB
    </div>
</body>
</html>