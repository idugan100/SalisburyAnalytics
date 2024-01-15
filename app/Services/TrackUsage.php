<?php

namespace App\Services;

use App\Models\UsageLog;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class TrackUsage
{
    public static function log(Request $request, string $page_name): void
    {
        $usage_log = UsageLog::whereDate('created_at', now())->first();
        $is_bot = IsBot::check($request->ip(), $request->userAgent());

        switch ($page_name) {
            case 'course':
                $is_bot ? $usage_log->course_views_bot++ : $usage_log->course_views++;
                break;
            case 'professor':
                $is_bot ? $usage_log->professor_views_bot++ : $usage_log->professor_views++;
                break;
            case 'review':
                $is_bot ? $usage_log->review_views_bot++ : $usage_log->review_views++;
                break;
            case 'about':
                $is_bot ? $usage_log->about_views_bot++ : $usage_log->about_views++;
                break;
            case 'report':
                $is_bot ? $usage_log->report_views_bot++ : $usage_log->report_views++;
                break;
        }

        $usage_log->save();

        if (! $is_bot) {
            $user_detail = new UserDetail();
            $user_detail->user_agent = $request->userAgent();
            $user_detail->ip_address = $request->ip();
            $user_detail->page_visited = $page_name;
            $user_detail->usage_log_id = $usage_log->id;
            $user_detail->save();
        }
    }
}
