<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $teste = random_int(0,10);
            if($teste > 6){
                return [
                    'login' => fake()->lastName(),
                    'email' => fake()->unique()->safeEmail(),
                    'senha' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                    'nome' => fake()->name(),
                    'cpf' => fake()->numerify("############"),
                ];
            } else{
                return [
                    'login' => fake()->lastName(),
                    'email' => fake()->unique()->safeEmail(),
                    'senha' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                    'razao_social' => fake()->company(),
                    'cnpj' => fake()->numerify("##############"),

                ];
            }


    }
}
