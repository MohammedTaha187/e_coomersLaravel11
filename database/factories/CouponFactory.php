<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => strtoupper($this->faker->unique()->bothify('??###')),
            'type' => $this->faker->randomElement(['fixed', 'percent']),
            'value' => $this->faker->randomFloat(2, 5, 50),
            'cart_value' => $this->faker->randomFloat(2, 50, 100),
            'expiry_date' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }
}
