<?php

namespace Database\Factories;

use App\Models\UEB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UEB>
 */
class UEBFactory extends Factory
{
    protected $model = UEB::class;

    /**
     * Define el modelo por defecto.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nombres_ueb = [
            'UEB Granma',
            'UEB Santiago',
            'UEB Holguín',
            'UEB Las Tunas',
            'UEB Guantánamo',
            'UEB Bayamo',
            'UEB Manzanillo',
            'UEB Palma Soriano',
            'UEB Contramaestre',
            'UEB Mayarí'
        ];

        return [
            'nombre' => fake()->unique()->randomElement($nombres_ueb),
        ];
    }
}
