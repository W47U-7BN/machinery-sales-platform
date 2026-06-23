<?php

namespace App\Enums;

enum LeadSource: string
{
    case Website = 'website';
    case WhatsApp = 'whatsapp';
    case Facebook = 'facebook';
    case Instagram = 'instagram';
    case TikTok = 'tiktok';
    case GoogleAds = 'google_ads';
    case Referral = 'referral';
    case Direct = 'direct';
    case Email = 'email';
    case Phone = 'phone';
    case Other = 'other';

    public function label(): string
    {
        return match ($this) {
            self::Website => 'Website',
            self::WhatsApp => 'WhatsApp',
            self::Facebook => 'Facebook',
            self::Instagram => 'Instagram',
            self::TikTok => 'TikTok',
            self::GoogleAds => 'Google Ads',
            self::Referral => 'Referral',
            self::Direct => 'Direct',
            self::Email => 'Email',
            self::Phone => 'Phone',
            self::Other => 'Other',
        };
    }

    public function isDigital(): bool
    {
        return match ($this) {
            self::Website, self::WhatsApp, self::Facebook,
            self::Instagram, self::TikTok, self::GoogleAds,
            self::Email => true,
            self::Referral, self::Direct, self::Phone, self::Other => false,
        };
    }
}
