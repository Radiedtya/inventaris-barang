<?php

namespace App\Exports;

use App\Models\BarangKeluar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BarangKeluarExport implements FromCollection, WithHeadings, WithMapping
{
    protected $merek;

    public function __construct($merek = null)
    {
        $this->merek = $merek;
    }

    public function collection()
    {
        $query = BarangKeluar::with('barang');
        
        if ($this->merek) {
            $query->whereHas('barang', function($q) {
                $q->where('merek', $this->merek);
            });
        }
        
        return $query->latest()->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Barang',
            'Merek',
            'Jumlah Keluar',
            'Tanggal Keluar',
            'Keterangan',
        ];
    }

    public function map($row): array
    {
        static $no = 1;
        return [
            $no++,
            $row->barang->nama_barang,
            $row->barang->merek, // Ambil merek dari master barang
            $row->jumlah,
            $row->tanggal_keluar,
            $row->keterangan ?? '-',
        ];
    }
}