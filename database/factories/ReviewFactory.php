<?php

namespace Database\Factories;

use App\Http\Controllers\ReviewController;
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
            "response"=>fake()->sentence(),
            "approved_flag"=>ReviewController::PROCESSING_FLAG
        ];
    }
}
