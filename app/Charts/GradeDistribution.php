<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class GradeDistribution
{
    /** @var LarapexChart */
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    /**
     * @param  array<mixed>  $distribution
     */
    public function build($distribution): LarapexChart
    {
        $grade_array = ['W', 'F', 'D', 'C', 'B', 'A'];
        $total_array = [];
        foreach ($grade_array as $letter_grade) {
            $found = false;
            foreach ($distribution as $grade_object) {
                if ($grade_object->grade == $letter_grade) {
                    $total_array[] = $grade_object->total;
                    $found = true;
                }
            }
            if (! $found) {
                $total_array[] = 0;
            }
        }

        return $this->chart->barChart()
            ->addData('Total given', $total_array)
            ->setTitle('Grade Distribution')
            ->setXAxis($grade_array)
            ->setHeight(250)
            ->setColors([env('CHART_MAIN')]);
    }
}
