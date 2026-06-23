<?php

namespace App\Contracts\Repositories;

interface CustomerRepositoryInterface extends BaseRepositoryInterface
{
    public function findByEmail(string $email);

    public function findByPhone(string $phone);

    public function search(string $term);

    public function getWithOutstandingBalance();

    public function getRecentCustomers(int $limit = 10);
}
