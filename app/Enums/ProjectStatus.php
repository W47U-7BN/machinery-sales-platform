<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case Planning = 'planning';
    case InProgress = 'in_progress';
    case OnHold = 'on_hold';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::Planning => 'Planning',
            self::InProgress => 'In Progress',
            self::OnHold => 'On Hold',
            self::Completed => 'Completed',
            self::Cancelled => 'Cancelled',
        };
    }

    public function isActive(): bool
    {
        return match ($this) {
            self::Planning, self::InProgress, self::OnHold => true,
            self::Completed, self::Cancelled => false,
        };
    }

    public static function activeStatuses(): array
    {
        return [
            self::Planning,
            self::InProgress,
            self::OnHold,
        ];
    }

    public static function terminalStatuses(): array
    {
        return [
            self::Completed,
            self::Cancelled,
        ];
    }
}
