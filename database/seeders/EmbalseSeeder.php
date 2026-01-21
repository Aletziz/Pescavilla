<?php

namespace Database\Seeders;

use App\Models\Embalse;
use App\Models\UEB;
use Illuminate\Database\Seeder;

class EmbalseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asegúrate de que existan UEBs primero
        $uebs = UEB::all();

        if ($uebs->isEmpty()) {
            $this->command->error('⚠️  No hay UEBs en la base de datos. Ejecuta primero UEBSeeder.');
            return;
        }

        // Crear embalses variados para cada UEB
        foreach ($uebs as $ueb) {
            // 2 presas extensivas
            Embalse::factory()
                ->count(2)
                ->presa()
                ->extensivo()
                ->create(['ueb_id' => $ueb->id]);

            // 1 presa intensiva
            Embalse::factory()
                ->count(1)
                ->presa()
                ->intensivo()
                ->create(['ueb_id' => $ueb->id]);

            // 3 micropresas extensivas
            Embalse::factory()
                ->count(3)
                ->micropresa()
                ->extensivo()
                ->create(['ueb_id' => $ueb->id]);

            // 2 micropresas intensivas
            Embalse::factory()
                ->count(2)
                ->micropresa()
                ->intensivo()
                ->create(['ueb_id' => $ueb->id]);
        }

        $this->command->info('✅ Embalses creados exitosamente.');
    }
}
