<?php

namespace Database\Seeders;

use App\Models\UEB;
use Illuminate\Database\Seeder;

class UEBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear UEBs específicas con nombres reales
        $uebs = [
            ['nombre' => 'UEB Granma'],
            ['nombre' => 'UEB Santiago de Cuba'],
            ['nombre' => 'UEB Holguín'],
            ['nombre' => 'UEB Las Tunas'],
            ['nombre' => 'UEB Guantánamo'],
        ];

        foreach ($uebs as $ueb) {
            UEB::create($ueb);
        }

        // O si prefieres generar más UEBs aleatorias:
        // UEB::factory()->count(10)->create();
    }
}
