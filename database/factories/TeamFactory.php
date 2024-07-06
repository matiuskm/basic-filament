<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'position' => $this->faker->jobTitle(),
            'image' => 'https://doodleipsum.com/150x150/avatar-2',
            'twitter' => $this->faker->url(),
            'facebook' => $this->faker->url(),
            'linkedin' => $this->faker->url(),
            'instagram' => $this->faker->url(),
        ];
    }
}
