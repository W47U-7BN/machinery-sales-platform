<?php

namespace App\Contracts\Services;

interface CustomerServiceInterface
{
    public function registerCustomer(array $data);

    public function getCustomerProfile(int $customerId);

    public function getCustomerOrders(int $customerId);

    public function getCustomerQuotations(int $customerId);

    public function getCustomerTickets(int $customerId);

    public function searchCustomers(string $term);
}
