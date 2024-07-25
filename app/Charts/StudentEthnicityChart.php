<?php

namespace App\Charts;

use App\Models\StudentDemographicInfo;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class StudentEthnicityChart
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

    public function build(): \ArielMejiaDev\LarapexCharts\LarapexChart
    {
        return $this->chart->barChart()
            ->addData('percentage of student body',
                [
                    $this->data->native_american_pct, $this->data->pacific_islander_pct, $this->data->asian_pct, $this->data->black_pct,
                    $this->data->white_pct, $this->data->hispanic_pct, $this->data->two_or_more_races_pct, $this->data->unknow_race_pct,
                ]
            )
            ->setTitle('student  ethnicity')
            ->setXAxis(['native american', 'pacific islander', 'asian', 'black', 'white', 'hispanic', 'two or more', 'unknown'])
            ->setColors([env('CHART_MAIN')])
            ->setHeight(300);
    }
}
