<?php

namespace App\Charts;

use App\Models\StudentDemographicInfo;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class StudentFamilyIncomesChart
{
    protected $chart;
    protected $data;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
        $this->data = StudentDemographicInfo::latest()->first();
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
            ->addData('percentage of student body', 
                [
                    $this->data->pct_0_30000, $this->data->pct_30001_48000, $this->data->pct_48001_75000, 
                    $this->data->pct_75001_110000, $this->data->pct_110001_greater
                ]
            )
            ->setTitle('income distribution of student families')
            ->setXAxis(['$0 - $30000', '$30001 - $48000', '$48001 - $75000', '$75001 - $110000', '$110001+'])
            ->setColors(['#8b0000'])
            ->setHeight(250);
    }
}
