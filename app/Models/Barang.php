<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    protected $with = ['barangMasuk', 'barangKeluar'];

    // Relasi
    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class);
    }

    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class);
    }


    // Accessor untuk foto
    public function getFotoUrlAttribute()
    {
        // Kita arahkan ke folder 'produk' supaya beda dengan folder 'transaksi'
        return $this->foto ? asset('storage/' . $this->foto) : asset('images/default-package.png'); // Gambar default kalau barang belum difoto
    }
}
