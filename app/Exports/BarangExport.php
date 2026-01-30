<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BarangExport implements FromCollection, WithHeadings, WithMapping
{
    protected $merek;

    public function __construct($merek = null)
    {
        $this->merek = $merek;
    }

    public function collection()
    {
        $query = Barang::query();
        if ($this->merek) {
            $query->where('merek', $this->merek);
        }
        return $query->latest()->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Barang',
            'Merek',
            'Stok Saat Ini',
        ];
    }

    public function map($row): array
    {
        static $no = 1;
        return [
            $no++,
            $row->nama_barang,
            $row->merek, // Langsung panggil karena sudah ada di tabel ini
            $row->stok,
        ];
    }
}