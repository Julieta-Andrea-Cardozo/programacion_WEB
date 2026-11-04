<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => fake()->unique()->words(2, true),
            'categoria' => fake()->randomElement(['grano', 'insumo']),
            'meta' => 'América · Lavado · 250 g',
            'notas' => 'Caramelo · Cacao',
            'precio' => fake()->numberBetween(1000, 40000),
            'estrellas' => fake()->numberBetween(1, 5),
            'imagen' => '',
        ];
    }
}
