<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddresseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'user_id' => \App\Models\User::inRandomOrder()->first()->id ?? \App\Models\User::factory(),
            // 'firstname' => $this->faker->firstName(),
            // 'lastname' => $this->faker->lastName(),
            // 'phone' => $this->faker->phoneNumber(),
            // 'email' => $this->faker->email(),
            // 'address' => $this->faker->address(),
            // 'city' => $this->faker->city(),
            // 'state' => $this->faker->state(),
            // 'zipcode' => $this->faker->postcode(),
        ];
    }
}
