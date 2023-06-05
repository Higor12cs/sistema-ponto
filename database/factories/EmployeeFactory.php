<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'registration' => fake()->unique()->regexify('[A-Z]{5}[0-9]{3}'),
            'name' => fake()->firstName(),
            'active' => fake()->boolean(75),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
