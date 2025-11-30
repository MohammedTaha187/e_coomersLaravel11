<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'order_id' => \App\Models\Order::inRandomOrder()->first()->id ?? \App\Models\Order::factory(),
            // 'product_id' => \App\Models\Product::inRandomOrder()->first()->id ?? \App\Models\Product::factory(),
            // 'quantity' => $this->faker->numberBetween(1, 5),
            // 'price' => $this->faker->randomFloat(2, 10, 500),
            // 'sku' => $this->faker->unique()->ean8(),
            // 'return_status' => $this->faker->randomElement(['no', 'yes', 'requested', 'approved']),
            // 'image' => 'public/images/products/' . $this->faker->numberBetween(1, 10) . '.png',
        ];
    }
}
