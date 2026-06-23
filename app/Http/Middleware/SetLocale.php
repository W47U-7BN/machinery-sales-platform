<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    protected array $availableLocales = ['id', 'en'];

    protected string $defaultLocale = 'id';

    public function handle(Request $request, Closure $next): Response
    {
        $locale = $this->detectLocale($request);

        if (!in_array($locale, $this->availableLocales)) {
            $locale = $this->defaultLocale;
        }

        App::setLocale($locale);

        return $next($request);
    }

    protected function detectLocale(Request $request): string
    {
        if ($locale = $request->session()->get('locale')) {
            return $locale;
        }

        if ($locale = $request->cookie('locale')) {
            return $locale;
        }

        if ($locale = $request->query('locale')) {
            return $locale;
        }

        if ($locale = $request->header('Accept-Language')) {
            $preferred = explode(',', $locale)[0];
            $lang = substr($preferred, 0, 2);

            if (in_array($lang, $this->availableLocales)) {
                return $lang;
            }
        }

        if ($request->user() && $request->user()->locale) {
            return $request->user()->locale;
        }

        return $this->defaultLocale;
    }
}
