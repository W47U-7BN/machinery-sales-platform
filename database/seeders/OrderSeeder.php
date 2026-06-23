<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Quotation;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $customers = Customer::pluck('id')->toArray();
        $quotations = Quotation::where('status', 'approved')->pluck('id')->toArray();
        $sales = User::role('Sales')->pluck('id')->toArray();
        $products = Product::pluck('id', 'sku')->toArray();

        if (empty($sales)) {
            $sales = User::pluck('id')->toArray();
        }

        $orders = [
            ['order_number' => 'ORD-20250101-1001', 'customer_idx' => 0, 'status' => 'delivered', 'payment_status' => 'paid', 'total' => 35000000, 'shipping' => 500000],
            ['order_number' => 'ORD-20250115-1002', 'customer_idx' => 1, 'status' => 'shipped', 'payment_status' => 'paid', 'total' => 125000000, 'shipping' => 1500000],
            ['order_number' => 'ORD-20250201-1003', 'customer_idx' => 2, 'status' => 'processing', 'payment_status' => 'partial', 'total' => 45000000, 'shipping' => 750000],
            ['order_number' => 'ORD-20250215-1004', 'customer_idx' => 3, 'status' => 'confirmed', 'payment_status' => 'unpaid', 'total' => 185000000, 'shipping' => 2000000],
            ['order_number' => 'ORD-20250301-1005', 'customer_idx' => 4, 'status' => 'delivered', 'payment_status' => 'paid', 'total' => 85000000, 'shipping' => 1000000],
            ['order_number' => 'ORD-20250315-1006', 'customer_idx' => 5, 'status' => 'pending', 'payment_status' => 'unpaid', 'total' => 12500000, 'shipping' => 250000],
            ['order_number' => 'ORD-20250401-1007', 'customer_idx' => 6, 'status' => 'shipped', 'payment_status' => 'paid', 'total' => 95000000, 'shipping' => 1200000],
            ['order_number' => 'ORD-20250415-1008', 'customer_idx' => 7, 'status' => 'cancelled', 'payment_status' => 'unpaid', 'total' => 35000000, 'shipping' => 500000],
            ['order_number' => 'ORD-20250501-1009', 'customer_idx' => 8, 'status' => 'delivered', 'payment_status' => 'paid', 'total' => 165000000, 'shipping' => 1800000],
            ['order_number' => 'ORD-20250515-1010', 'customer_idx' => 9, 'status' => 'processing', 'payment_status' => 'partial', 'total' => 5500000, 'shipping' => 150000],
        ];

        $productSku = array_keys($products);

        foreach ($orders as $data) {
            $subtotal = $data['total'] - $data['shipping'];
            $tax = $subtotal * 0.11;

            $order = Order::create([
                'customer_id' => $customers[$data['customer_idx']] ?? $customers[0],
                'quotation_id' => !empty($quotations) ? fake()->randomElement($quotations) : null,
                'sales_id' => !empty($sales) ? fake()->randomElement($sales) : 1,
                'order_number' => $data['order_number'],
                'order_date' => fake()->dateTimeBetween('-6 months', 'now'),
                'subtotal' => round($subtotal, 2),
                'tax_amount' => round($tax, 2),
                'discount_amount' => 0,
                'shipping_cost' => $data['shipping'],
                'total_amount' => $data['total'],
                'total' => $data['total'],
                'payment_status' => $data['payment_status'],
                'order_status' => $data['status'],
                'status' => $data['status'],
                'payment_method' => fake()->randomElement(['Transfer Bank', 'Kartu Kredit', 'Cash']),
                'shipping_address' => json_encode(['street' => 'Jl. Contoh No. 1', 'city' => 'Jakarta', 'province' => 'DKI Jakarta', 'postal_code' => '12950']),
                'billing_address' => json_encode(['street' => 'Jl. Contoh No. 1', 'city' => 'Jakarta', 'province' => 'DKI Jakarta', 'postal_code' => '12950']),
                'notes' => $data['status'] === 'cancelled' ? 'Pesanan dibatalkan oleh pelanggan' : null,
                'approved_at' => in_array($data['status'], ['confirmed', 'processing', 'shipped', 'delivered']) ? now()->subDays(30) : null,
                'shipped_at' => in_array($data['status'], ['shipped', 'delivered']) ? now()->subDays(15) : null,
                'delivered_at' => $data['status'] === 'delivered' ? now()->subDays(5) : null,
            ]);

            // Create order items
            $qty = fake()->numberBetween(1, 3);
            for ($i = 0; $i < $qty; $i++) {
                if (!empty($productSku)) {
                    $price = $data['total'] / $qty;
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $products[fake()->randomElement($productSku)],
                        'quantity' => 1,
                        'unit_price' => round($price, 2),
                        'subtotal' => round($price, 2),
                    ]);
                }
            }
        }
    }
}
