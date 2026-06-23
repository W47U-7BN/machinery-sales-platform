<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case Pending = 'pending';
    case Partial = 'partial';
    case Paid = 'paid';
    case Overdue = 'overdue';
    case Refunded = 'refunded';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Partial => 'Partial',
            self::Paid => 'Paid',
            self::Overdue => 'Overdue',
            self::Refunded => 'Refunded',
            self::Cancelled => 'Cancelled',
        };
    }

    public function isSettled(): bool
    {
        return match ($this) {
            self::Paid, self::Refunded, self::Cancelled => true,
            default => false,
        };
    }

    public function isOutstanding(): bool
    {
        return match ($this) {
            self::Pending, self::Partial, self::Overdue => true,
            default => false,
        };
    }
}
