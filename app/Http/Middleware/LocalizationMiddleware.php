<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class LocalizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->hasHeader("Accept-Language")){
            App::setLocale($request->header("Accept-Language"));
        }
        if(Session::has('lang')){
            App::setLocale(Session::get('lang'));
        }
        $lang = Session::get('lang') ?? 'en';
        Session::put('lang', $lang);
        App::setlocale ($lang);
        return $next($request);
    }
}
