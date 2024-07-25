<?php

namespace App\Charts;

use App\Models\StudentDemographicInfo;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class StudentGenderChart
{
    /** @var LarapexChart */
    protected $chart;

    /** @var StudentDemographicInfo */
    protected $data;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
        $this->data = StudentDemographicInfo::latest()->first();
    }

    public function build(): LarapexChart
    {
        return $this->chart->pieChart()
            ->addData([$this->data->male_pct, $this->data->non_male_pct])
            ->setTitle('student gender makeup')
            ->setLabels(['male', 'non male'])
            ->setHeight(200)
            ->setColors([env('CHART_MAIN'), env('CHART_ACCENT')]);
    }
}
