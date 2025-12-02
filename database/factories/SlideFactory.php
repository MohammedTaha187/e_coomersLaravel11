<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slide>
 */
class SlideFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Slide::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tagline' => $this->faker->sentence(3),
            'title' => $this->faker->sentence(4),
            'subtitle' => $this->faker->sentence(6),
            'link' => $this->faker->url(),
            'image' => 'https://placehold.co/600x400', // Using a placeholder service for now
            'status' => 1,
        ];
    }
}
