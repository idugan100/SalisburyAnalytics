<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class GpaOverTime
{
    /** @var LarapexChart */
    protected $chart;

    /** @var float[] */
    protected $university_average_gpa = [2.95, 3.00, 2.99, 3.00, 2.97, 2.98, 3.00, 2.97, 2.98, 2.97, 3.01, 3.03, 3.02, 2.97, 3.01, 2.98, 3.00, 2.98, 3.03, 3.01, 3.34, 3.04, 3.06, 2.99, 3.01, 3.01, 3.01, 2.99];

    /** @var string[] */
    protected $all_semesters = ['Spring  2010', 'Fall 2010', 'Spring  2011', 'Fall 2011', 'Spring  2012', 'Fall 2012', 'Spring  2013', 'Fall 2013', 'Spring  2014', 'Fall 2014', 'Spring 2015', 'Fall 2015', 'Spring 2016', 'Fall 2016', 'Spring 2017', 'Fall 2017', 'Spring 2018', 'Fall 2018', 'Spring 2019',
        'Fall 2019', 'Spring 2020', 'Fall 2020', 'Spring 2021', 'Fall 2021', 'Spring 2022', 'Fall 2022', 'Spring 2023', 'Fall 2023'];

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
            ->setTitle(' Average GPA Over Time at SU')
            ->setXAxis($this->all_semesters)
            ->setHeight(350)
            ->setColors(['#8b0000', '#EAB308']);
    }
}
