<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Sales', 'Marketing', 'Finance', 'Super Admin', 'Direktur', 'GM']);
    }

    public function view(User $user, Customer $customer): bool
    {
        if ($user->can('edit-customers')) {
            return true;
        }

        if ($user->hasRole('Sales')) {
            return true;
        }

        return $user->id === $customer->user_id;
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Sales', 'Marketing', 'Super Admin', 'Direktur']);
    }

    public function update(User $user, Customer $customer): bool
    {
        if ($user->can('edit-customers')) {
            return true;
        }

        return $user->hasRole('Sales');
    }

    public function delete(User $user, Customer $customer): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function restore(User $user, Customer $customer): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function forceDelete(User $user, Customer $customer): bool
    {
        return $user->hasRole('Super Admin');
    }
}
