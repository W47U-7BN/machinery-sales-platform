<?php

namespace App\DTOs;

class QuotationData
{
    public function __construct(
        public readonly int $customerId,
        public readonly array $items,
        public readonly ?float $discount = null,
        public readonly ?string $discountType = null,
        public readonly ?float $tax = null,
        public readonly ?string $terms = null,
        public readonly ?string $validUntil = null,
        public readonly ?string $notes = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            customerId: $data['customer_id'],
            items: $data['items'],
            discount: $data['discount'] ?? null,
            discountType: $data['discount_type'] ?? null,
            tax: $data['tax'] ?? null,
            terms: $data['terms'] ?? null,
            validUntil: $data['valid_until'] ?? null,
            notes: $data['notes'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'customer_id' => $this->customerId,
            'items' => $this->items,
            'discount' => $this->discount,
            'discount_type' => $this->discountType,
            'tax' => $this->tax,
            'terms' => $this->terms,
            'valid_until' => $this->validUntil,
            'notes' => $this->notes,
        ];
    }
}
