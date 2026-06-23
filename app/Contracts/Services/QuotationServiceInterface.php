<?php

namespace App\Contracts\Services;

interface QuotationServiceInterface
{
    public function createQuotation(array $data);

    public function approveQuotation(int $quotationId);

    public function rejectQuotation(int $quotationId, string $reason);

    public function convertToOrder(int $quotationId);

    public function sendToCustomer(int $quotationId);

    public function getQuotationPdf(int $quotationId);
}
