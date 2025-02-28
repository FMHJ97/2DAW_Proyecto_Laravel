<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Relato>
 */
class RelatoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1, 10),
            'titulo' => fake()->sentence(6),
            'resumen' => fake()->paragraph(3),
            'contenido_pdf' => fake()->url(),
            'fecha_publicacion' => fake()->dateTime(),
        ];
    }
}
