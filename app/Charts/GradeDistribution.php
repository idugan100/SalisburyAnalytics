<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Professor;

class GradeDistribution
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(Professor $professor): \ArielMejiaDev\LarapexCharts\BarChart
    {
        //dd($message);
        return $this->chart->barChart()
            ->setTitle('Grade Distribution')
            ->addData('Professor Total', [$professor->qty_W, $professor->qty_F, $professor->qty_D, $professor->qty_C, $professor->qty_B, $professor->qty_A])
            ->setXAxis(['W', 'F', 'D', 'C', 'B', 'A'])
            ->setHeight (300);
    }
}
