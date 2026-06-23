<?php

namespace App\Contracts\Services;

use App\Enums\ServiceTicketStatus;

interface ServiceTicketServiceInterface
{
    public function createTicket(array $data);

    public function assignTicket(int $ticketId, int $technicianId);

    public function updateTicketStatus(int $ticketId, ServiceTicketStatus $status);

    public function addSparepart(int $ticketId, int $productId, float $quantity);

    public function completeTicket(int $ticketId, string $resolution);

    public function getCustomerTickets(int $customerId);
}
