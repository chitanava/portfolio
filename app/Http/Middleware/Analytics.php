<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Analytics
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if(isset($request->updates)){
            foreach($request->updates as $update){  
                if(
                    (isset($update['payload']['method']) && $update['payload']['method'] == 'loadAnalyticsData') || 
                    (isset($update['payload']['name']) && $update['payload']['name'] == 'analyticsDays')
                )
                {
                    $settings = Setting::firstOrFail();
                    config(['analytics.property_id' => $settings->analytics_property_id]);
                }
            }
          }

        return $next($request);
    }
}
