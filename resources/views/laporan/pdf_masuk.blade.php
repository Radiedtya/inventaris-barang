<!DOCTYPE html>
<html>
<head>
    <title>Laporan Barang Masuk</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #444; padding-bottom: 10px; }
        .info { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f9f9f9; font-weight: bold; text-transform: uppercase; font-size: 10px; }
        .footer { margin-top: 30px; text-align: right; font-style: italic; font-size: 10px; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0;">LAPORAN BARANG MASUK</h1>
        <p style="margin: 5px 0;">Sistem Informasi Inventaris Barang</p>
    </div>

    <div class="info">
        <table>
            <tr style="border: none;">
                <td style="border: none; padding: 0; width: 100px;">Periode</td>
                <td style="border: none; padding: 0;">: {{ request('tgl_awal') }} s/d {{ request('tgl_akhir') }}</td>
            </tr>
            <tr style="border: none;">
                <td style="border: none; padding: 0;">Dicetak Oleh</td>
                <td style="border: none; padding: 0;">: {{ Auth::user()->name }}</td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th width="30" class="text-center">No</th>
                <th width="80">Tanggal</th>
                <th>Nama Barang</th>
                <th>Merek</th>
                <th width="50" class="text-center">Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $key => $item)
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d/m/Y') }}</td>
                <td><strong>{{ $item->barang->nama_barang }}</strong></td>
                <td>{{ $item->barang->merek }}</td>
                <td class="text-center">{{ $item->jumlah }}</td>
                <td>{{ $item->keterangan ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data pada periode ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ now()->translatedFormat('d F Y H:i') }}
    </div>
</body>
</html>