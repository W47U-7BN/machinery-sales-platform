<?php

namespace App\Repositories;

use App\Contracts\Repositories\LeadRepositoryInterface;
use App\Enums\LeadSource;
use App\Enums\LeadStatus;
use App\Models\Lead;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LeadRepository extends BaseRepository implements LeadRepositoryInterface
{
    public function __construct(Lead $model)
    {
        parent::__construct($model);
    }

    public function findByStatus(LeadStatus $status)
    {
        try {
            return $this->newQuery()
                ->where('status', $status->value)
                ->get();
        } catch (\Throwable $e) {
            Log::error('LeadRepository findByStatus() error: ' . $e->getMessage(), [
                'status' => $status->value,
            ]);
            throw $e;
        }
    }

    public function findBySource(LeadSource $source)
    {
        try {
            return $this->newQuery()
                ->where('source', $source->value)
                ->get();
        } catch (\Throwable $e) {
            Log::error('LeadRepository findBySource() error: ' . $e->getMessage(), [
                'source' => $source->value,
            ]);
            throw $e;
        }
    }

    public function findByAssignedTo(int $userId)
    {
        try {
            return $this->newQuery()
                ->where('assigned_to', $userId)
                ->get();
        } catch (\Throwable $e) {
            Log::error('LeadRepository findByAssignedTo() error: ' . $e->getMessage(), [
                'user_id' => $userId,
            ]);
            throw $e;
        }
    }

    public function search(string $term)
    {
        try {
            return $this->newQuery()
                ->where(function ($query) use ($term) {
                    $query->where('name', 'like', "%{$term}%")
                        ->orWhere('email', 'like', "%{$term}%")
                        ->orWhere('phone', 'like', "%{$term}%")
                        ->orWhere('company', 'like', "%{$term}%")
                        ->orWhere('notes', 'like', "%{$term}%");
                })
                ->get();
        } catch (\Throwable $e) {
            Log::error('LeadRepository search() error: ' . $e->getMessage(), [
                'term' => $term,
            ]);
            throw $e;
        }
    }

    public function getRecentLeads(int $limit = 10)
    {
        try {
            return $this->newQuery()
                ->orderBy('created_at', 'desc')
                ->limit($limit)
                ->get();
        } catch (\Throwable $e) {
            Log::error('LeadRepository getRecentLeads() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getConversionRate()
    {
        try {
            $total = $this->newQuery()->count();
            $won = $this->newQuery()->where('status', LeadStatus::Won->value)->count();

            if ($total === 0) {
                return 0;
            }

            return round(($won / $total) * 100, 2);
        } catch (\Throwable $e) {
            Log::error('LeadRepository getConversionRate() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getLeadsBySource()
    {
        try {
            return $this->newQuery()
                ->select('source', DB::raw('count(*) as total'))
                ->groupBy('source')
                ->get();
        } catch (\Throwable $e) {
            Log::error('LeadRepository getLeadsBySource() error: ' . $e->getMessage());
            throw $e;
        }
    }
}
