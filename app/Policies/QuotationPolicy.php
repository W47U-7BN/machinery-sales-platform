<?php

namespace App\Policies;

use App\Models\Quotation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuotationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Sales', 'Finance', 'Super Admin', 'Direktur', 'GM']);
    }

    public function view(User $user, Quotation $quotation): bool
    {
        if ($user->can('edit-quotations')) {
            return true;
        }

        return $user->id === $quotation->sales_id;
    }

    public function create(User $user): bool
    {
        return $user->hasRole('Sales');
    }

    public function update(User $user, Quotation $quotation): bool
    {
        if ($user->can('edit-quotations')) {
            return true;
        }

        return $user->id === $quotation->sales_id;
    }

    public function delete(User $user, Quotation $quotation): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function restore(User $user, Quotation $quotation): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function forceDelete(User $user, Quotation $quotation): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function approve(User $user, Quotation $quotation): bool
    {
        return $user->hasAnyRole(['Sales Manager', 'Direktur', 'Super Admin', 'GM']);
    }
}
