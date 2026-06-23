<?php

namespace App\Enums;

enum InventoryType: string
{
    case In = 'in';
    case Out = 'out';
    case Transfer = 'transfer';
    case Adjustment = 'adjustment';
    case Return = 'return';

    public function label(): string
    {
        return match ($this) {
            self::In => 'Stock In',
            self::Out => 'Stock Out',
            self::Transfer => 'Transfer',
            self::Adjustment => 'Adjustment',
            self::Return => 'Return',
        };
    }

    public function affectsStock(): bool
    {
        return match ($this) {
            self::In, self::Out, self::Adjustment, self::Return => true,
            self::Transfer => false,
        };
    }

    public function isAddition(): bool
    {
        return match ($this) {
            self::In, self::Return => true,
            self::Out, self::Adjustment, self::Transfer => false,
        };
    }

    public function isReduction(): bool
    {
        return match ($this) {
            self::Out => true,
            self::In, self::Transfer, self::Adjustment, self::Return => false,
        };
    }
}
