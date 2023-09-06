<?php

namespace App\Http\Controllers;

use App\services\TrackUsage;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function billing_portal(Request $request){
        TrackUsage::log($request,"about");
        return $request->user()->redirectToBillingPortal(route('courses.index'));
    }

    public function checkout(Request $request){
        TrackUsage::log($request,"about");
        return view('checkout', [
            'intent' => auth()->user()->createSetupIntent()
        ]);
    }

    public function create_subscription(Request $request){
        $request->user()->newSubscription(
                'default', env("PLAN_ID")
            )->create($request->token);
        return $request->user()->redirectToBillingPortal(route('courses.index'));
    }

    public function premium_page(Request $request){
        TrackUsage::log($request,"about");
        return view("premium");
    }
}
