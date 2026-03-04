<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PeminjamanExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        $query = Peminjaman::with('barang');

        if(request()->filled('merek')) {
            $query->whereHas('barang', function($q) {
                $q->where('merek', request('merek'));
            });
        }

        // Pakai eager loading 'barang' biar nggak lemot
        return $query->latest()->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Peminjam',
            'Nama Barang',
            'Jumlah Unit',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Status',
            'Keterangan',
        ];
    }

    public function map($peminjaman): array
    {
        return [
            $peminjaman->id,
            $peminjaman->nama_peminjam,
            $peminjaman->barang->nama_barang, // Ambil nama dari relasi
            $peminjaman->jumlah,
            $peminjaman->tanggal_pinjam,
            $peminjaman->tanggal_kembali ?? '-', // Kalau null (belum balik) kasih strip
            ucfirst($peminjaman->status), // Biar depannya huruf kapital
            $peminjaman->keterangan ?? '-',
        ];
    }
}