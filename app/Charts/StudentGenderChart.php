<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class StudentGenderChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        return $this->chart->pieChart()
            ->addData([44.2, 55.8])
            ->setTitle('student gender makeup')
            ->setLabels(['male', 'non male'])
            ->setHeight(200)
            ->setColors(['#8b0000', '#EAB308']);
    }
}
