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

        //ethnicity (student.race_ethnicity.aian/nhpi/asian/black/white/unknown/hispanic/two_or_more/) - bar chart
        //gender makeup (student.demographics.men/women) - pie
        //number grad vs ugrad (student.enrollment.grad_12_month/undergrad_12_month) - pie
        //share low middle upper income (share_lowincome/share_middle_income/share_high_income) - bar
        //share first generation parents (share_firstgeneration_parents.highschool/somecollege/middleschool) rest is college degree - pie
        //steps: tab, route, blade view, controller, charts for each item, migration for table, import service , job, command line tool
        return view('reports.studentdemographics', compact('ethnicity_chart', 'gender_chart', 'parent_education', 'enrollment_type', 'income'));
    }
}
