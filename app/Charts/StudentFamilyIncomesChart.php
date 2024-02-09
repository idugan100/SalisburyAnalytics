<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class StudentFamilyIncomesChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
            ->addData('percentage of student body', [25.2, 11.3, 15.2, 15.7, 32.6])
            ->setTitle('Income Distribution of Student Families')
            ->setXAxis(['$0 - $30000', '$30001 - $48000', '$48001 - $75000', '$75001 - $110000', '$110001+'])
            ->setColors(['#8b0000'])
            ->setHeight(250);
    }
}
