<?php

namespace Database\Factories;

use App\Models\Embalse;
use App\Models\UEB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Embalse>
 */
class EmbalseFactory extends Factory
{
    protected $model = Embalse::class;

    /**
     * Define el modelo por defecto.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $municipios = [
            'Bayamo',
            'Manzanillo',
            'Holguín',
            'Santiago de Cuba',
            'Guantánamo',
            'Las Tunas',
            'Palma Soriano',
            'Contramaestre',
            'Mayarí',
            'Gibara'
        ];

        $tipos_cultivo = ['Extensivo', 'Intensivo'];
        $tipos_embalse = ['Presa', 'Micropresa'];

        return [
            'nombre' => 'Embalse ' . fake()->unique()->word() . ' ' . fake()->numberBetween(1, 100),
            'ueb_id' => UEB::factory(), // Crea una UEB automáticamente si no existe
            'area' => fake()->randomFloat(2, 1000, 500000), // entre 1,000 y 500,000 m²
            'municipio' => fake()->randomElement($municipios),
            'profundidad_media' => fake()->randomFloat(2, 1.5, 15.0), // entre 1.5 y 15 metros
            'cantidad_arroyo' => fake()->numberBetween(0, 5),
            'volumen' => fake()->randomFloat(2, 5000, 2000000), // entre 5,000 y 2,000,000 m³
            'tipo_cultivo' => fake()->randomElement($tipos_cultivo),
            'tipo_embalse' => fake()->randomElement($tipos_embalse),
        ];
    }

    /**
     * Estado para embalses extensivos
     */
    public function extensivo(): static
    {
        return $this->state(fn (array $attributes) => [
            'tipo_cultivo' => 'Extensivo',
        ]);
    }

    /**
     * Estado para embalses intensivos
     */
    public function intensivo(): static
    {
        return $this->state(fn (array $attributes) => [
            'tipo_cultivo' => 'Intensivo',
        ]);
    }

    /**
     * Estado para presas
     */
    public function presa(): static
    {
        return $this->state(fn (array $attributes) => [
            'tipo_embalse' => 'Presa',
            'area' => fake()->randomFloat(2, 50000, 500000), // Presas más grandes
            'volumen' => fake()->randomFloat(2, 100000, 2000000),
        ]);
    }

    /**
     * Estado para micropresas
     */
    public function micropresa(): static
    {
        return $this->state(fn (array $attributes) => [
            'tipo_embalse' => 'Micropresa',
            'area' => fake()->randomFloat(2, 1000, 50000), // Micropresas más pequeñas
            'volumen' => fake()->randomFloat(2, 5000, 100000),
        ]);
    }
}
