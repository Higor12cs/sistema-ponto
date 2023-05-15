<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Funcionario>
 */
class FuncionarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'matricula' => fake()->unique()->regexify('[A-Z]{5}[0-9]{3}'),
            'nome' => fake()->firstName(),
            'ativo' => fake()->boolean(75),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
