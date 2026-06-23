<?php

namespace App\Contracts\Repositories;

interface WarehouseRepositoryInterface extends BaseRepositoryInterface
{
    public function findByCode(string $code);

    public function getActive();

    public function getMain();

    public function getWithInventory();
}
