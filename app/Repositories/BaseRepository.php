<?php

namespace App\Repositories;

use App\Contracts\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    protected ?Builder $query = null;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->query = $model->newQuery();
    }

    public function all(array $columns = ['*'])
    {
        try {
            return $this->query->get($columns);
        } catch (\Throwable $e) {
            Log::error('Repository all() error: ' . $e->getMessage(), [
                'model' => get_class($this->model),
            ]);
            throw $e;
        }
    }

    public function find(int $id, array $columns = ['*'])
    {
        try {
            $result = $this->query->find($id, $columns);

            if (!$result) {
                throw new \RuntimeException(
                    sprintf('Model %s with ID %d not found.', get_class($this->model), $id)
                );
            }

            return $result;
        } catch (\Throwable $e) {
            Log::error('Repository find() error: ' . $e->getMessage(), [
                'model' => get_class($this->model),
                'id' => $id,
            ]);
            throw $e;
        }
    }

    public function findWhere(array $criteria)
    {
        try {
            $query = $this->query;

            foreach ($criteria as $column => $value) {
                if (is_array($value)) {
                    $query->whereIn($column, $value);
                } else {
                    $query->where($column, $value);
                }
            }

            return $query->get();
        } catch (\Throwable $e) {
            Log::error('Repository findWhere() error: ' . $e->getMessage(), [
                'model' => get_class($this->model),
                'criteria' => $criteria,
            ]);
            throw $e;
        }
    }

    public function findWhereIn(string $column, array $values)
    {
        try {
            return $this->query->whereIn($column, $values)->get();
        } catch (\Throwable $e) {
            Log::error('Repository findWhereIn() error: ' . $e->getMessage(), [
                'model' => get_class($this->model),
                'column' => $column,
            ]);
            throw $e;
        }
    }

    public function create(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (\Throwable $e) {
            Log::error('Repository create() error: ' . $e->getMessage(), [
                'model' => get_class($this->model),
                'data' => $data,
            ]);
            throw $e;
        }
    }

    public function update(int $id, array $data)
    {
        try {
            $model = $this->find($id);
            $model->update($data);

            return $model->fresh();
        } catch (\Throwable $e) {
            Log::error('Repository update() error: ' . $e->getMessage(), [
                'model' => get_class($this->model),
                'id' => $id,
            ]);
            throw $e;
        }
    }

    public function delete(int $id)
    {
        try {
            $model = $this->find($id);

            return $model->delete();
        } catch (\Throwable $e) {
            Log::error('Repository delete() error: ' . $e->getMessage(), [
                'model' => get_class($this->model),
                'id' => $id,
            ]);
            throw $e;
        }
    }

    public function paginate(int $perPage = 15, array $columns = ['*'])
    {
        try {
            return $this->query->paginate($perPage, $columns);
        } catch (\Throwable $e) {
            Log::error('Repository paginate() error: ' . $e->getMessage(), [
                'model' => get_class($this->model),
            ]);
            throw $e;
        }
    }

    public function with(string $relations)
    {
        $this->query->with($relations);

        return $this;
    }

    public function orderBy(string $column, string $direction = 'asc')
    {
        $this->query->orderBy($column, $direction);

        return $this;
    }

    protected function resetQuery(): static
    {
        $this->query = $this->model->newQuery();

        return $this;
    }

    protected function newQuery(): Builder
    {
        return $this->model->newQuery();
    }
}
