<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $mainImages = [
            'public/images/products/product-1.png',
            'public/images/products/product-2.png',
            'public/images/products/product-3.png',
            'public/images/products/product-4.png',
            'public/images/products/product-5.png',
        ];

        return [
            'name' => $this->faker->unique()->words(3, true),
            'slug' => $this->faker->unique()->slug(),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'quantity' => $this->faker->numberBetween(1, 100),
            'image' => str_replace('public/', '', $this->faker->randomElement($mainImages)),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'brand_id' => Brand::inRandomOrder()->first()->id ?? Brand::factory(),
            'featured' => $this->faker->boolean(),
        ];
    }
}
