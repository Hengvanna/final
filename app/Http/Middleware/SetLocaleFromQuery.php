<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleFromQuery
{
    protected array $allowed = ['en', 'km'];

    public function handle(Request $request, Closure $next): Response
    {
        // Restore locale from session first (so it's set for this request)
        if (session()->has('app_locale')) {
            $sessionLocale = session('app_locale');
            if (in_array($sessionLocale, $this->allowed, true)) {
                App::setLocale($sessionLocale);
            }
        }

        // If user chose a new locale via query, save it and redirect (without the param)
        $locale = $request->query('setAppLocale');
        if ($locale && in_array($locale, $this->allowed, true)) {
            App::setLocale($locale);
            session()->put('app_locale', $locale);
            $query = $request->query();
            unset($query['setAppLocale']);
            $url = $query ? $request->url() . '?' . http_build_query($query) : $request->url();
            return redirect()->to($url);
        }

        return $next($request);
    }
}
