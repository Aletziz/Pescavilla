<?php

namespace Database\Seeders;

use App\Models\Especie;
use Illuminate\Database\Seeder;

class EspecieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear especies específicas comunes en acuicultura
        $especies = [
            ['nombre' => 'Tilapia'],
            ['nombre' => 'Carpa'],
            ['nombre' => 'Clarias'],
            ['nombre' => 'Trucha'],
            ['nombre' => 'Camarón de río'],
            ['nombre' => 'Tenca'],
            ['nombre' => 'Bagre'],
        ];

        foreach ($especies as $especie) {
            Especie::create($especie);
        }

        // O generar más especies aleatorias:
        // Especie::factory()->count(10)->create();

        $this->command->info('✅ Especies creadas exitosamente.');
    }
}
