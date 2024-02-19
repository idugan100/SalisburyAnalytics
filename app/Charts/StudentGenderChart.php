<?php

namespace App\Charts;

use App\Models\StudentDemographicInfo;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class StudentGenderChart
{
    protected $chart;

    protected $data;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
        $this->data = StudentDemographicInfo::latest()->first();
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        return $this->chart->pieChart()
            ->addData([$this->data->male_pct, $this->data->non_male_pct])
            ->setTitle('student gender makeup')
            ->setLabels(['male', 'non male'])
            ->setHeight(200)
            ->setColors(['#8b0000', '#EAB308']);
    }
}
