<?php

namespace Database\Factories;

use App\Models\Telefone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Telefone>
 */
class TelefoneFactory extends Factory
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
            'nome' => fake()->languageCode(),
            'ddd' => fake()->randomNumber(3),
            'numero' => fake()->randomNumber(9),
        ];
    }
}
