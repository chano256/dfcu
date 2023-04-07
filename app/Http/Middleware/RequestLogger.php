<?php

namespace App\Http\Middleware;

use App\Models\AuditTrail;
use Closure;
use Illuminate\Http\Request;

class RequestLogger
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
        $response =  $next($request);

        $audit = AuditTrail::first(); // default values of 0 in db for new systems

        $code = $response->getStatusCode();
        if ($code >= 400 and $code < 500) { // validation status codes
            $audit->total_failed_validations = ++$audit->total_failed_validations;
        }

        if ($code == 200) {
            if (empty($response->getData()->data)) {
                $audit->total_negative_requests = ++$audit->total_negative_requests;
            } else {
                $audit->total_positive_requests = ++$audit->total_positive_requests;
            }
        }

        // gets total number of requests
        $audit->total_requests = ++$audit->total_requests;
        $audit->save();

        return $response;
    }
}
