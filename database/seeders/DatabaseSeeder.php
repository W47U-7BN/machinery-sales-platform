<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            // Urutan pertama: data master independen
            RoleAndPermissionSeeder::class,
            DepartmentSeeder::class,
            PositionSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            UnitSeeder::class,
            CompanyInformationSeeder::class,
            WarehouseSeeder::class,
            SettingSeeder::class,

            // Users & Admin
            AdminUserSeeder::class,

            // Produk dan konten
            ProductSeeder::class,

            // Relasi dependen
            CustomerSeeder::class,
            EmployeeSeeder::class,
            DealerSeeder::class,
            VendorSeeder::class,

            // Lead, Quotation, Order
            LeadSeeder::class,
            QuotationSeeder::class,
            OrderSeeder::class,

            // Konten website
            ArticleSeeder::class,
            TestimonialSeeder::class,
            ClientSeeder::class,
            FaqSeeder::class,
        ]);
    }
}
