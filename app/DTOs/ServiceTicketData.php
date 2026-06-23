<?php

namespace App\DTOs;

class ServiceTicketData
{
    public function __construct(
        public readonly int $customerId,
        public readonly int $productId,
        public readonly string $description,
        public readonly string $priority,
        public readonly ?string $scheduledDate = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            customerId: $data['customer_id'],
            productId: $data['product_id'],
            description: $data['description'],
            priority: $data['priority'],
            scheduledDate: $data['scheduled_date'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'customer_id' => $this->customerId,
            'product_id' => $this->productId,
            'description' => $this->description,
            'priority' => $this->priority,
            'scheduled_date' => $this->scheduledDate,
        ];
    }
}
