<?php

namespace Database\Factories;

use App\Models\Endereco;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Endereco>
 */
class EnderecoFactory extends Factory
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
            'tipo' => fake()->mimeType(),
            'logradouro' => fake()->languageCode(),
            'numero' => fake()->randomNumber(2),
            'cep' => fake()->numerify("########"),
            'complemento' => fake()->streetSuffix(),
            'bairro' => fake()->colorName(),
            'cidade' => fake()->city(),
            'estado' => fake()->country(),
            'pais' => fake()->country()
        ];
    }
}
