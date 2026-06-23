<?php

namespace App\Policies;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeadPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Sales', 'Marketing', 'Super Admin', 'Direktur', 'GM']);
    }

    public function view(User $user, Lead $lead): bool
    {
        if ($user->can('edit-leads')) {
            return true;
        }

        return $user->id === $lead->assigned_to
            || $user->id === $lead->created_by;
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Sales', 'Marketing', 'Super Admin']);
    }

    public function update(User $user, Lead $lead): bool
    {
        if ($user->can('edit-leads')) {
            return true;
        }

        return $user->id === $lead->assigned_to;
    }

    public function delete(User $user, Lead $lead): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function restore(User $user, Lead $lead): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function forceDelete(User $user, Lead $lead): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function convert(User $user, Lead $lead): bool
    {
        return $user->hasAnyRole(['Sales Manager', 'Super Admin', 'Direktur']);
    }
}
