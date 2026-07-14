<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seeder utama.
     */
    public function run(): void
    {
        $this->call([
            DummyDataSeeder::class,
        ]);
    }
}