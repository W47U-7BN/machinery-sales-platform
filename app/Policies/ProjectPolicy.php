<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Teknisi', 'Sales', 'Super Admin', 'Direktur', 'GM']);
    }

    public function view(User $user, Project $project): bool
    {
        if ($user->can('edit-projects')) {
            return true;
        }

        return $user->id === $project->pic;
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Project Manager', 'Super Admin', 'Direktur']);
    }

    public function update(User $user, Project $project): bool
    {
        if ($user->can('edit-projects')) {
            return true;
        }

        return $user->id === $project->pic;
    }

    public function delete(User $user, Project $project): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function restore(User $user, Project $project): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function forceDelete(User $user, Project $project): bool
    {
        return $user->hasRole('Super Admin');
    }
}
