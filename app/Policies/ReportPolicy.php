<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReportPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Finance', 'Direktur', 'GM', 'Super Admin']);
    }

    public function export(User $user): bool
    {
        return $this->viewAny($user);
    }
}
