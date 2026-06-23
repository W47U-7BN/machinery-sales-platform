<?php

namespace App\DTOs;

class OrderData
{
    public function __construct(
        public readonly int $customerId,
        public readonly array $items,
        public readonly ?string $shippingAddress = null,
        public readonly ?string $paymentTerms = null,
        public readonly ?string $notes = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            customerId: $data['customer_id'],
            items: $data['items'],
            shippingAddress: $data['shipping_address'] ?? null,
            paymentTerms: $data['payment_terms'] ?? null,
            notes: $data['notes'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'customer_id' => $this->customerId,
            'items' => $this->items,
            'shipping_address' => $this->shippingAddress,
            'payment_terms' => $this->paymentTerms,
            'notes' => $this->notes,
        ];
    }
}
