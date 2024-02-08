<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoEdReportController extends Controller
{
    public function student_demographics(Request $request){
        #ethnicity (student.race_ethnicity.aian/nhpi/asian/black/white/unknown/hispanic/two_or_more/)
        #gender makeup (student.demographics.men/women)
        #number grad vs ugrad (student.enrollment.grad_12_month/undergrad_12_month)
        #pct first generation (student.first_generation)
        #share low middle upper income (share_lowincome/share_middle_income/share_high_income)
        # share first generation parents (share_firstgeneration_parents.highschool/somecollege/middleschool)
        #steps: tab, route, blade view, controller, charts for each item, migration for table, import service , job, command line tool

    } 
}
