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
        $this->command->info('🌱 Iniciando población de la base de datos...');

        // 2. Poblar UEBs (deben existir primero)
        $this->call(UEBSeeder::class);

        // 3. Poblar Especies
        $this->call(EspecieSeeder::class);

        // 4. Poblar Embalses (dependen de UEBs)
        $this->call(EmbalseSeeder::class);

        // 5. Crear relaciones Embalse-Especie (tabla pivote 'cultivan')
        $this->call(CultivanSeeder::class);

        $this->command->info('🎉 ¡Base de datos poblada exitosamente!');
    }
}
