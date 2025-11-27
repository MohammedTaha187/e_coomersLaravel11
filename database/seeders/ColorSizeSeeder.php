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

        foreach ($colors as $color) {
            \App\Models\Color::create($color);
        }

        $sizes = [
            ['name' => 'XS'],
            ['name' => 'S'],
            ['name' => 'M'],
            ['name' => 'L'],
            ['name' => 'XL'],
            ['name' => 'XXL'],
        ];

        foreach ($sizes as $size) {
            Size::create($size);
        }

        $products = Product::all();
        $allColors = Color::all();
        $allSizes = Size::all();

        foreach ($products as $product) {
            $product->colors()->attach($allColors->random(rand(1, 3))->pluck('id')->toArray());
            $product->sizes()->attach($allSizes->random(rand(1, 4))->pluck('id')->toArray());
        }
    }
}
