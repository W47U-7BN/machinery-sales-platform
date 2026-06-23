<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'company_name', 'value' => 'PT Indo Industrial Machinery', 'group' => 'general', 'type' => 'text'],
            ['key' => 'company_tagline', 'value' => 'Solusi Mesin Industri Terpercaya untuk Indonesia', 'group' => 'general', 'type' => 'text'],
            ['key' => 'company_email', 'value' => 'info@indoindustrial.co.id', 'group' => 'general', 'type' => 'email'],
            ['key' => 'company_phone', 'value' => '021-12345678', 'group' => 'general', 'type' => 'text'],
            ['key' => 'company_whatsapp', 'value' => '6281234567890', 'group' => 'general', 'type' => 'text'],
            ['key' => 'company_address', 'value' => 'Jl. Industri Raya No. 88, Kawasan Industri Pulogadung, Jakarta Timur', 'group' => 'general', 'type' => 'textarea'],

            // Currency
            ['key' => 'currency_code', 'value' => 'IDR', 'group' => 'currency', 'type' => 'text'],
            ['key' => 'currency_symbol', 'value' => 'Rp', 'group' => 'currency', 'type' => 'text'],

            // Tax
            ['key' => 'tax_rate', 'value' => '11', 'group' => 'tax', 'type' => 'number'],
            ['key' => 'tax_label', 'value' => 'PPN 11%', 'group' => 'tax', 'type' => 'text'],

            // Invoice
            ['key' => 'invoice_prefix', 'value' => 'INV-', 'group' => 'invoice', 'type' => 'text'],
            ['key' => 'invoice_due_days', 'value' => '30', 'group' => 'invoice', 'type' => 'number'],

            // Order
            ['key' => 'order_prefix', 'value' => 'ORD-', 'group' => 'order', 'type' => 'text'],
            ['key' => 'quotation_prefix', 'value' => 'QTN-', 'group' => 'order', 'type' => 'text'],
            ['key' => 'quotation_valid_days', 'value' => '30', 'group' => 'order', 'type' => 'number'],

            // Shipping
            ['key' => 'shipping_free_threshold', 'value' => '50000000', 'group' => 'shipping', 'type' => 'number'],

            // Notification
            ['key' => 'notification_email', 'value' => 'notifikasi@indoindustrial.co.id', 'group' => 'notification', 'type' => 'email'],

            // Website
            ['key' => 'meta_title', 'value' => 'PT Indo Industrial Machinery - Solusi Mesin Industri Terpercaya', 'group' => 'seo', 'type' => 'text'],
            ['key' => 'meta_description', 'value' => 'PT Indo Industrial Machinery menyediakan berbagai mesin industri berkualitas tinggi untuk kebutuhan bisnis Anda. Mesin pengolahan makanan, packaging, pertanian, boiler, generator, dan lainnya.', 'group' => 'seo', 'type' => 'textarea'],
            ['key' => 'meta_keywords', 'value' => 'mesin industri, mesin makanan, mesin packaging, boiler, generator, conveyor, mesin pertanian, indonesia', 'group' => 'seo', 'type' => 'text'],
        ];

        foreach ($settings as $data) {
            Setting::firstOrCreate(
                ['key' => $data['key']],
                [
                    'value' => $data['value'],
                    'group' => $data['group'],
                    'type' => $data['type'],
                ]
            );
        }
    }
}
