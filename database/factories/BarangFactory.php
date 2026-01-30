<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $daftarMerek = ['Samsung', 'Apple', 'Sony', 'Asus', 'Logitech', 'Xiaomi'];

        return [
            'nama_barang' => $this->faker->words(2, true), // Contoh: "Keyboard Mechanical"
            'merek' => $this->faker->randomElement($daftarMerek), // Ini kuncinya! Ngambil acak dari daftar di atas
            'stok' => $this->faker->numberBetween(10, 100),
            'foto' => null, // Sesuai permintaan Ryn, dikosongkan saja
        ];
    }
}
