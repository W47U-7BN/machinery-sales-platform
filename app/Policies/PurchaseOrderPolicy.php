<?php

namespace App\Policies;

use App\Models\PurchaseOrder;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PurchaseOrderPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Procurement', 'Finance', 'Super Admin', 'Direktur', 'GM']);
    }

    public function view(User $user, PurchaseOrder $purchaseOrder): bool
    {
        return $user->hasAnyRole(['Procurement', 'Super Admin', 'Direktur']);
    }

    public function create(User $user): bool
    {
        return $user->hasRole('Procurement');
    }

    public function update(User $user, PurchaseOrder $purchaseOrder): bool
    {
        return $user->hasAnyRole(['Procurement', 'Super Admin', 'Direktur']);
    }

    public function delete(User $user, PurchaseOrder $purchaseOrder): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function restore(User $user, PurchaseOrder $purchaseOrder): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function forceDelete(User $user, PurchaseOrder $purchaseOrder): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function approve(User $user, PurchaseOrder $purchaseOrder): bool
    {
        return $user->hasAnyRole(['Procurement Manager', 'Super Admin', 'Direktur']);
    }
}
