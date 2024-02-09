<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class GradToUGradChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        return $this->chart->pieChart()
            ->addData([1119, 7640 ])
            ->setTitle('Enrollment Type')
            ->setSubtitle('12 month rolling enrollment')
            ->setLabels(['Graduate', 'Undergraduate'])->setHeight(200)
            ->setColors(['#8b0000', '#EAB308']);;
    }
}
