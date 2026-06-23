<?php

namespace App\Enums;

enum LeadStatus: string
{
    case NewLead = 'new_lead';
    case Qualified = 'qualified';
    case Contacted = 'contacted';
    case Meeting = 'meeting';
    case Quotation = 'quotation';
    case Negotiation = 'negotiation';
    case Won = 'won';
    case Lost = 'lost';

    public function label(): string
    {
        return match ($this) {
            self::NewLead => 'New Lead',
            self::Qualified => 'Qualified',
            self::Contacted => 'Contacted',
            self::Meeting => 'Meeting',
            self::Quotation => 'Quotation',
            self::Negotiation => 'Negotiation',
            self::Won => 'Won',
            self::Lost => 'Lost',
        };
    }

    public function isActive(): bool
    {
        return match ($this) {
            self::NewLead, self::Qualified, self::Contacted,
            self::Meeting, self::Quotation, self::Negotiation => true,
            self::Won, self::Lost => false,
        };
    }

    public static function openStatuses(): array
    {
        return [
            self::NewLead,
            self::Qualified,
            self::Contacted,
            self::Meeting,
            self::Quotation,
            self::Negotiation,
        ];
    }

    public static function closedStatuses(): array
    {
        return [
            self::Won,
            self::Lost,
        ];
    }
}
