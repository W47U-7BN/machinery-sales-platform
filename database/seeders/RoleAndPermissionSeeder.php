<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        $permissionsByModule = [
            'products' => ['view-products', 'create-products', 'edit-products', 'delete-products'],
            'categories' => ['view-categories', 'create-categories', 'edit-categories', 'delete-categories'],
            'brands' => ['view-brands', 'create-brands', 'edit-brands', 'delete-brands'],
            'customers' => ['view-customers', 'create-customers', 'edit-customers', 'delete-customers'],
            'leads' => ['view-leads', 'create-leads', 'edit-leads', 'delete-leads', 'convert-leads'],
            'quotations' => ['view-quotations', 'create-quotations', 'edit-quotations', 'delete-quotations', 'approve-quotations'],
            'orders' => ['view-orders', 'create-orders', 'edit-orders', 'delete-orders'],
            'invoices' => ['view-invoices', 'create-invoices', 'edit-invoices', 'delete-invoices', 'approve-invoices'],
            'payments' => ['view-payments', 'create-payments', 'edit-payments', 'delete-payments'],
            'inventory' => ['view-inventory', 'create-inventory', 'edit-inventory', 'delete-inventory', 'transfer-inventory'],
            'warehouse' => ['view-warehouses', 'create-warehouses', 'edit-warehouses', 'delete-warehouses'],
            'suppliers' => ['view-suppliers', 'create-suppliers', 'edit-suppliers', 'delete-suppliers'],
            'purchases' => ['view-purchases', 'create-purchases', 'edit-purchases', 'delete-purchases', 'approve-purchases'],
            'services' => ['view-services', 'create-services', 'edit-services', 'delete-services', 'assign-services'],
            'projects' => ['view-projects', 'create-projects', 'edit-projects', 'delete-projects'],
            'employees' => ['view-employees', 'create-employees', 'edit-employees', 'delete-employees'],
            'articles' => ['view-articles', 'create-articles', 'edit-articles', 'delete-articles'],
            'testimonials' => ['view-testimonials', 'create-testimonials', 'edit-testimonials', 'delete-testimonials'],
            'clients' => ['view-clients', 'create-clients', 'edit-clients', 'delete-clients'],
            'contacts' => ['view-contacts', 'delete-contacts'],
            'campaigns' => ['view-campaigns', 'create-campaigns', 'edit-campaigns', 'delete-campaigns'],
            'reports' => ['view-reports', 'export-reports'],
            'settings' => ['view-settings', 'edit-settings'],
            'users' => ['view-users', 'create-users', 'edit-users', 'delete-users'],
            'roles' => ['view-roles', 'create-roles', 'edit-roles', 'delete-roles'],
            'dealers' => ['view-dealers', 'create-dealers', 'edit-dealers', 'delete-dealers'],
            'vendors' => ['view-vendors', 'create-vendors', 'edit-vendors', 'delete-vendors'],
        ];

        $allPermissions = [];
        foreach ($permissionsByModule as $permissions) {
            foreach ($permissions as $permission) {
                $allPermissions[] = Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
            }
        }

        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        $superAdmin->syncPermissions($allPermissions);

        $rolePermissions = [
            'Direktur' => [
                'view-products', 'view-categories', 'view-brands', 'view-customers',
                'view-leads', 'view-quotations', 'approve-quotations', 'view-orders',
                'view-invoices', 'approve-invoices', 'view-payments', 'view-inventory',
                'view-warehouses', 'view-suppliers', 'view-purchases', 'approve-purchases',
                'view-services', 'view-projects', 'view-employees', 'view-articles',
                'view-testimonials', 'view-clients', 'view-reports', 'export-reports',
                'view-settings', 'edit-settings', 'view-users', 'view-roles',
                'view-dealers', 'view-vendors', 'view-contacts', 'view-campaigns',
            ],
            'General Manager' => [
                'view-products', 'create-products', 'edit-products', 'view-categories',
                'view-brands', 'view-customers', 'view-leads', 'view-quotations',
                'approve-quotations', 'view-orders', 'create-orders', 'edit-orders',
                'view-invoices', 'approve-invoices', 'view-payments', 'view-inventory',
                'view-warehouses', 'view-suppliers', 'view-purchases', 'approve-purchases',
                'view-services', 'assign-services', 'view-projects', 'view-employees',
                'view-articles', 'view-testimonials', 'view-clients', 'view-reports',
                'export-reports', 'view-settings', 'edit-settings', 'view-users',
                'view-dealers', 'view-vendors',
            ],
            'Sales Manager' => [
                'view-products', 'view-categories', 'view-brands', 'view-customers',
                'create-customers', 'edit-customers', 'view-leads', 'create-leads',
                'edit-leads', 'convert-leads', 'view-quotations', 'create-quotations',
                'edit-quotations', 'approve-quotations', 'view-orders', 'create-orders',
                'edit-orders', 'view-invoices', 'view-payments', 'view-inventory',
                'view-reports', 'export-reports', 'view-dealers', 'view-vendors',
            ],
            'Sales' => [
                'view-products', 'view-categories', 'view-brands', 'view-customers',
                'create-customers', 'edit-customers', 'view-leads', 'create-leads',
                'edit-leads', 'convert-leads', 'view-quotations', 'create-quotations',
                'edit-quotations', 'view-orders', 'create-orders', 'view-invoices',
                'view-payments', 'view-dealers',
            ],
            'Marketing' => [
                'view-products', 'view-categories', 'view-brands', 'view-articles',
                'create-articles', 'edit-articles', 'delete-articles', 'view-testimonials',
                'create-testimonials', 'edit-testimonials', 'view-clients', 'create-clients',
                'edit-clients', 'view-contacts', 'view-campaigns', 'create-campaigns',
                'edit-campaigns', 'view-reports', 'export-reports',
            ],
            'Teknisi' => [
                'view-products', 'view-categories', 'view-brands', 'view-services',
                'create-services', 'edit-services', 'assign-services', 'view-inventory',
                'view-warehouses',
            ],
            'Warehouse' => [
                'view-products', 'view-categories', 'view-brands', 'view-inventory',
                'create-inventory', 'edit-inventory', 'transfer-inventory', 'view-warehouses',
                'view-suppliers', 'view-purchases', 'create-purchases', 'edit-purchases',
            ],
            'Finance' => [
                'view-customers', 'view-quotations', 'view-orders', 'view-invoices',
                'create-invoices', 'edit-invoices', 'approve-invoices', 'view-payments',
                'create-payments', 'edit-payments', 'view-suppliers', 'view-purchases',
                'view-reports', 'export-reports',
            ],
            'Customer Service' => [
                'view-products', 'view-customers', 'create-customers', 'edit-customers',
                'view-services', 'create-services', 'edit-services', 'view-contacts',
                'view-leads', 'create-leads',
            ],
            'Dealer' => [
                'view-products', 'view-categories', 'view-brands', 'view-customers',
                'view-quotations', 'create-quotations', 'view-orders',
            ],
            'Vendor' => [
                'view-products', 'view-categories', 'view-brands',
            ],
            'Customer' => [
                'view-products', 'view-categories', 'view-brands',
            ],
        ];

        foreach ($rolePermissions as $roleName => $permissions) {
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
            $role->syncPermissions($permissions);
        }
    }
}
