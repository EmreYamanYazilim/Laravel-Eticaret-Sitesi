<?php

namespace App\Http\Middleware;

use App\Models\SiteSetting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SiteSettingsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
//        $settings = SiteSetting::get();
//        view()->share(['settings'=>$settings]);
        $settings = SiteSetting::pluck('data', 'name')->toArray();
        view()->share(['settings'=>$settings]);

        return $next($request);
    }
}
