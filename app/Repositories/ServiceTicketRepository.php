<?php

namespace App\Repositories;

use App\Contracts\Repositories\ServiceTicketRepositoryInterface;
use App\Enums\TicketPriority;
use App\Models\ServiceTicket;
use Illuminate\Support\Facades\Log;

class ServiceTicketRepository extends BaseRepository implements ServiceTicketRepositoryInterface
{
    public function __construct(ServiceTicket $model)
    {
        parent::__construct($model);
    }

    public function generateNumber()
    {
        try {
            $prefix = 'TKT-' . now()->format('Ymd');
            $last = $this->newQuery()
                ->where('ticket_number', 'like', "{$prefix}-%")
                ->orderBy('id', 'desc')
                ->first();

            if (!$last) {
                return "{$prefix}-0001";
            }

            $lastNumber = (int) substr($last->ticket_number, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);

            return "{$prefix}-{$newNumber}";
        } catch (\Throwable $e) {
            Log::error('ServiceTicketRepository generateNumber() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function findByCustomer(int $customerId)
    {
        try {
            return $this->newQuery()
                ->where('customer_id', $customerId)
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (\Throwable $e) {
            Log::error('ServiceTicketRepository findByCustomer() error: ' . $e->getMessage(), [
                'customer_id' => $customerId,
            ]);
            throw $e;
        }
    }

    public function findByStatus(string $status)
    {
        try {
            return $this->newQuery()
                ->where('status', $status)
                ->get();
        } catch (\Throwable $e) {
            Log::error('ServiceTicketRepository findByStatus() error: ' . $e->getMessage(), [
                'status' => $status,
            ]);
            throw $e;
        }
    }

    public function findByPriority(TicketPriority $priority)
    {
        try {
            return $this->newQuery()
                ->where('priority', $priority->value)
                ->get();
        } catch (\Throwable $e) {
            Log::error('ServiceTicketRepository findByPriority() error: ' . $e->getMessage(), [
                'priority' => $priority->value,
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
            Log::error('ServiceTicketRepository findByAssignedTo() error: ' . $e->getMessage(), [
                'user_id' => $userId,
            ]);
            throw $e;
        }
    }

    public function getOpenTickets()
    {
        try {
            return $this->newQuery()
                ->whereIn('status', ['open', 'assigned', 'on_progress', 'waiting_sparepart'])
                ->orderBy('created_at', 'asc')
                ->get();
        } catch (\Throwable $e) {
            Log::error('ServiceTicketRepository getOpenTickets() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getRecentTickets(int $limit = 10)
    {
        try {
            return $this->newQuery()
                ->orderBy('created_at', 'desc')
                ->limit($limit)
                ->get();
        } catch (\Throwable $e) {
            Log::error('ServiceTicketRepository getRecentTickets() error: ' . $e->getMessage());
            throw $e;
        }
    }
}
