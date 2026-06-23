<?php

namespace App\Services;

use App\Contracts\Repositories\CustomerRepositoryInterface;
use App\Contracts\Repositories\OrderRepositoryInterface;
use App\Contracts\Repositories\QuotationRepositoryInterface;
use App\Contracts\Repositories\ServiceTicketRepositoryInterface;
use App\Contracts\Services\CustomerServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomerService implements CustomerServiceInterface
{
    public function __construct(
        protected CustomerRepositoryInterface $customerRepository,
        protected OrderRepositoryInterface $orderRepository,
        protected QuotationRepositoryInterface $quotationRepository,
        protected ServiceTicketRepositoryInterface $ticketRepository,
    ) {}

    public function registerCustomer(array $data)
    {
        try {
            DB::beginTransaction();

            if (isset($data['email'])) {
                $existing = $this->customerRepository->findByEmail($data['email']);
                if ($existing) {
                    throw new \RuntimeException('A customer with this email already exists.');
                }
            }

            $data['is_active'] = $data['is_active'] ?? true;
            $data['registered_at'] = $data['registered_at'] ?? now();

            $customer = $this->customerRepository->create($data);

            DB::commit();

            return $customer;
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('CustomerService registerCustomer() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getCustomerProfile(int $customerId)
    {
        try {
            $customer = $this->customerRepository->find($customerId);
            $customer->load([
                'contacts',
                'user',
            ]);

            return $customer;
        } catch (\Throwable $e) {
            Log::error('CustomerService getCustomerProfile() error: ' . $e->getMessage(), [
                'customer_id' => $customerId,
            ]);
            throw $e;
        }
    }

    public function getCustomerOrders(int $customerId)
    {
        try {
            return $this->orderRepository->findByCustomer($customerId);
        } catch (\Throwable $e) {
            Log::error('CustomerService getCustomerOrders() error: ' . $e->getMessage(), [
                'customer_id' => $customerId,
            ]);
            throw $e;
        }
    }

    public function getCustomerQuotations(int $customerId)
    {
        try {
            return $this->quotationRepository->findByCustomer($customerId);
        } catch (\Throwable $e) {
            Log::error('CustomerService getCustomerQuotations() error: ' . $e->getMessage(), [
                'customer_id' => $customerId,
            ]);
            throw $e;
        }
    }

    public function getCustomerTickets(int $customerId)
    {
        try {
            return $this->ticketRepository->findByCustomer($customerId);
        } catch (\Throwable $e) {
            Log::error('CustomerService getCustomerTickets() error: ' . $e->getMessage(), [
                'customer_id' => $customerId,
            ]);
            throw $e;
        }
    }

    public function searchCustomers(string $term)
    {
        try {
            return $this->customerRepository->search($term);
        } catch (\Throwable $e) {
            Log::error('CustomerService searchCustomers() error: ' . $e->getMessage(), [
                'term' => $term,
            ]);
            throw $e;
        }
    }
}
