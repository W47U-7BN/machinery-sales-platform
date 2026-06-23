<?php

namespace App\Enums;

enum ApprovalStatus: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';
    case NeedRevision = 'need_revision';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Approved => 'Approved',
            self::Rejected => 'Rejected',
            self::NeedRevision => 'Need Revision',
        };
    }

    public function isFinal(): bool
    {
        return match ($this) {
            self::Approved, self::Rejected => true,
            self::Pending, self::NeedRevision => false,
        };
    }

    public function isPositive(): bool
    {
        return $this === self::Approved;
    }

    public function isNegative(): bool
    {
        return $this === self::Rejected;
    }
}
