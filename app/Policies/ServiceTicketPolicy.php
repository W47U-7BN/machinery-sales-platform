<?php

namespace App\Policies;

use App\Models\ServiceTicket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServiceTicketPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Teknisi', 'Customer Service', 'Super Admin', 'Direktur', 'GM']);
    }

    public function view(User $user, ServiceTicket $serviceTicket): bool
    {
        if ($user->can('edit-service-tickets')) {
            return true;
        }

        if ($user->id === $serviceTicket->assigned_to) {
            return true;
        }

        if ($user->hasRole('Customer Service')) {
            return true;
        }

        if ($serviceTicket->customer?->user_id === $user->id) {
            return true;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Customer Service', 'Super Admin']);
    }

    public function update(User $user, ServiceTicket $serviceTicket): bool
    {
        if ($user->can('edit-service-tickets')) {
            return true;
        }

        return $user->id === $serviceTicket->assigned_to && $user->hasRole('Teknisi');
    }

    public function delete(User $user, ServiceTicket $serviceTicket): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function restore(User $user, ServiceTicket $serviceTicket): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function forceDelete(User $user, ServiceTicket $serviceTicket): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function assign(User $user, ServiceTicket $serviceTicket): bool
    {
        return $user->hasAnyRole(['Customer Service Manager', 'Super Admin', 'Direktur']);
    }
}
