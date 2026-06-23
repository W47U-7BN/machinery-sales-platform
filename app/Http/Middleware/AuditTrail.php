<?php

namespace App\Http\Middleware;

use App\Models\AuditTrail as AuditTrailModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class AuditTrail
{
    protected array $skipMethods = ['GET', 'HEAD', 'OPTIONS'];

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (in_array($request->method(), $this->skipMethods)) {
            return $response;
        }

        if ($request->is('login') || $request->is('logout')) {
            return $response;
        }

        $this->logAction($request, $response);

        return $response;
    }

    protected function logAction(Request $request, Response $response): void
    {
        $route = Route::current();
        $module = $this->extractModule($route?->uri() ?? $request->path());

        AuditTrailModel::create([
            'user_id' => $request->user()?->id,
            'action' => $request->method(),
            'module' => $module,
            'description' => $this->buildDescription($request, $module),
            'route' => $route?->uri() ?? $request->path(),
            'method' => $request->method(),
            'request_data' => $this->sanitizeRequestData($request->except(['password', 'password_confirmation', 'current_password', 'token'])),
            'response_status' => $response->getStatusCode(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'duration_ms' => $this->getDuration(),
        ]);
    }

    protected function extractModule(string $uri): string
    {
        $segments = explode('/', trim($uri, '/'));
        $moduleMap = [
            'products' => 'Produk',
            'categories' => 'Kategori',
            'customers' => 'Pelanggan',
            'leads' => 'Prospek',
            'quotations' => 'Penawaran',
            'orders' => 'Pesanan',
            'invoices' => 'Faktur',
            'service-tickets' => 'Servis',
            'inventory' => 'Inventaris',
            'suppliers' => 'Pemasok',
            'purchase-orders' => 'Pembelian',
            'articles' => 'Artikel',
            'projects' => 'Proyek',
            'users' => 'Pengguna',
            'roles' => 'Hak Akses',
            'permissions' => 'Izin',
            'settings' => 'Pengaturan',
        ];

        return $moduleMap[$segments[0] ?? ''] ?? ucfirst($segments[0] ?? 'Umum');
    }

    protected function buildDescription(Request $request, string $module): string
    {
        $methods = [
            'POST' => 'membuat',
            'PUT' => 'memperbarui',
            'PATCH' => 'memperbarui',
            'DELETE' => 'menghapus',
        ];

        $action = $methods[$request->method()] ?? $request->method();

        return "{$action} {$module}";
    }

    protected function sanitizeRequestData(array $data): array
    {
        $sensitiveFields = ['password', 'password_confirmation', 'current_password', 'token', 'secret'];

        array_walk_recursive($data, function (&$value, $key) use ($sensitiveFields) {
            if (in_array($key, $sensitiveFields)) {
                $value = '***REDACTED***';
            }
        });

        return $data;
    }

    protected function getDuration(): ?float
    {
        if (defined('LARAVEL_START')) {
            return (microtime(true) - LARAVEL_START) * 1000;
        }

        return null;
    }
}
