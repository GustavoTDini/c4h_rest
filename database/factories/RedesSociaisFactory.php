<?php

namespace Database\Factories;

use App\Models\RedesSociais;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RedesSociais>
 */
class RedesSociaisFactory extends Factory
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
            'id_rede' => fake()->numberBetween(1,10),
            'url' => fake()->url(),
        ];
    }
}
