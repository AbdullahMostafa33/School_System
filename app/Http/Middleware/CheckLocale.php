<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
           
        $locale = $_COOKIE['lang']??'en';       
        
        if (!in_array($locale, ['en', 'ar'])) {
            abort(400);
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
