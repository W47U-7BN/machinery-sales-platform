<?php

namespace App\Policies;

use App\Models\Inventory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InventoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Warehouse', 'Sales', 'Super Admin', 'Direktur', 'GM']);
    }

    public function view(User $user, Inventory $inventory): bool
    {
        return $user->hasAnyRole(['Warehouse', 'Super Admin', 'Direktur', 'GM']);
    }

    public function create(User $user): bool
    {
        return $user->hasRole('Warehouse');
    }

    public function update(User $user, Inventory $inventory): bool
    {
        return $user->hasAnyRole(['Warehouse', 'Super Admin', 'Direktur']);
    }

    public function delete(User $user, Inventory $inventory): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function restore(User $user, Inventory $inventory): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function forceDelete(User $user, Inventory $inventory): bool
    {
        return $user->hasRole('Super Admin');
    }
}
