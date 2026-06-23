<?php

namespace App\DTOs;

use App\Enums\InventoryType;

class InventoryMovementData
{
    public function __construct(
        public readonly int $productId,
        public readonly int $warehouseId,
        public readonly InventoryType $type,
        public readonly int $quantity,
        public readonly ?string $reference = null,
        public readonly ?string $notes = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            productId: $data['product_id'],
            warehouseId: $data['warehouse_id'],
            type: $data['type'] instanceof InventoryType ? $data['type'] : InventoryType::from($data['type']),
            quantity: $data['quantity'],
            reference: $data['reference'] ?? null,
            notes: $data['notes'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'product_id' => $this->productId,
            'warehouse_id' => $this->warehouseId,
            'type' => $this->type->value,
            'quantity' => $this->quantity,
            'reference' => $this->reference,
            'notes' => $this->notes,
        ];
    }
}
