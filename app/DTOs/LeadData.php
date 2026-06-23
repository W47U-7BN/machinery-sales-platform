<?php

namespace App\DTOs;

readonly class LeadData
{
    public function __construct(
        public string $name,
        public ?string $email,
        public ?string $phone,
        public ?string $company,
        public ?string $source,
        public ?string $status,
        public ?string $notes,
        public ?string $productInterest,
        public ?float $budget,
    ) {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->company,
            'source' => $this->source,
            'status' => $this->status,
            'notes' => $this->notes,
            'product_interest' => $this->productInterest,
            'budget' => $this->budget,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'] ?? null,
            phone: $data['phone'] ?? null,
            company: $data['company'] ?? null,
            source: $data['source'] ?? null,
            status: $data['status'] ?? null,
            notes: $data['notes'] ?? null,
            productInterest: $data['product_interest'] ?? $data['productInterest'] ?? null,
            budget: isset($data['budget']) ? (float) $data['budget'] : null,
        );
    }
}
