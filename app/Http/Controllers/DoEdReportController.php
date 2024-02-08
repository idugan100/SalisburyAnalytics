<?php

namespace App\Http\Controllers;

use App\Charts\StudentEthnicityChart;
use App\Services\TrackUsage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DoEdReportController extends Controller
{
    public function student_demographics(Request $request, StudentEthnicityChart $chart): View
    {
        TrackUsage::log($request, 'report');
        $ethnicity_chart = $chart->build();

        //ethnicity (student.race_ethnicity.aian/nhpi/asian/black/white/unknown/hispanic/two_or_more/) - bar chart
        //gender makeup (student.demographics.men/women) - pie
        //number grad vs ugrad (student.enrollment.grad_12_month/undergrad_12_month) - pie
        //share low middle upper income (share_lowincome/share_middle_income/share_high_income) - bar
        //share first generation parents (share_firstgeneration_parents.highschool/somecollege/middleschool) rest is college degree - pie
        //steps: tab, route, blade view, controller, charts for each item, migration for table, import service , job, command line tool
        return view('reports.studentdemographics', compact('ethnicity_chart'));
    }
}
