<?php

namespace Database\Factories;

use App\Models\TipoRede;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TipoRede>
 */
class TipoRedeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nome' => fake()->company(),
            'logo' => fake()->image(),
        ];
    }
}
