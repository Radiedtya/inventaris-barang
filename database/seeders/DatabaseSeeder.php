<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
        
        // $this->call([
        //     BarangSeeder::class,
        //     BarangMasukSeeder::class,
        //     BarangKeluarSeeder::class,
        // ]);

        // 1. Bikin beberapa barang sebagai data dummy
        $barangs = Barang::factory(100)->create();

        // 2. Untuk setiap barang, kita kasih catatan barang masuk
        foreach ($barangs as $barang) {
            BarangMasuk::create([
                'barang_id' => $barang->id,
                'jumlah' => 100, // Kita kasih stok awal 100
                'tanggal_masuk' => now(),
                'keterangan' => 'Stok awal dari seeder',
            ]);

            // Update stok manual di seeder karena tidak lewat Controller
            $barang->update(['stok' => 100]);

            // 3. Kita bikin catatan barang keluar juga buat ngetes
            BarangKeluar::create([
                'barang_id' => $barang->id,
                'jumlah' => 10, // Keluarin 10
                'tanggal_keluar' => now(),
                'keterangan' => 'Sample barang keluar',
            ]);

            // Update stok manual lagi (100 - 10 = 90)
            $barang->update(['stok' => 90]);
        }
        
    }
}
