<?php

namespace App\Enums;

enum TicketPriority: string
{
    case Low = 'low';
    case Medium = 'medium';
    case High = 'high';
    case Urgent = 'urgent';
    case Critical = 'critical';

    public function label(): string
    {
        return match ($this) {
            self::Low => 'Low',
            self::Medium => 'Medium',
            self::High => 'High',
            self::Urgent => 'Urgent',
            self::Critical => 'Critical',
        };
    }

    public function value(): int
    {
        return match ($this) {
            self::Low => 1,
            self::Medium => 2,
            self::High => 3,
            self::Urgent => 4,
            self::Critical => 5,
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Low => '#6b7280',
            self::Medium => '#3b82f6',
            self::High => '#f59e0b',
            self::Urgent => '#ef4444',
            self::Critical => '#dc2626',
        };
    }

    public function isHighPriority(): bool
    {
        return match ($this) {
            self::High, self::Urgent, self::Critical => true,
            default => false,
        };
    }
}
