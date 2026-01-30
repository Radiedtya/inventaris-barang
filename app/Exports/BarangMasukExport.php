<?php

namespace App\Exports;

use App\Models\BarangMasuk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BarangMasukExport implements FromCollection, WithHeadings, WithMapping
{
    protected $merek;

    public function __construct($merek = null)
    {
        $this->merek = $merek;
    }

    public function collection()
    {
        $query = BarangMasuk::with('barang');
        
        if ($this->merek) {
            $query->whereHas('barang', function($q) {
                $q->where('merek', $this->merek);
            });
        }
        
        return $query->latest()->get();
    }

    // Mengatur judul kolom di Excel
    public function headings(): array
    {
        return [
            'No',
            'Nama Barang',
            'Merek',
            'Jumlah',
            'Tanggal Masuk',
            'Keterangan',
        ];
    }

    // Memetakan data ke kolom yang tepat
    public function map($row): array
    {
        static $no = 1;
        return [
            $no++,
            $row->barang->nama_barang,
            $row->barang->merek,
            $row->jumlah,
            $row->tanggal_masuk,
            $row->keterangan ?? '-',
        ];
    }
}