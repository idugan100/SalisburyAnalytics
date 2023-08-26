<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Professor>
 */
class ProfessorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'firstName'=>fake()->firstName(),
            "lastName"=>fake()->lastName(),
            "department"=>"COSC",
            "total_enrollment"=>fake()->numberBetween(100,499),
            "avg_gpa"=>3.29,
            "W_rate"=>fake()->numberBetween(10,20),
            "F_rate"=>fake()->numberBetween(10,20),
            "D_rate"=>fake()->numberBetween(10,20),
            "C_rate"=>fake()->numberBetween(10,20),
            "B_rate"=>fake()->numberBetween(10,20),
            "A_rate"=>fake()->numberBetween(10,20),
        ];
    }
}
