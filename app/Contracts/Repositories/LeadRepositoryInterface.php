<?php

namespace App\Contracts\Repositories;

use App\Enums\LeadSource;
use App\Enums\LeadStatus;

interface LeadRepositoryInterface extends BaseRepositoryInterface
{
    public function findByStatus(LeadStatus $status);

    public function findBySource(LeadSource $source);

    public function findByAssignedTo(int $userId);

    public function search(string $term);

    public function getRecentLeads(int $limit = 10);

    public function getConversionRate();

    public function getLeadsBySource();
}
