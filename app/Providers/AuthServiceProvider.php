<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Inventory;
use App\Models\Invoice;
use App\Models\Lead;
use App\Models\Order;
use App\Models\Product;
use App\Models\Project;
use App\Models\PurchaseOrder;
use App\Models\Quotation;
use App\Models\ServiceTicket;
use App\Models\Supplier;
use App\Policies\ArticlePolicy;
use App\Policies\CategoryPolicy;
use App\Policies\CustomerPolicy;
use App\Policies\InventoryPolicy;
use App\Policies\InvoicePolicy;
use App\Policies\LeadPolicy;
use App\Policies\OrderPolicy;
use App\Policies\ProductPolicy;
use App\Policies\ProjectPolicy;
use App\Policies\PurchaseOrderPolicy;
use App\Policies\QuotationPolicy;
use App\Policies\ServiceTicketPolicy;
use App\Policies\SupplierPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Product::class => ProductPolicy::class,
        Category::class => CategoryPolicy::class,
        Customer::class => CustomerPolicy::class,
        Lead::class => LeadPolicy::class,
        Quotation::class => QuotationPolicy::class,
        Order::class => OrderPolicy::class,
        Invoice::class => InvoicePolicy::class,
        ServiceTicket::class => ServiceTicketPolicy::class,
        Inventory::class => InventoryPolicy::class,
        Supplier::class => SupplierPolicy::class,
        PurchaseOrder::class => PurchaseOrderPolicy::class,
        Article::class => ArticlePolicy::class,
        Project::class => ProjectPolicy::class,
    ];

    public function boot(): void
    {
        //
    }
}
