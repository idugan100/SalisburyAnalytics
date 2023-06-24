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

    public function build( $entity): \ArielMejiaDev\LarapexCharts\BarChart
    {
        //dd($message);
        return $this->chart->barChart()
            ->setTitle('Grade Distribution')
            ->addData('Total given', [$entity->qty_W, $entity->qty_F, $entity->qty_D, $entity->qty_C, $entity->qty_B, $entity->qty_A])
            ->setXAxis(['W', 'F', 'D', 'C', 'B', 'A'])
            ->setHeight (300);
    }
}
