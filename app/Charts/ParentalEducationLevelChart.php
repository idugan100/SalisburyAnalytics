<?php

namespace App\Charts;

use App\Models\StudentDemographicInfo;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class ParentalEducationLevelChart
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
            ->addData([$this->data->middle_school_pct, $this->data->high_school_pct, $this->data->some_college_pct, $this->data->college_degree_pct])
            ->setTitle('highest level of parental education')
            ->setLabels(['middle school', 'high school', 'some college', 'college degree'])
            ->setHeight(200)
            ->setColors(['#000000', '#ABB0B8', env('CHART_ACCNET'), env("CHART_MAIN")]);
    }
}
