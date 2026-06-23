<?php

namespace App\Enums;

enum UserRole: string
{
    case SuperAdmin = 'super_admin';
    case Direktur = 'direktur';
    case GeneralManager = 'general_manager';
    case SalesManager = 'sales_manager';
    case Sales = 'sales';
    case Marketing = 'marketing';
    case Teknisi = 'teknisi';
    case Warehouse = 'warehouse';
    case Finance = 'finance';
    case CustomerService = 'customer_service';
    case Dealer = 'dealer';
    case Vendor = 'vendor';
    case Customer = 'customer';

    public function label(): string
    {
        return match ($this) {
            self::SuperAdmin => 'Super Admin',
            self::Direktur => 'Direktur',
            self::GeneralManager => 'General Manager',
            self::SalesManager => 'Sales Manager',
            self::Sales => 'Sales',
            self::Marketing => 'Marketing',
            self::Teknisi => 'Teknisi',
            self::Warehouse => 'Warehouse',
            self::Finance => 'Finance',
            self::CustomerService => 'Customer Service',
            self::Dealer => 'Dealer',
            self::Vendor => 'Vendor',
            self::Customer => 'Customer',
        };
    }

    public function isInternal(): bool
    {
        return match ($this) {
            self::SuperAdmin, self::Direktur, self::GeneralManager,
            self::SalesManager, self::Sales, self::Marketing,
            self::Teknisi, self::Warehouse, self::Finance,
            self::CustomerService => true,
            self::Dealer, self::Vendor, self::Customer => false,
        };
    }

    public static function internalRoles(): array
    {
        return [
            self::SuperAdmin,
            self::Direktur,
            self::GeneralManager,
            self::SalesManager,
            self::Sales,
            self::Marketing,
            self::Teknisi,
            self::Warehouse,
            self::Finance,
            self::CustomerService,
        ];
    }

    public static function externalRoles(): array
    {
        return [
            self::Dealer,
            self::Vendor,
            self::Customer,
        ];
    }
}
