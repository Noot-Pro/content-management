<?php

namespace NootPro\ContentManagement\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $availableLocales = config('noot-pro-content-management.locales', []);
        $sessionLocale = session('locale');

        if ($sessionLocale && array_key_exists($sessionLocale, $availableLocales)) {
            app()->setLocale($sessionLocale);
        } else {
            $defaultLocale = config('app.locale', 'en');
            if (array_key_exists($defaultLocale, $availableLocales)) {
                app()->setLocale($defaultLocale);
            }
        }

        return $next($request);
    }
}

