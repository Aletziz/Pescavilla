<?php

namespace Database\Seeders;

use App\Models\Embalse;
use App\Models\Especie;
use Illuminate\Database\Seeder;

class CultivanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $embalses = Embalse::all();
        $especies = Especie::all();

        if ($embalses->isEmpty() || $especies->isEmpty()) {
            $this->command->error('⚠️  No hay embalses o especies. Ejecuta primero EmbalseSeeder y EspecieSeeder.');
            return;
        }

        // Para cada embalse, asignar entre 1 y 4 especies aleatorias
        foreach ($embalses as $embalse) {
            $cantidadEspecies = rand(1, 4);
            $especiesAleatorias = $especies->random($cantidadEspecies);

            foreach ($especiesAleatorias as $especie) {
                // Attach con fecha_inicio aleatoria en los últimos 2 años
                $embalse->especies()->attach($especie->id, [
                    'fecha_inicio' => now()->subDays(rand(0, 730))->format('Y-m-d'),
                ]);
            }
        }

        $this->command->info('✅ Relaciones Embalse-Especie (cultivan) creadas exitosamente.');
    }
}
