<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class GpaOverTime
{
    /** @var LarapexChart */
    protected $chart;

    /** @var float[] */
    protected $university_average_gpa = [3.27848, 3.21660, 3.09569, 3.11278, 3.17038, 3.17141, 3.18016, 3.20590, 3.23392, 3.25362, 3.27617, 3.29273, 3.26729];

    /** @var string[] */
    protected $all_semesters = ['Spring 2020', 'Summer 2020', 'Fall 2020', 'Spring 2021', 'Summer 2021', 'Fall 2021', 'Spring 2022', 'Summer 2022', 'Fall 2022', 'Spring 2023', 'Summer 2023', 'Fall 2023', 'Spring 2024'];

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    /** @param  array<mixed>  $gpa_by_semester_points */
    public function build($gpa_by_semester_points, ?string $department = 'All'): LarapexChart
    {
        $gpa_array = [];

        // make array of deparment gpa points  or null if it was not taught that semester
        foreach ($this->all_semesters as $semester) {
            foreach ($gpa_by_semester_points as $point) {
                if ($semester == ($point->semester.' '.$point->year)) {
                    $gpa_array[] = $point->GPA;

                    continue 2;
                }
            }
            $gpa_array[] = null;
        }

        return $this->chart->lineChart()
            ->addData(($department).' Courses', $gpa_array)
            ->addData('All Courses', $this->university_average_gpa)
            ->setTitle('Average GPA Over Time')
            ->setXAxis($this->all_semesters)
            ->setHeight(350)
            ->setColors([env('CHART_MAIN'), env('CHART_ACCENT')]);
    }
}
