<?php

namespace App\Services;

use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Contracts\Repositories\ServiceTicketRepositoryInterface;
use App\Contracts\Services\ServiceTicketServiceInterface;
use App\Enums\ServiceTicketStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceTicketService implements ServiceTicketServiceInterface
{
    public function __construct(
        protected ServiceTicketRepositoryInterface $ticketRepository,
        protected ProductRepositoryInterface $productRepository,
    ) {}

    public function createTicket(array $data)
    {
        try {
            DB::beginTransaction();

            $data['ticket_number'] = $this->ticketRepository->generateNumber();
            $data['status'] = $data['status'] ?? ServiceTicketStatus::Open->value;
            $data['reported_at'] = $data['reported_at'] ?? now();

            $ticket = $this->ticketRepository->create($data);

            $ticket->activities()->create([
                'description' => 'Ticket created',
                'performed_by' => auth()->id(),
            ]);

            DB::commit();

            return $ticket;
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('ServiceTicketService createTicket() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function assignTicket(int $ticketId, int $technicianId)
    {
        try {
            DB::beginTransaction();

            $ticket = $this->ticketRepository->update($ticketId, [
                'assigned_to' => $technicianId,
                'status' => ServiceTicketStatus::Assigned->value,
            ]);

            $ticket->activities()->create([
                'description' => "Ticket assigned to technician #{$technicianId}",
                'performed_by' => auth()->id(),
            ]);

            DB::commit();

            return $ticket;
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('ServiceTicketService assignTicket() error: ' . $e->getMessage(), [
                'ticket_id' => $ticketId,
                'technician_id' => $technicianId,
            ]);
            throw $e;
        }
    }

    public function updateTicketStatus(int $ticketId, ServiceTicketStatus $status)
    {
        try {
            DB::beginTransaction();

            $ticket = $this->ticketRepository->find($ticketId);
            $previousStatus = $ticket->status;

            $ticket = $this->ticketRepository->update($ticketId, [
                'status' => $status->value,
            ]);

            $ticket->activities()->create([
                'description' => "Status changed from {$previousStatus} to {$status->value}",
                'performed_by' => auth()->id(),
            ]);

            DB::commit();

            return $ticket;
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('ServiceTicketService updateTicketStatus() error: ' . $e->getMessage(), [
                'ticket_id' => $ticketId,
            ]);
            throw $e;
        }
    }

    public function addSparepart(int $ticketId, int $productId, float $quantity)
    {
        try {
            DB::beginTransaction();

            $ticket = $this->ticketRepository->find($ticketId);
            $product = $this->productRepository->find($productId);

            $sparepart = $ticket->spareparts()->create([
                'product_id' => $productId,
                'product_name' => $product->name,
                'quantity' => $quantity,
                'unit_price' => $product->selling_price,
            ]);

            $ticket->activities()->create([
                'description' => "Sparepart added: {$product->name} x{$quantity}",
                'performed_by' => auth()->id(),
            ]);

            if ($ticket->status === ServiceTicketStatus::Assigned->value) {
                $this->ticketRepository->update($ticketId, [
                    'status' => ServiceTicketStatus::OnProgress->value,
                ]);
            }

            DB::commit();

            return $sparepart;
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('ServiceTicketService addSparepart() error: ' . $e->getMessage(), [
                'ticket_id' => $ticketId,
                'product_id' => $productId,
            ]);
            throw $e;
        }
    }

    public function completeTicket(int $ticketId, string $resolution)
    {
        try {
            DB::beginTransaction();

            $ticket = $this->ticketRepository->update($ticketId, [
                'status' => ServiceTicketStatus::Completed->value,
                'resolved_at' => now(),
                'resolution_notes' => $resolution,
            ]);

            $ticket->activities()->create([
                'description' => "Ticket completed: {$resolution}",
                'performed_by' => auth()->id(),
            ]);

            DB::commit();

            return $ticket;
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('ServiceTicketService completeTicket() error: ' . $e->getMessage(), [
                'ticket_id' => $ticketId,
            ]);
            throw $e;
        }
    }

    public function getCustomerTickets(int $customerId)
    {
        try {
            return $this->ticketRepository->findByCustomer($customerId);
        } catch (\Throwable $e) {
            Log::error('ServiceTicketService getCustomerTickets() error: ' . $e->getMessage(), [
                'customer_id' => $customerId,
            ]);
            throw $e;
        }
    }
}
