<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Portfolio>
 */
class PortfolioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->randomElement(["Online Marketing", "Web Design", "Mobile Apps", "Brand Identity", "Social Content"]),
            'description' => $this->faker->sentence(10),
            'image' => "https://picsum.photos/800/600.webp?random=" . $this->faker->numberBetween(1, 100),
        ];
    }
}
