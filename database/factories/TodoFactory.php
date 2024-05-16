<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate title with maximum two words
        $title = rtrim($this->faker->sentence(rand(1, 2)), '.');

        // Generate description with maximum five words
        $description = rtrim($this->faker->sentence(rand(1, 5)), '.');

        return [
            'title' => $title,
            'description' => $description,
        ];

    }
}
