<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class StudentEthnicityChart
{
    /** @var LarapexChart */
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LarapexChart
    {
        return $this->chart->barChart()
            ->addData('percentage of student body', [.5, .1, 4.0, 12.6, 70.7, 2.5, .5, 2.3])
            ->setTitle('Student  Ethnicity')
            ->setSubtitle('data from the Department  of Education')
            ->setXAxis(['Native American', 'Pacific Islander', 'asian', 'black', 'white', 'hispanic', 'two or more', 'unknown'])
            ->setColors(['#8b0000'])
            ->setHeight(300);
    }
}
