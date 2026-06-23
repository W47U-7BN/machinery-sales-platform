<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TwoFactorAuthentication
{
    protected const EXCEPT_ROUTES = [
        'two-factor.challenge',
        'two-factor.verify',
        'two-factor.recovery',
        'logout',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return $next($request);
        }

        if ($this->shouldSkip($request)) {
            return $next($request);
        }

        if (!$this->isTwoFactorEnabled($user)) {
            return $next($request);
        }

        if ($this->isTwoFactorVerified($request)) {
            return $next($request);
        }

        return redirect()->route('two-factor.challenge');
    }

    protected function shouldSkip(Request $request): bool
    {
        return in_array($request->route()?->getName(), self::EXCEPT_ROUTES)
            || $request->is('two-factor/*')
            || $request->is('logout');
    }

    protected function isTwoFactorEnabled($user): bool
    {
        return !is_null($user->two_factor_secret)
            && !is_null($user->two_factor_confirmed_at);
    }

    protected function isTwoFactorVerified(Request $request): bool
    {
        return session()->has('two_factor_verified')
            && session('two_factor_verified') === true;
    }
}
