<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentDemographicInfo>
 */
class StudentDemographicInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'native_american_pct' => fake()->randomFloat(1, 0, 100),
            'pacific_islander_pct' => fake()->randomFloat(1, 0, 100),
            'asian_pct' => fake()->randomFloat(1, 0, 100),
            'black_pct' => fake()->randomFloat(1, 0, 100),
            'white_pct' => fake()->randomFloat(1, 0, 100),
            'hispanic_pct' => fake()->randomFloat(1, 0, 100),
            'two_or_more_races_pct' => fake()->randomFloat(1, 0, 100),
            'unknow_race_pct' => fake()->randomFloat(1, 0, 100),
            'male_pct' => fake()->randomFloat(1, 0, 100),
            'non_male_pct' => fake()->randomFloat(1, 0, 100),
            'middle_school_pct' => fake()->randomFloat(1, 0, 100),
            'high_school_pct' => fake()->randomFloat(1, 0, 100),
            'some_college_pct' => fake()->randomFloat(1, 0, 100),
            'college_degree_pct' => fake()->randomFloat(1, 0, 100),
            'undergraduate_count' => fake()->numberBetween(1, 1000),
            'graduate_count' => fake()->numberBetween(1, 1000),
            'pct_0_30000' => fake()->randomFloat(1, 0, 100),
            'pct_30001_48000' => fake()->randomFloat(1, 0, 100),
            'pct_48001_75000' => fake()->randomFloat(1, 0, 100),
            'pct_75001_110000' => fake()->randomFloat(1, 0, 100),
            'pct_110001_greater' => fake()->randomFloat(1, 0, 100),
        ];
    }
}
