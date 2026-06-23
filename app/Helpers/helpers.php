<?php

if (!function_exists('formatRupiah')) {
    function formatRupiah($amount): string
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}

if (!function_exists('formatNumber')) {
    function formatNumber($number, $decimal = 0): string
    {
        return number_format($number, $decimal, ',', '.');
    }
}

if (!function_exists('generateSKU')) {
    function generateSKU($category, $id): string
    {
        $prefix = strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $category), 0, 3));
        return $prefix . '-' . str_pad($id, 6, '0', STR_PAD_LEFT);
    }
}

if (!function_exists('generateQuotationNumber')) {
    function generateQuotationNumber(): string
    {
        return 'QTN-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
    }
}

if (!function_exists('generateOrderNumber')) {
    function generateOrderNumber(): string
    {
        return 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
    }
}

if (!function_exists('generateTicketNumber')) {
    function generateTicketNumber(): string
    {
        return 'TKT-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
    }
}

if (!function_exists('calculateDiscount')) {
    function calculateDiscount($price, $discount, $type = 'percentage'): float
    {
        if ($type === 'percentage') {
            return $price * ($discount / 100);
        }
        return min($discount, $price);
    }
}

if (!function_exists('getInitials')) {
    function getInitials($name): string
    {
        $words = explode(' ', $name);
        $initials = '';
        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper($word[0]);
            }
        }
        return substr($initials, 0, 2);
    }
}

if (!function_exists('maskEmail')) {
    function maskEmail($email): string
    {
        $parts = explode('@', $email);
        $name = $parts[0];
        $maskedName = substr($name, 0, 2) . str_repeat('*', strlen($name) - 2);
        return $maskedName . '@' . $parts[1];
    }
}

if (!function_exists('maskPhone')) {
    function maskPhone($phone): string
    {
        if (strlen($phone) <= 4) return $phone;
        $visible = substr($phone, 0, 2) . str_repeat('*', strlen($phone) - 4) . substr($phone, -2);
        return $visible;
    }
}

if (!function_exists('generateInvoiceNumber')) {
    function generateInvoiceNumber(): string
    {
        return 'INV-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
    }
}

if (!function_exists('generatePRNumber')) {
    function generatePRNumber(): string
    {
        return 'PR-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
    }
}

if (!function_exists('generatePONumber')) {
    function generatePONumber(): string
    {
        return 'PO-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
    }
}
