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
            'courseNumber'=>320,
            'creditsLab'=>2,
            'creditsLecture'=>3,
            'creditsTotal'=>4,
            'description'=>'Continuation of the study of the design, implementation and testing of programs. 
                            Further study of object-oriented programming. Introduction of graph algorithms. 
                            Emphasis is on analysis of algorithms and abstraction.',
            'departmentCode'=>'COSC',
            'syllabusLink'=>'https://www.salisbury.edu/academic-offices/science-and-technology/computer-science/_files/syllabi/2021/COSC-320.pdf?v=20221209215034',
            'creditsTotal'=>4
            
        ];
    }
}
