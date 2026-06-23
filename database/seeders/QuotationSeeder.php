<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Lead;
use App\Models\Quotation;
use App\Models\User;
use Illuminate\Database\Seeder;

class QuotationSeeder extends Seeder
{
    public function run(): void
    {
        $customers = Customer::pluck('id')->toArray();
        $leads = Lead::pluck('id')->toArray();
        $sales = User::role('Sales')->pluck('id')->toArray();

        if (empty($sales)) {
            $sales = User::pluck('id')->toArray();
        }

        $quotations = [
            ['customer_id' => $customers[0] ?? 1, 'lead_id' => $leads[0] ?? null, 'status' => 'approved', 'total_amount' => 35000000],
            ['customer_id' => $customers[1] ?? 1, 'lead_id' => $leads[1] ?? null, 'status' => 'sent', 'total_amount' => 125000000],
            ['customer_id' => $customers[2] ?? 1, 'lead_id' => $leads[2] ?? null, 'status' => 'draft', 'total_amount' => 45000000],
            ['customer_id' => $customers[3] ?? 1, 'lead_id' => $leads[3] ?? null, 'status' => 'approved', 'total_amount' => 185000000],
            ['customer_id' => $customers[4] ?? 1, 'lead_id' => $leads[4] ?? null, 'status' => 'rejected', 'total_amount' => 65000000],
            ['customer_id' => $customers[5] ?? 1, 'lead_id' => $leads[5] ?? null, 'status' => 'sent', 'total_amount' => 85000000],
            ['customer_id' => $customers[6] ?? 1, 'lead_id' => $leads[6] ?? null, 'status' => 'approved', 'total_amount' => 12500000],
            ['customer_id' => $customers[7] ?? 1, 'lead_id' => $leads[7] ?? null, 'status' => 'draft', 'total_amount' => 450000000],
            ['customer_id' => $customers[8] ?? 1, 'lead_id' => $leads[8] ?? null, 'status' => 'expired', 'total_amount' => 45000000],
            ['customer_id' => $customers[9] ?? 1, 'lead_id' => $leads[9] ?? null, 'status' => 'sent', 'total_amount' => 95000000],
            ['customer_id' => $customers[10] ?? 1, 'lead_id' => $leads[10] ?? null, 'status' => 'approved', 'total_amount' => 35000000],
            ['customer_id' => $customers[11] ?? 1, 'lead_id' => $leads[11] ?? null, 'status' => 'draft', 'total_amount' => 165000000],
            ['customer_id' => $customers[12] ?? 1, 'lead_id' => $leads[12] ?? null, 'status' => 'approved', 'total_amount' => 95000000],
            ['customer_id' => $customers[13] ?? 1, 'lead_id' => $leads[13] ?? null, 'status' => 'rejected', 'total_amount' => 45000000],
            ['customer_id' => $customers[14] ?? 1, 'lead_id' => $leads[14] ?? null, 'status' => 'sent', 'total_amount' => 5500000],
        ];

        $counter = 1000;
        foreach ($quotations as $data) {
            $counter++;
            $subtotal = $data['total_amount'] / 1.11;
            $tax = $data['total_amount'] - $subtotal;

            Quotation::create([
                'quotation_number' => 'QTN-' . date('Ymd') . '-' . $counter,
                'customer_id' => $data['customer_id'],
                'lead_id' => $data['lead_id'],
                'sales_id' => !empty($sales) ? fake()->randomElement($sales) : 1,
                'title' => fake()->sentence(4),
                'subtotal' => round($subtotal, 2),
                'tax_amount' => round($tax, 2),
                'discount_amount' => 0,
                'total_amount' => $data['total_amount'],
                'valid_until' => now()->addDays(fake()->numberBetween(14, 90)),
                'status' => $data['status'],
                'terms_conditions' => 'Pembayaran: Transfer Bank. Pengiriman: 2-4 minggu setelah PO. Garansi: 1 tahun.',
                'notes' => $data['status'] === 'rejected' ? 'Harga terlalu tinggi dibandingkan kompetitor' : null,
                'approved_at' => in_array($data['status'], ['approved']) ? now() : null,
                'rejected_at' => $data['status'] === 'rejected' ? now() : null,
                'rejection_reason' => $data['status'] === 'rejected' ? 'Harga terlalu tinggi' : null,
            ]);
        }
    }
}
