<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slider>
 */
class SliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'tagline' => $this->faker->sentence(3),
            // 'title' => $this->faker->sentence(4),
            // 'subtitle' => $this->faker->sentence(6),
            // 'image' => 'public/images/sliders/' . $this->faker->numberBetween(1, 3) . '.png',
            // 'link' => $this->faker->url(),
            // 'icon' => null,
        ];
    }
}
