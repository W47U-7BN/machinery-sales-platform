<?php

namespace App\Contracts\Repositories;

use App\Enums\TicketPriority;

interface ServiceTicketRepositoryInterface extends BaseRepositoryInterface
{
    public function generateNumber();

    public function findByCustomer(int $customerId);

    public function findByStatus(string $status);

    public function findByPriority(TicketPriority $priority);

    public function findByAssignedTo(int $userId);

    public function getOpenTickets();

    public function getRecentTickets(int $limit = 10);
}
