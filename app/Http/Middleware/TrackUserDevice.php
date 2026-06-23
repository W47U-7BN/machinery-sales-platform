<?php

namespace App\Http\Middleware;

use App\Models\UserDevice;
use Closure;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Symfony\Component\HttpFoundation\Response;

class TrackUserDevice
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->user() && $request->isMethod('post') && $request->is('login')) {
            $this->trackDevice($request);
        }

        return $response;
    }

    protected function trackDevice(Request $request): void
    {
        $agent = new Agent();
        $agent->setUserAgent($request->userAgent() ?? '');

        $fingerprint = $this->generateFingerprint($request);

        $device = UserDevice::firstOrNew([
            'user_id' => $request->user()->id,
            'device_fingerprint' => $fingerprint,
        ]);

        $device->fill([
            'user_agent' => $request->userAgent(),
            'device' => $agent->device(),
            'platform' => $agent->platform(),
            'browser' => $agent->browser(),
            'is_mobile' => $agent->isMobile(),
            'is_tablet' => $agent->isTablet(),
            'is_desktop' => $agent->isDesktop(),
            'ip_address' => $request->ip(),
            'last_used_at' => now(),
        ]);

        if (!$device->exists) {
            $device->first_seen_at = now();
            $device->is_trusted = false;
        }

        $device->save();

        if ($device->wasRecentlyCreated && !$device->is_trusted) {
            session()->flash('new_device_warning', 'Login dari perangkat baru terdeteksi.');
        }
    }

    protected function generateFingerprint(Request $request): string
    {
        $agent = new Agent();
        $agent->setUserAgent($request->userAgent() ?? '');

        $raw = implode('|', [
            $agent->device(),
            $agent->platform(),
            $agent->browser(),
            $request->header('Accept-Language'),
        ]);

        return md5($raw);
    }
}
