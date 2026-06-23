<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->authenticated;
    }

    public function view(User $user, Article $article): bool
    {
        return $user->authenticated;
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Marketing', 'Super Admin', 'Direktur']);
    }

    public function update(User $user, Article $article): bool
    {
        if ($user->can('edit-articles')) {
            return true;
        }

        return $user->id === $article->author_id && $user->hasRole('Marketing');
    }

    public function delete(User $user, Article $article): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function restore(User $user, Article $article): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function forceDelete(User $user, Article $article): bool
    {
        return $user->hasRole('Super Admin');
    }
}
