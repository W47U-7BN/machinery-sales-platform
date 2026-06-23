<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    protected array $adminRoles = [
        'Super Admin',
        'Direktur',
        'GM',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if (!$user->hasAnyRole($this->adminRoles)) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akses ditolak. Anda tidak memiliki hak akses administrator.',
                ], Response::HTTP_FORBIDDEN);
            }

            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Akses ditolak. Anda tidak memiliki hak akses administrator.');
        }

        return $next($request);
    }
}
