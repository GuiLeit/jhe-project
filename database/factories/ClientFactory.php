<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'email' => $this->faker->unique()->safeEmail(),
            'cnpj' => $this->faker->unique()->numerify('##############'),
            'observation' => $this->faker->optional()->paragraphs(2, true),
            'contract_value' => $this->faker->randomFloat(2, 1000, 100000),
        ];
    }
}
