<?php

namespace Database\Factories;

use App\Models\Especie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Especie>
 */
class EspecieFactory extends Factory
{
    protected $model = Especie::class;

    /**
     * Define el modelo por defecto.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $especies_acuaticas = [
            'Tilapia',
            'Carpa',
            'Clarias',
            'Trucha',
            'Camarón',
            'Tenca',
            'Bagre',
            'Gambusia',
            'Pez Gato',
            'Mojarra'
        ];

        return [
            'nombre' => fake()->unique()->randomElement($especies_acuaticas),
        ];
    }
}
