<?php

namespace App\Policies;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SupplierPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Procurement', 'Warehouse', 'Finance', 'Super Admin', 'Direktur', 'GM']);
    }

    public function view(User $user, Supplier $supplier): bool
    {
        return $user->hasAnyRole(['Procurement', 'Super Admin', 'Direktur']);
    }

    public function create(User $user): bool
    {
        return $user->hasRole('Procurement');
    }

    public function update(User $user, Supplier $supplier): bool
    {
        return $user->hasAnyRole(['Procurement', 'Super Admin', 'Direktur']);
    }

    public function delete(User $user, Supplier $supplier): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function restore(User $user, Supplier $supplier): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function forceDelete(User $user, Supplier $supplier): bool
    {
        return $user->hasRole('Super Admin');
    }
}
