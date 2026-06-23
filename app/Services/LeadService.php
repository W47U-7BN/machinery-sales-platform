<?php

namespace App\Services;

use App\Contracts\Repositories\CustomerRepositoryInterface;
use App\Contracts\Repositories\LeadRepositoryInterface;
use App\Contracts\Services\LeadServiceInterface;
use App\DTOs\LeadData;
use App\Enums\LeadStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LeadService implements LeadServiceInterface
{
    public function __construct(
        protected LeadRepositoryInterface $leadRepository,
        protected CustomerRepositoryInterface $customerRepository,
    ) {}

    public function captureLead(LeadData $data)
    {
        try {
            DB::beginTransaction();

            $leadData = $data->toArray();
            $leadData['status'] = $data->status ?? LeadStatus::NewLead->value;
            $leadData['source'] = $data->source ?? 'direct';

            $lead = $this->leadRepository->create($leadData);

            if ($data->email) {
                $existing = $this->customerRepository->findByEmail($data->email);
                if ($existing) {
                    $lead->customer_id = $existing->id;
                    $lead->save();
                }
            }

            DB::commit();

            return $lead;
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('LeadService captureLead() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function qualifyLead(int $leadId)
    {
        try {
            $lead = $this->leadRepository->find($leadId);
            $lead = $this->leadRepository->update($leadId, [
                'status' => LeadStatus::Qualified->value,
            ]);

            return $lead;
        } catch (\Throwable $e) {
            Log::error('LeadService qualifyLead() error: ' . $e->getMessage(), [
                'lead_id' => $leadId,
            ]);
            throw $e;
        }
    }

    public function moveToStage(int $leadId, LeadStatus $status)
    {
        try {
            DB::beginTransaction();

            $lead = $this->leadRepository->find($leadId);
            $previousStatus = $lead->status;

            $lead = $this->leadRepository->update($leadId, [
                'status' => $status->value,
            ]);

            $lead->activities()->create([
                'type' => 'status_change',
                'description' => "Status changed from {$previousStatus} to {$status->value}",
                'performed_by' => auth()->id(),
            ]);

            DB::commit();

            return $lead;
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('LeadService moveToStage() error: ' . $e->getMessage(), [
                'lead_id' => $leadId,
                'status' => $status->value,
            ]);
            throw $e;
        }
    }

    public function convertToCustomer(int $leadId)
    {
        try {
            DB::beginTransaction();

            $lead = $this->leadRepository->find($leadId);

            if ($lead->customer_id) {
                throw new \RuntimeException('Lead is already associated with a customer.');
            }

            $customer = $this->customerRepository->create([
                'company_name' => $lead->title,
                'email' => $lead->customer?->email,
                'phone' => $lead->customer?->phone,
                'notes' => "Converted from lead #{$leadId}",
                'is_active' => true,
            ]);

            $this->leadRepository->update($leadId, [
                'customer_id' => $customer->id,
                'status' => LeadStatus::Won->value,
                'converted_at' => now(),
            ]);

            DB::commit();

            return $customer;
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('LeadService convertToCustomer() error: ' . $e->getMessage(), [
                'lead_id' => $leadId,
            ]);
            throw $e;
        }
    }

    public function getLeadAnalytics(\Carbon\Carbon $startDate, \Carbon\Carbon $endDate)
    {
        try {
            $totalLeads = $this->leadRepository->findWhere([
                ['created_at', '>=', $startDate],
                ['created_at', '<=', $endDate],
            ]);

            $convertedLeads = $this->leadRepository->findWhere([
                ['converted_at', '>=', $startDate],
                ['converted_at', '<=', $endDate],
            ]);

            $leadsBySource = $this->leadRepository->getLeadsBySource();
            $conversionRate = $this->leadRepository->getConversionRate();

            return [
                'total_leads' => $totalLeads->count(),
                'converted_leads' => $convertedLeads->count(),
                'conversion_rate' => $conversionRate,
                'leads_by_source' => $leadsBySource,
                'period' => [
                    'start' => $startDate->toDateString(),
                    'end' => $endDate->toDateString(),
                ],
            ];
        } catch (\Throwable $e) {
            Log::error('LeadService getLeadAnalytics() error: ' . $e->getMessage());
            throw $e;
        }
    }
}
