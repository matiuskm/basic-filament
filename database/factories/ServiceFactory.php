<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'icon' => "https://picsum.photos/100/100.webp?random=" . $this->faker->numberBetween(1, 100),
            'title' => $this->faker->sentence(2),
            'description' => "This is a wider card with supporting text below as a natural content.",
        ];
    }
}
