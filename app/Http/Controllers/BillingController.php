<?php

namespace App\Http\Controllers;

use App\Services\TrackUsage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function billing_portal(Request $request): RedirectResponse
    {
        TrackUsage::log($request, 'about');

        return $request->user()->redirectToBillingPortal(route('courses.index'));
    }

    public function checkout(Request $request): View
    {
        TrackUsage::log($request, 'about');

        return view('billing.checkout', [
            'intent' => auth()->user()->createSetupIntent(),
        ]);
    }

    public function create_subscription(Request $request): RedirectResponse
    {
        $request->user()->newSubscription(
            'default', env('PLAN_ID')
        )
        ->trialDays(7)
        ->create($request->token);

        return $request->user()->redirectToBillingPortal(route('courses.index'));
    }

    public function premium_page(Request $request): View
    {
        TrackUsage::log($request, 'about');

        return view('billing.premium');
    }
}
