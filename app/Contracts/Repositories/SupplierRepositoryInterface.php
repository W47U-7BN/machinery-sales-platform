<?php

namespace App\Contracts\Repositories;

interface SupplierRepositoryInterface extends BaseRepositoryInterface
{
    public function findByEmail(string $email);

    public function findByPhone(string $phone);

    public function search(string $term);

    public function getActive();

    public function getTopSuppliers(int $limit = 10);
}
