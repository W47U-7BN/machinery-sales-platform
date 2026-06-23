<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Sales', 'Finance', 'Warehouse', 'Super Admin', 'Direktur', 'GM']);
    }

    public function view(User $user, Order $order): bool
    {
        if ($user->can('edit-orders')) {
            return true;
        }

        return $user->id === $order->sales_id;
    }

    public function create(User $user): bool
    {
        return $user->hasRole('Sales');
    }

    public function update(User $user, Order $order): bool
    {
        if ($user->can('edit-orders')) {
            return true;
        }

        return $user->id === $order->sales_id;
    }

    public function delete(User $user, Order $order): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function restore(User $user, Order $order): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function forceDelete(User $user, Order $order): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function approve(User $user, Order $order): bool
    {
        return $user->hasAnyRole(['Sales Manager', 'Super Admin', 'Direktur']);
    }
}
