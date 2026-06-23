<?php

namespace App\Enums;

enum MediaType: string
{
    case Image = 'image';
    case Video = 'video';
    case Document = 'document';
    case PDF = 'pdf';
    case Other = 'other';

    public function label(): string
    {
        return match ($this) {
            self::Image => 'Image',
            self::Video => 'Video',
            self::Document => 'Document',
            self::PDF => 'PDF',
            self::Other => 'Other',
        };
    }

    public function isImage(): bool
    {
        return $this === self::Image;
    }

    public function isVideo(): bool
    {
        return $this === self::Video;
    }

    public function isDocument(): bool
    {
        return match ($this) {
            self::Document, self::PDF => true,
            default => false,
        };
    }

    public static function imageExtensions(): array
    {
        return ['jpg', 'jpeg', 'png', 'webp', 'gif', 'bmp', 'svg'];
    }

    public static function videoExtensions(): array
    {
        return ['mp4', 'avi', 'mov', 'wmv', 'mkv', 'webm'];
    }

    public static function documentExtensions(): array
    {
        return ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];
    }

    public static function pdfExtensions(): array
    {
        return ['pdf'];
    }
}
