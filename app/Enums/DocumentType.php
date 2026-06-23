<?php

namespace App\Enums;

enum DocumentType: string
{
    case Katalog = 'katalog';
    case ManualBook = 'manual_book';
    case SOP = 'sop';
    case Sertifikat = 'sertifikat';
    case Brosur = 'brosur';
    case Contract = 'contract';
    case Invoice = 'invoice';
    case Quotation = 'quotation';

    public function label(): string
    {
        return match ($this) {
            self::Katalog => 'Katalog',
            self::ManualBook => 'Manual Book',
            self::SOP => 'SOP',
            self::Sertifikat => 'Sertifikat',
            self::Brosur => 'Brosur',
            self::Contract => 'Contract',
            self::Invoice => 'Invoice',
            self::Quotation => 'Quotation',
        };
    }

    public function isCommercial(): bool
    {
        return match ($this) {
            self::Contract, self::Invoice, self::Quotation => true,
            default => false,
        };
    }

    public function isTechnical(): bool
    {
        return match ($this) {
            self::ManualBook, self::SOP, self::Sertifikat => true,
            default => false,
        };
    }
}
