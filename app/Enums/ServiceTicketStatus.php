<?php

namespace App\Enums;

enum ServiceTicketStatus: string
{
    case Open = 'open';
    case Assigned = 'assigned';
    case OnProgress = 'on_progress';
    case WaitingSparepart = 'waiting_sparepart';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::Open => 'Open',
            self::Assigned => 'Assigned',
            self::OnProgress => 'On Progress',
            self::WaitingSparepart => 'Waiting Sparepart',
            self::Completed => 'Completed',
            self::Cancelled => 'Cancelled',
        };
    }

    public function isOpen(): bool
    {
        return match ($this) {
            self::Open, self::Assigned, self::OnProgress,
            self::WaitingSparepart => true,
            self::Completed, self::Cancelled => false,
        };
    }

    public static function openStatuses(): array
    {
        return [
            self::Open,
            self::Assigned,
            self::OnProgress,
            self::WaitingSparepart,
        ];
    }

    public static function closedStatuses(): array
    {
        return [
            self::Completed,
            self::Cancelled,
        ];
    }
}
