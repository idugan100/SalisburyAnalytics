<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class GradeDistribution
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($distribution): \ArielMejiaDev\LarapexCharts\BarChart
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
            ->setTitle('Grade Distribution')
            ->addData('Total given', $total_array)
            ->setXAxis($grade_array)
            ->setHeight(250)
            ->setColors(['#8b0000']);
    }
}
