<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class EnrollmentOverTime
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($enrollment_by_semester_points): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $enrollment_array = [];
        $semester_array = [];
        foreach ($enrollment_by_semester_points as $point) {
            $enrollment_array[] = $point->Enrollment;
            $semester_array[] = $point->semester.' '.$point->year;
        }

        return $this->chart->lineChart()
            ->setTitle(' Enrollment Over Time at SU')
            ->addData('Course Seats', $enrollment_array)
            ->setXAxis($semester_array)
            ->setHeight(350)
            ->setColors(['#8b0000']);
    }
}
