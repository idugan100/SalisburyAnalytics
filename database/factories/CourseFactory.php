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
            'courseNumber'=>fake()->number_between(100,499),
            'creditsLab'=>fake()->numberBetween(0,1),
            'creditsLecture'=>fake()->numberBetween(2,4),
            'creditsTotal'=>4,
            'description'=>fake()->sentences(),
            'departmentCode'=>'COSC',
            'syllabusLink'=>'https://www.salisbury.edu/academic-offices/science-and-technology/computer-science/_files/syllabi/2021/COSC-320.pdf?v=20221209215034',

            
        ];
    }
}
