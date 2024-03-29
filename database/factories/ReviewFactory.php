<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'response' => fake()->sentence(),
            'professor_id' => fake()->randomDigitNotNull(),
            'course_id' => fake()->randomDigitNotNull(),
        ];
    }
}
