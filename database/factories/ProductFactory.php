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
            'public/images/products/1.jpg',
            'public/images/products/2.jpg',
            'public/images/products/3.jpg',
            'public/images/products/4.jpg',
            'public/images/products/5.jpg',
            'public/images/products/6.jpg',
        ];

        return [
            'name' => $this->faker->unique()->words(3, true),
            'slug' => $this->faker->unique()->slug(),
            'description' => $this->faker->paragraph(),
            'short_description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'sale_price' => $this->faker->optional()->randomFloat(2, 10, 1000),
            'sku' => $this->faker->unique()->ean8(),
            'quantity' => $this->faker->numberBetween(1, 100),
            'stock' => $this->faker->randomElement(['in_stock', 'out_of_stock']),
            'image' => str_replace('public/', '', $this->faker->randomElement($mainImages)),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'brand_id' => Brand::inRandomOrder()->first()->id ?? Brand::factory(),
            'featured' => $this->faker->boolean(),
        ];
    }
}
