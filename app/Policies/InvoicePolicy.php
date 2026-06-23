<?php

namespace App\Policies;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoicePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Finance', 'Sales', 'Super Admin', 'Direktur', 'GM']);
    }

    public function view(User $user, Invoice $invoice): bool
    {
        return $user->hasAnyRole(['Finance', 'Super Admin', 'Direktur', 'GM']);
    }

    public function create(User $user): bool
    {
        return $user->hasRole('Finance');
    }

    public function update(User $user, Invoice $invoice): bool
    {
        return $user->hasAnyRole(['Finance', 'Super Admin', 'Direktur']);
    }

    public function delete(User $user, Invoice $invoice): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function restore(User $user, Invoice $invoice): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function forceDelete(User $user, Invoice $invoice): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function approve(User $user, Invoice $invoice): bool
    {
        return $user->hasAnyRole(['Finance Manager', 'Super Admin', 'Direktur']);
    }
}
