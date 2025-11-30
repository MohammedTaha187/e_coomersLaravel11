<?php

namespace Database\Seeders;

use \App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        $colors = [
            ['name' => 'Red', 'code' => '#FF0000'],
            ['name' => 'Blue', 'code' => '#0000FF'],
            ['name' => 'Green', 'code' => '#008000'],
            ['name' => 'Black', 'code' => '#000000'],
            ['name' => 'White', 'code' => '#FFFFFF'],
            ['name' => 'Yellow', 'code' => '#FFFF00'],
            ['name' => 'Pink', 'code' => '#FFC0CB'],
            ['name' => 'Purple', 'code' => '#800080'],
        ];

        $sizes = [
            ['name' => 'XS'],
            ['name' => 'S'],
            ['name' => 'M'],
            ['name' => 'L'],
            ['name' => 'XL'],
            ['name' => 'XXL'],
        ];

        foreach ($products as $product) {
            $randomColors = collect($colors)->random(rand(1, 3));
            foreach ($randomColors as $color) {
                $product->colors()->create($color);
            }

            $randomSizes = collect($sizes)->random(rand(1, 4));
            foreach ($randomSizes as $size) {
                $product->sizes()->create($size);
            }
        }
    }
}
