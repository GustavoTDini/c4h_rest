<?php

namespace Database\Factories;

use App\Models\DoacaoMensal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DoacaoMensal>
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
            'id_usuario' => fake()->numberBetween(1,50),
            'valor' => fake()->numberBetween(1, 100),
            'dia' => fake()->numberBetween(1, 28),
            'ativa' => true,
        ];
    }
}
