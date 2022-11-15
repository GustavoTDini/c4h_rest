<?php

namespace Database\Factories;

use App\Models\Doacao;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Doacao>
 */
class DoacaoFactory extends Factory
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
        ];
    }
}
