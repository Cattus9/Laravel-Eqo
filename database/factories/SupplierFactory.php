<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $prefix = $this->faker->randomElement(['PT.', 'CV.', 'UD.']);
        return [
            'nama_supplier' => $prefix . ' ' . $this->faker->company(),
            'alamat' => $this->faker->address(),
            'no_telp' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'keterangan' => 'Pemasok alat kesehatan dan obat.',
        ];
    }
}
