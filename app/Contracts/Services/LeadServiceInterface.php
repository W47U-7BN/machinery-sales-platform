<?php

namespace App\Contracts\Services;

use App\DTOs\LeadData;
use App\Enums\LeadStatus;

interface LeadServiceInterface
{
    public function captureLead(LeadData $data);

    public function qualifyLead(int $leadId);

    public function moveToStage(int $leadId, LeadStatus $status);

    public function convertToCustomer(int $leadId);

    public function getLeadAnalytics(\Carbon\Carbon $startDate, \Carbon\Carbon $endDate);
}
