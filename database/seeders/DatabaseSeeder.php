<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => bcrypt('password')]
        );

        \App\Models\Obat::truncate();
        \App\Models\Staff::truncate();
        \App\Models\Supplier::truncate();

        \App\Models\Obat::factory(6)->create();
        \App\Models\Staff::factory(6)->create();
        \App\Models\Supplier::factory(6)->create();
    }
}
