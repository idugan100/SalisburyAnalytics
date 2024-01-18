<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class EnrollmentOverTime
{
    /** @var LarapexChart */
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }
    /**
     * @param array<mixed> $enrollment_by_semester_points
     */
    public function build( $enrollment_by_semester_points): LarapexChart
    {
        $enrollment_array = [];
        $semester_array = [];
        foreach ($enrollment_by_semester_points as $point) {
            $enrollment_array[] = $point->Enrollment;
            $semester_array[] = $point->semester.' '.$point->year;
        }

        return $this->chart->lineChart()
            ->addData('Course Seats', $enrollment_array)
            ->setTitle(' Enrollment Over Time at SU')
            ->setXAxis($semester_array)
            ->setHeight(350)
            ->setColors(['#8b0000']);
    }
}
