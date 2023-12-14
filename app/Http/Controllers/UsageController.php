<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UsageLog;
use Illuminate\Support\Facades\DB;

class UsageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $usage_logs = UsageLog::latest()->paginate(20);
        $total_bot_views = DB::table('usage_log')
            ->selectRaw('sum(about_views_bot+course_views_bot+report_views_bot+professor_views_bot+review_views_bot) as total')
            ->get()[0]->total;
        $total_human_views = DB::table('usage_log')
            ->selectRaw('sum(about_views+course_views+report_views+professor_views+review_views) as total')
            ->get()[0]->total;
        $unique_visitors = DB::select('select count(*) as `unique_visitors` from(
                                        select count(*)
                                        from user_details 
                                        group by ip_address ) as `ip`'
                                    )[0]->unique_visitors;
        $registered_users = User::count();

        return view('usage.index', compact('usage_logs', 'total_bot_views', 'total_human_views','unique_visitors','registered_users'));
    }

    public function details(UsageLog $usagelog)
    {
        $user_details = $usagelog->details()->get();

        return view('usage.user_details', compact('user_details'));
    }
}
