<?php

namespace App\Enums;

enum OrderStatus: string
{
    case Draft = 'draft';
    case Pending = 'pending';
    case Confirmed = 'confirmed';
    case Processing = 'processing';
    case Shipped = 'shipped';
    case Delivered = 'delivered';
    case Cancelled = 'cancelled';
    case Returned = 'returned';

    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::Pending => 'Pending',
            self::Confirmed => 'Confirmed',
            self::Processing => 'Processing',
            self::Shipped => 'Shipped',
            self::Delivered => 'Delivered',
            self::Cancelled => 'Cancelled',
            self::Returned => 'Returned',
        };
    }

    public function isActive(): bool
    {
        return match ($this) {
            self::Draft, self::Pending, self::Confirmed,
            self::Processing, self::Shipped => true,
            self::Delivered, self::Cancelled, self::Returned => false,
        };
    }

    public function isShippable(): bool
    {
        return match ($this) {
            self::Confirmed, self::Processing => true,
            default => false,
        };
    }

    public static function activeStatuses(): array
    {
        return [
            self::Draft,
            self::Pending,
            self::Confirmed,
            self::Processing,
            self::Shipped,
        ];
    }

    public static function terminalStatuses(): array
    {
        return [
            self::Delivered,
            self::Cancelled,
            self::Returned,
        ];
    }
}
