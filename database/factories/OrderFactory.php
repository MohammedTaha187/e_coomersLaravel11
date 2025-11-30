<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
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
            // 'order_number' => $this->faker->unique()->uuid(),
            // 'name' => $this->faker->name(),
            // 'subtotal' => $this->faker->randomFloat(2, 100, 1000),
            // 'tax' => $this->faker->randomFloat(2, 10, 100),
            // 'discount' => $this->faker->randomFloat(2, 0, 50),
            // 'total' => function (array $attributes) {
            //     return $attributes['subtotal'] + $attributes['tax'] - $attributes['discount'];
            // },
            // 'status' => $this->faker->randomElement(['ordered', 'pending', 'processing', 'delivered', 'canceled']),
            // 'payment_mode' => $this->faker->randomElement(['cod', 'online']),
            // 'shipping_firstname' => $this->faker->firstName(),
            // 'shipping_lastname' => $this->faker->lastName(),
            // 'shipping_email' => $this->faker->email(),
            // 'shipping_phone' => $this->faker->phoneNumber(),
            // 'shipping_address' => $this->faker->address(),
            // 'shipping_city' => $this->faker->city(),
            // 'shipping_state' => $this->faker->state(),
            // 'shipping_zipcode' => $this->faker->postcode(),
            // 'ordered_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            // 'delivered_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            // 'cancelled_date' => null,
        ];
    }
}
