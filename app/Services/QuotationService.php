<?php

namespace App\Services;

use App\Contracts\Repositories\CustomerRepositoryInterface;
use App\Contracts\Repositories\LeadRepositoryInterface;
use App\Contracts\Repositories\OrderRepositoryInterface;
use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Contracts\Repositories\QuotationRepositoryInterface;
use App\Contracts\Services\QuotationServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QuotationService implements QuotationServiceInterface
{
    public function __construct(
        protected QuotationRepositoryInterface $quotationRepository,
        protected CustomerRepositoryInterface $customerRepository,
        protected ProductRepositoryInterface $productRepository,
        protected LeadRepositoryInterface $leadRepository,
        protected OrderRepositoryInterface $orderRepository,
    ) {}

    public function createQuotation(array $data)
    {
        try {
            DB::beginTransaction();

            $data['quotation_number'] = $this->quotationRepository->generateNumber();
            $data['status'] = $data['status'] ?? 'draft';

            if (isset($data['items'])) {
                $items = $data['items'];
                unset($data['items']);
            }

            $quotation = $this->quotationRepository->create($data);

            if (isset($items)) {
                foreach ($items as $item) {
                    $quotation->items()->create($item);
                }

                $quotation->load('items');
                $this->calculateTotals($quotation);
            }

            if (!empty($data['lead_id'])) {
                $this->leadRepository->update((int) $data['lead_id'], [
                    'status' => 'quotation',
                    'converted_to_quotation_id' => $quotation->id,
                ]);
            }

            DB::commit();

            return $quotation->fresh();
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('QuotationService createQuotation() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function approveQuotation(int $quotationId)
    {
        try {
            DB::beginTransaction();

            $quotation = $this->quotationRepository->update($quotationId, [
                'status' => 'approved',
                'approved_at' => now(),
            ]);

            DB::commit();

            return $quotation;
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('QuotationService approveQuotation() error: ' . $e->getMessage(), [
                'quotation_id' => $quotationId,
            ]);
            throw $e;
        }
    }

    public function rejectQuotation(int $quotationId, string $reason)
    {
        try {
            DB::beginTransaction();

            $quotation = $this->quotationRepository->update($quotationId, [
                'status' => 'rejected',
                'rejected_at' => now(),
                'rejection_reason' => $reason,
            ]);

            DB::commit();

            return $quotation;
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('QuotationService rejectQuotation() error: ' . $e->getMessage(), [
                'quotation_id' => $quotationId,
            ]);
            throw $e;
        }
    }

    public function convertToOrder(int $quotationId)
    {
        try {
            DB::beginTransaction();

            $quotation = $this->quotationRepository->find($quotationId);
            $quotation->load('items');

            $orderData = [
                'customer_id' => $quotation->customer_id,
                'quotation_id' => $quotation->id,
                'sales_id' => $quotation->sales_id,
                'order_number' => $this->orderRepository->generateNumber(),
                'subtotal' => $quotation->subtotal,
                'tax_amount' => $quotation->tax_amount,
                'discount_amount' => $quotation->discount_amount,
                'total_amount' => $quotation->total_amount,
                'order_status' => 'pending',
                'payment_status' => 'pending',
                'notes' => 'Created from quotation: ' . $quotation->quotation_number,
            ];

            $order = $this->orderRepository->create($orderData);

            foreach ($quotation->items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'product_name' => $item->product_name,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price,
                    'discount' => $item->discount,
                    'tax' => $item->tax,
                    'subtotal' => $item->subtotal,
                    'total' => $item->total,
                ]);
            }

            $this->quotationRepository->update($quotationId, [
                'status' => 'converted',
            ]);

            DB::commit();

            return $order->fresh();
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('QuotationService convertToOrder() error: ' . $e->getMessage(), [
                'quotation_id' => $quotationId,
            ]);
            throw $e;
        }
    }

    public function sendToCustomer(int $quotationId)
    {
        try {
            $quotation = $this->quotationRepository->find($quotationId);
            $quotation->load('customer');

            $this->quotationRepository->update($quotationId, [
                'status' => 'sent',
            ]);

            return $quotation;
        } catch (\Throwable $e) {
            Log::error('QuotationService sendToCustomer() error: ' . $e->getMessage(), [
                'quotation_id' => $quotationId,
            ]);
            throw $e;
        }
    }

    public function getQuotationPdf(int $quotationId)
    {
        try {
            $quotation = $this->quotationRepository->find($quotationId);
            $quotation->load(['items.product', 'customer', 'sales']);

            return $quotation;
        } catch (\Throwable $e) {
            Log::error('QuotationService getQuotationPdf() error: ' . $e->getMessage(), [
                'quotation_id' => $quotationId,
            ]);
            throw $e;
        }
    }

    protected function calculateTotals($quotation): void
    {
        $subtotal = $quotation->items->sum('subtotal');
        $taxAmount = $quotation->items->sum('tax');
        $discountAmount = $quotation->items->sum('discount');
        $totalAmount = $subtotal + $taxAmount - $discountAmount;

        $quotation->update([
            'subtotal' => $subtotal,
            'tax_amount' => $taxAmount,
            'discount_amount' => $discountAmount,
            'total_amount' => max(0, $totalAmount),
        ]);
    }
}
