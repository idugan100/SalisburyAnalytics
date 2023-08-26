<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'courseNumber'=>fake()->numberBetween(100,499),
            'courseTitle'=>fake()->sentence(),
            'creditsLab'=>fake()->numberBetween(0,1),
            'creditsLecture'=>fake()->numberBetween(2,4),
            'creditsTotal'=>4,
            'description'=>fake()->sentence(),
            'departmentCode'=>'COSC',
            'syllabusLink'=>'https://www.salisbury.edu/academic-offices/science-and-technology/computer-science/_files/syllabi/2021/COSC-320.pdf?v=20221209215034',
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
