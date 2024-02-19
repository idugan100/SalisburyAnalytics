<?php

namespace App\Http\Controllers;

use App\Charts\GradToUGradChart;
use App\Charts\ParentalEducationLevelChart;
use App\Charts\StudentEthnicityChart;
use App\Charts\StudentFamilyIncomesChart;
use App\Charts\StudentGenderChart;
use App\Services\TrackUsage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DoEdReportController extends Controller
{
    public function student_demographics(Request $request, StudentEthnicityChart $chart, StudentGenderChart $chart2, ParentalEducationLevelChart $chart3, GradToUGradChart $chart4, StudentFamilyIncomesChart $chart5): View
    {
        TrackUsage::log($request, 'report');

        $ethnicity_chart = $chart->build();
        $gender_chart = $chart2->build();
        $parent_education = $chart3->build();
        $enrollment_type = $chart4->build();
        $income = $chart5->build();

        return view('reports.studentdemographics', compact('ethnicity_chart', 'gender_chart', 'parent_education', 'enrollment_type', 'income'));
    }

    public function financial_outcomes(Request $request): View
    {
        return view("reports.financialoutcomes");
    }
}
