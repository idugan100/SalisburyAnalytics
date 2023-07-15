<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class GpaOverTime
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($gpa_by_semester_points): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $gpa_array=[];
        $semester_array=[];
        foreach($$gpa_by_semester_points as $point){
            $gpa_array[]=$point->GPA;
            $semester_array[]=$point->semester . " " . $datum->year;
        }

        return $this->chart->lineChart()
            ->setTitle(' Average GPA Over Time at SU')
            ->addData('GPA', $gpa_array)
            ->setXAxis($semester_array)
            ->setHeight(350)
            ->setColors(["#8b0000"]);
    }
}
