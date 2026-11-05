<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Llamamos al seeder que acabamos de crear
        $this->call([
            DatosPorDefectoSeeder::class,
        ]);
    }
}