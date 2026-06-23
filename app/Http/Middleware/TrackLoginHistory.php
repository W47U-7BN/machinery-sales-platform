<?php

namespace App\Http\Middleware;

use App\Models\UserLoginHistory;
use Closure;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Symfony\Component\HttpFoundation\Response;

class TrackLoginHistory
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->isMethod('post') && $request->is('login') && $request->user()) {
            $this->recordLogin($request, true);
        }

        return $response;
    }

    public function recordLogin(Request $request, bool $success, ?string $email = null): void
    {
        $agent = new Agent();
        $agent->setUserAgent($request->userAgent() ?? '');

        UserLoginHistory::create([
            'user_id' => $request->user()?->id,
            'email' => $email ?? $request->user()?->email,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'device' => $agent->device(),
            'platform' => $agent->platform(),
            'browser' => $agent->browser(),
            'is_mobile' => $agent->isMobile(),
            'is_tablet' => $agent->isTablet(),
            'is_desktop' => $agent->isDesktop(),
            'success' => $success,
            'login_at' => now(),
        ]);
    }
}
