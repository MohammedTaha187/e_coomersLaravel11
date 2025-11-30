<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gallery>
 */
class GalleryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => \App\Models\Product::inRandomOrder()->first()->id ?? \App\Models\Product::factory(),
            'image' => 'public/images/galleries/' . $this->faker->numberBetween(1, 6) . '.jpg',
        ];
    }
}
