<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Obat>
 */
class ObatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $daftarObat = [
            'Paracetamol 500mg',
            'Amoxicillin 500mg',
            'Bodrex',
            'Panadol Extra',
            'Promag Tablet',
            'Diapet',
            'Asam Mefenamat',
            'Sangobion',
            'Degirol',
            'Enervon-C',
            'Antimo',
            'Mylanta Cair',
            'Betadine Solution',
            'KSR',
            'Amlodipine 5mg',
            'Metformin 500mg'
        ];

        $satuan = $this->faker->randomElement(['Botol', 'Tablet', 'Kapsul', 'Sachet', 'Pcs']);
        $harga_beli = $this->faker->numberBetween(2000, 50000);
        $harga_jual = $harga_beli + ($harga_beli * 0.25);

        return [
            'nama_obat' => $this->faker->randomElement($daftarObat),
            'satuan' => $satuan,
            'harga_beli' => $harga_beli,
            'harga_jual' => $harga_jual,
            'stok' => $this->faker->numberBetween(20, 200),
            'keterangan' => 'Obat umum tersedia di apotek.',
        ];
    }
}
