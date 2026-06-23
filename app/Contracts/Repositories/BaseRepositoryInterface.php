<?php

namespace App\Contracts\Repositories;

interface BaseRepositoryInterface
{
    public function all(array $columns = ['*']);

    public function find(int $id, array $columns = ['*']);

    public function findWhere(array $criteria);

    public function findWhereIn(string $column, array $values);

    public function create(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);

    public function paginate(int $perPage = 15, array $columns = ['*']);

    public function with(string $relations);

    public function orderBy(string $column, string $direction = 'asc');
}
