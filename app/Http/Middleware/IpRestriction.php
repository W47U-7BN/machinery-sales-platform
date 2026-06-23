<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IpRestriction
{
    public function handle(Request $request, Closure $next): Response
    {
        $whitelist = $this->getWhitelist();

        if (empty($whitelist)) {
            return $next($request);
        }

        if (in_array($request->ip(), $whitelist)) {
            return $next($request);
        }

        foreach ($whitelist as $allowed) {
            if (str_contains($allowed, '*') && $this->matchWildcard($request->ip(), $allowed)) {
                return $next($request);
            }

            if (str_contains($allowed, '/') && $this->matchCidr($request->ip(), $allowed)) {
                return $next($request);
            }
        }

        abort(403, 'Akses ditolak. IP address Anda tidak terdaftar.');
    }

    protected function getWhitelist(): array
    {
        return config('ip-restriction.whitelist', [])
            ?? settings('ip_whitelist', [])
            ?? [];
    }

    protected function matchWildcard(string $ip, string $pattern): bool
    {
        $pattern = preg_quote($pattern, '/');
        $pattern = str_replace('\*', '.*', $pattern);

        return (bool) preg_match('/^' . $pattern . '$/', $ip);
    }

    protected function matchCidr(string $ip, string $cidr): bool
    {
        $parts = explode('/', $cidr);
        $rangeIp = $parts[0];
        $prefix = (int) ($parts[1] ?? 32);

        $ipLong = ip2long($ip);
        $rangeLong = ip2long($rangeIp);

        if ($ipLong === false || $rangeLong === false) {
            return false;
        }

        $mask = -1 << (32 - $prefix);

        return ($ipLong & $mask) === ($rangeLong & $mask);
    }
}
