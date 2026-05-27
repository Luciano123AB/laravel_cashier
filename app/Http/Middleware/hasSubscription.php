<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class hasSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //Check if the user has subscription:
        if (!auth()->user()->subscribed(env("STRIPE_PRODUCT_ID"))) {
            return redirect()->route("plans");
        }

        return $next($request);
    }
}
