<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class ParentalEducationLevelChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        return $this->chart->pieChart()
            ->addData([.3, 8.1,20.6, 71])
            ->setTitle('highest level of parental education')
            ->setLabels(['middle school', 'high school', 'some college','college degree'])
            ->setHeight(200)
            ->setColors(['#000000','#ABB0B8', '#EAB308','#8b0000']);
    }
}
