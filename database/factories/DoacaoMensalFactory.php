<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DoacaoMensal>
 */
class DoacaoMensalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_usuario' => fake()->numberBetween(1,20),
            'valor' => fake()->numberBetween(1, 100),
            'dia' => fake()->numberBetween(1, 28),
            'ativa' => true,
        ];
    }
}
