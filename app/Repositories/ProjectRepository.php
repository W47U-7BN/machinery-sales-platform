<?php

namespace App\Repositories;

use App\Contracts\Repositories\ProjectRepositoryInterface;
use App\Enums\ProjectStatus;
use App\Models\Project;
use Illuminate\Support\Facades\Log;

class ProjectRepository extends BaseRepository implements ProjectRepositoryInterface
{
    public function __construct(Project $model)
    {
        parent::__construct($model);
    }

    public function findByCustomer(int $customerId)
    {
        try {
            return $this->newQuery()
                ->where('customer_id', $customerId)
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (\Throwable $e) {
            Log::error('ProjectRepository findByCustomer() error: ' . $e->getMessage(), [
                'customer_id' => $customerId,
            ]);
            throw $e;
        }
    }

    public function findByStatus(ProjectStatus $status)
    {
        try {
            return $this->newQuery()
                ->where('status', $status->value)
                ->get();
        } catch (\Throwable $e) {
            Log::error('ProjectRepository findByStatus() error: ' . $e->getMessage(), [
                'status' => $status->value,
            ]);
            throw $e;
        }
    }

    public function findByAssignedTo(int $userId)
    {
        try {
            return $this->newQuery()
                ->where('pic', $userId)
                ->get();
        } catch (\Throwable $e) {
            Log::error('ProjectRepository findByAssignedTo() error: ' . $e->getMessage(), [
                'user_id' => $userId,
            ]);
            throw $e;
        }
    }

    public function getActive()
    {
        try {
            return $this->newQuery()
                ->whereIn('status', ['planning', 'in_progress', 'on_hold'])
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (\Throwable $e) {
            Log::error('ProjectRepository getActive() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getRecentProjects(int $limit = 10)
    {
        try {
            return $this->newQuery()
                ->orderBy('created_at', 'desc')
                ->limit($limit)
                ->get();
        } catch (\Throwable $e) {
            Log::error('ProjectRepository getRecentProjects() error: ' . $e->getMessage());
            throw $e;
        }
    }
}
