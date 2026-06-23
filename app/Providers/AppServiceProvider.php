<?php

namespace App\Providers;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuditTrail;
use App\Http\Middleware\ForceJsonResponse;
use App\Http\Middleware\IpRestriction;
use App\Http\Middleware\SetLocale;
use App\Http\Middleware\TrackLoginHistory;
use App\Http\Middleware\TrackUserDevice;
use App\Http\Middleware\TwoFactorAuthentication;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            \App\Contracts\Repositories\ProductRepositoryInterface::class,
            \App\Repositories\ProductRepository::class
        );
        $this->app->bind(
            \App\Contracts\Repositories\CategoryRepositoryInterface::class,
            \App\Repositories\CategoryRepository::class
        );
        $this->app->bind(
            \App\Contracts\Repositories\BrandRepositoryInterface::class,
            \App\Repositories\BrandRepository::class
        );
        $this->app->bind(
            \App\Contracts\Repositories\CustomerRepositoryInterface::class,
            \App\Repositories\CustomerRepository::class
        );
        $this->app->bind(
            \App\Contracts\Repositories\LeadRepositoryInterface::class,
            \App\Repositories\LeadRepository::class
        );
        $this->app->bind(
            \App\Contracts\Repositories\QuotationRepositoryInterface::class,
            \App\Repositories\QuotationRepository::class
        );
        $this->app->bind(
            \App\Contracts\Repositories\OrderRepositoryInterface::class,
            \App\Repositories\OrderRepository::class
        );
        $this->app->bind(
            \App\Contracts\Repositories\InvoiceRepositoryInterface::class,
            \App\Repositories\InvoiceRepository::class
        );
        $this->app->bind(
            \App\Contracts\Repositories\PaymentRepositoryInterface::class,
            \App\Repositories\PaymentRepository::class
        );
        $this->app->bind(
            \App\Contracts\Repositories\ServiceTicketRepositoryInterface::class,
            \App\Repositories\ServiceTicketRepository::class
        );
        $this->app->bind(
            \App\Contracts\Repositories\InventoryRepositoryInterface::class,
            \App\Repositories\InventoryRepository::class
        );
        $this->app->bind(
            \App\Contracts\Repositories\SupplierRepositoryInterface::class,
            \App\Repositories\SupplierRepository::class
        );
        $this->app->bind(
            \App\Contracts\Repositories\PurchaseOrderRepositoryInterface::class,
            \App\Repositories\PurchaseOrderRepository::class
        );
        $this->app->bind(
            \App\Contracts\Repositories\ProjectRepositoryInterface::class,
            \App\Repositories\ProjectRepository::class
        );
        $this->app->bind(
            \App\Contracts\Repositories\WarehouseRepositoryInterface::class,
            \App\Repositories\WarehouseRepository::class
        );
        $this->app->bind(
            \App\Contracts\Repositories\ArticleRepositoryInterface::class,
            \App\Repositories\ArticleRepository::class
        );
        $this->app->bind(
            \App\Contracts\Repositories\SettingRepositoryInterface::class,
            \App\Repositories\SettingRepository::class
        );
    }

    public function boot(): void
    {
        $this->registerMiddlewareAliases();
    }

    protected function registerMiddlewareAliases(): void
    {
        $router = $this->app['router'];

        $router->aliasMiddleware('admin', AdminMiddleware::class);
        $router->aliasMiddleware('2fa', TwoFactorAuthentication::class);
        $router->aliasMiddleware('ip.restrict', IpRestriction::class);
        $router->aliasMiddleware('audit', AuditTrail::class);
        $router->aliasMiddleware('force.json', ForceJsonResponse::class);
        $router->aliasMiddleware('set.locale', SetLocale::class);
        $router->aliasMiddleware('track.login', TrackLoginHistory::class);
        $router->aliasMiddleware('track.device', TrackUserDevice::class);
    }
}
