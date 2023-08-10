<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureIsSubscribed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user=auth()->user();

        if(!isset($user)){
            return redirect(route("premium"));
        }
        elseif(!$user->hasPaymentMethod()){
            return redirect(route("checkout"));
        }
        elseif(!$user->subscribed('default') && $user->hasPaymentMethod()){
            return $user->redirectToBillingPortal(route('courses.index'));
        }
        return $next($request);
    }
}