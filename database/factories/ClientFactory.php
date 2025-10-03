<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Client;
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

    public function withAddress(): static
    {
        return $this->afterCreating(function (Client $client) {
            Address::factory()->create(['client_id' => $client->id]);
        });
    }
}
