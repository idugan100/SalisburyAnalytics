<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsageLog;

class UsageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $usage_logs=UsageLog::latest()->paginate(20);
        return view ("usage.index",compact("usage_logs"));
    }
}
