<?php

namespace Database\Factories;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BarangMasuk>
 */
class BarangMasukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'barang_id' => Barang::factory(), // Ini otomatis bikin barang baru
            'jumlah' => $this->faker->numberBetween(10, 50),
            'tanggal_masuk' => $this->faker->date(),
            'keterangan' => 'Barang masuk dari supplier ' . $this->faker->name(),
        ];
    }
}
